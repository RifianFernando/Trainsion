"use client";
import { getUserInfo } from "@/api/auth";
import { Button, TextField } from "@mui/material";
import Select, { SelectChangeEvent } from "@mui/material/Select";
import { redirect } from "next/navigation";
import { ChangeEvent, use, useEffect, useState } from "react";
import MenuItem from "@mui/material/MenuItem";
import InputLabel from "@mui/material/InputLabel";
import { getTrainByID } from "@/api/bookingTrain";

interface errorProps {
    attribute: string;
    message: string;
}

interface ticketProps {
    id: number;
    name: string;
    email: string;
    phone_number: string;
    class: string;
    error: errorProps[];
}

interface ticketPriceProps {
    economy: number;
    executive: number;
}

export default function BookingTrainPage({
    params,
}: {
    params: Promise<{ trainID: string }>;
}) {
    const [ticket, setTicket] = useState<ticketProps[]>([]);
    const [price, setPrice] = useState<ticketPriceProps>({
        economy: 0,
        executive: 0,
    });
    const { trainID } = use(params);

    useEffect(() => {
        getUserInfo().then((response) => {
            const Status = response.status;
            if (Status !== 200) {
                sessionStorage.clear();
                redirect("/auth/login");
            }
            const data = response.data;
            setTicket([
                {
                    id: 1,
                    name: data.name,
                    email: data.email,
                    phone_number: "",
                    class: "Economy",
                    error: [],
                },
            ]);
        });
        getTrainByID(trainID).then((response) => {
            setPrice({
                economy: response.data.economy_price,
                executive: response.data.executive_price,
            });
        });
    }, [trainID]);
    const [confirmed, setConfirmed] = useState<boolean>(false);
    const handleDeletePassengerTicket = (id: number) => {
        setTicket((l) => l.filter((ticket) => ticket.id !== id));
    };

    const handleSelectChange = (
        e: SelectChangeEvent,
        idx: number,
        key: string
    ) => {
        // https://react.dev/learn/updating-arrays-in-state#replacing-items-in-an-array
        setTicket(
            ticket.map((c, i) => {
                if (i === idx) {
                    return {
                        ...c,
                        [key]: e.target.value,
                    };
                } else {
                    return c;
                }
            })
        );
    };

    const handleChangeInput = (
        e: ChangeEvent<HTMLInputElement | HTMLTextAreaElement>,
        idx: number,
        key: string
    ) => {
        setTicket(
            ticket.map((c, i) => {
                if (i === idx) {
                    return {
                        ...c,
                        [key]: e.target.value,
                    };
                } else {
                    return c;
                }
            })
        );
    };

    const addMorePassenger = (idx: number) => {
        // https://react.dev/learn/updating-arrays-in-state#adding-to-an-array
        setTicket([
            ...ticket,
            {
                id: idx,
                name: "",
                email: "",
                phone_number: "",
                class: "Economy",
                error: [],
            },
        ]);
    };

    const confirmedData = (value: boolean) => {
        let totalError = 0;
        const updatedTickets = ticket.map((item) => {
            const errors: errorProps[] = [];

            if (item.name.trim().length === 0) {
                errors.push({
                    attribute: "name",
                    message: "Name is required",
                });
                totalError++;
            }
            if (item.email.trim().length === 0) {
                errors.push({
                    attribute: "email",
                    message: "Email is required",
                });
                totalError++;
            }
            if (item.phone_number.trim().length === 0) {
                errors.push({
                    attribute: "phone_number",
                    message: "Phone number is required",
                });
                totalError++;
            }
            if (item.class.trim().length === 0) {
                errors.push({
                    attribute: "class",
                    message: "Class is required",
                });
                totalError++;
            }

            return {
                ...item,
                error: errors,
            };
        });

        setTicket(updatedTickets);

        if (totalError == 0) {
            setConfirmed(value);
        }
    };

    const ticketSummary = ticket.reduce(
        (acc, item) => {
            if (item.class === "Economy") {
                acc.economy += 1;
            } else if (item.class === "Executive") {
                acc.executive += 1;
            }
            return acc;
        },
        { economy: 0, executive: 0 }
    );

    const handleCheckout = () => {};

    return (
        <div className="flex m-10 flex-col gap-5">
            <div className="flex flex-col gap-5">
                <h1>Booking Train List</h1>
                {ticket.map((item, idx: number) => {
                    return (
                        <div className="flex flex-col gap-5" key={idx}>
                            <h1>{idx + 1} Passenger detail</h1>
                            <div className="flow-root">
                                <dl className="-my-3 divide-y divide-gray-200 rounded border border-gray-200 text-sm dark:divide-gray-700 dark:border-gray-800">
                                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                        <dt className="font-medium text-gray-900 dark:text-white">
                                            Passenger Name
                                        </dt>

                                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                            {idx && !confirmed ? (
                                                <TextField
                                                    id="outlined-basic"
                                                    label="Name"
                                                    variant="outlined"
                                                    name="name"
                                                    value={item.name}
                                                    onChange={(e) =>
                                                        handleChangeInput(
                                                            e,
                                                            idx,
                                                            "name"
                                                        )
                                                    }
                                                />
                                            ) : (
                                                item.name
                                            )}
                                            <strong className="font-bold text-red-600 text-center">
                                                {item.error.map((value) => {
                                                    if (
                                                        value.attribute ==
                                                        "name"
                                                    ) {
                                                        return value.message;
                                                    }
                                                })}
                                            </strong>
                                        </dd>
                                    </div>

                                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                        <dt className="font-medium text-gray-900 dark:text-white">
                                            Passenger Email
                                        </dt>

                                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                            {idx && !confirmed ? (
                                                <TextField
                                                    id="outlined-basic"
                                                    label="Email"
                                                    variant="outlined"
                                                    name="email"
                                                    type="email"
                                                    value={item.email}
                                                    onChange={(e) =>
                                                        handleChangeInput(
                                                            e,
                                                            idx,
                                                            "email"
                                                        )
                                                    }
                                                />
                                            ) : (
                                                item.email
                                            )}
                                            <strong className="font-bold text-red-600 text-center">
                                                {item.error.map((value) => {
                                                    if (
                                                        value.attribute ==
                                                        "email"
                                                    ) {
                                                        return value.message;
                                                    }
                                                })}
                                            </strong>
                                        </dd>
                                    </div>

                                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                        <dt className="font-medium text-gray-900 dark:text-white">
                                            Passenger Phone Number
                                        </dt>

                                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                            {!confirmed ? (
                                                <TextField
                                                    id="outlined-basic"
                                                    label="Phone Number"
                                                    variant="outlined"
                                                    name="phone_number"
                                                    value={item.phone_number}
                                                    // https://react.dev/learn/updating-arrays-in-state#replacing-items-in-an-array
                                                    onChange={(e) =>
                                                        handleChangeInput(
                                                            e,
                                                            idx,
                                                            "phone_number"
                                                        )
                                                    }
                                                />
                                            ) : (
                                                item.phone_number
                                            )}
                                            <strong className="font-bold text-red-600 text-center">
                                                {item.error.map((value) => {
                                                    if (
                                                        value.attribute ==
                                                        "phone_number"
                                                    ) {
                                                        return value.message;
                                                    }
                                                })}
                                            </strong>
                                        </dd>
                                    </div>

                                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                        <dt className="font-medium text-gray-900 dark:text-white">
                                            Class
                                        </dt>

                                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                            {!confirmed ? (
                                                <div>
                                                    <InputLabel id="demo-simple-select-label">
                                                        Class
                                                    </InputLabel>
                                                    <Select
                                                        labelId="demo-simple-select-label"
                                                        id="demo-simple-select"
                                                        value={item.class}
                                                        label="Class"
                                                        name="class"
                                                        onChange={(e) =>
                                                            handleSelectChange(
                                                                e,
                                                                idx,
                                                                "class"
                                                            )
                                                        }
                                                    >
                                                        <MenuItem value="Economy">
                                                            Economy
                                                        </MenuItem>
                                                        <MenuItem value="Executive">
                                                            Executive
                                                        </MenuItem>
                                                    </Select>
                                                </div>
                                            ) : (
                                                item.class
                                            )}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            {idx && !confirmed ? (
                                <Button
                                    variant="contained"
                                    className="w-xl self-center"
                                    color="warning"
                                    onClick={() =>
                                        handleDeletePassengerTicket(item.id)
                                    }
                                >
                                    Delete
                                </Button>
                            ) : null}
                        </div>
                    );
                })}
                {!confirmed ? (
                    <Button
                        className="w-xl self-center"
                        variant="outlined"
                        onClick={() => addMorePassenger(ticket.length + 1)}
                    >
                        + Add Passenger
                    </Button>
                ) : (
                    <div className="mt-8 flex justify-end border-t border-gray-100 pt-8">
                        <div className="w-screen max-w-lg space-y-4">
                            <dl className="space-y-0.5 text-sm text-gray-700">
                                <div className="flex justify-between">
                                    <dt>Subtotal</dt>
                                    <dd>
                                        {new Intl.NumberFormat("id-ID", {
                                            style: "currency",
                                            currency: "IDR",
                                        }).format(1)}
                                    </dd>
                                </div>

                                {ticketSummary.economy > 0 ? (
                                    <div className="flex justify-between">
                                        <dt>Economy</dt>
                                        <dd>
                                            {ticketSummary.economy} x
                                            {new Intl.NumberFormat("id-ID", {
                                                style: "currency",
                                                currency: "IDR",
                                            }).format(price.economy)}
                                        </dd>
                                    </div>
                                ) : null}

                                {ticketSummary.executive > 0 ? (
                                    <div className="flex justify-between">
                                        <dt>Executive</dt>
                                        <dd>
                                            {ticketSummary.executive} x
                                            {new Intl.NumberFormat("id-ID", {
                                                style: "currency",
                                                currency: "IDR",
                                            }).format(price.executive)}
                                        </dd>
                                    </div>
                                ) : null}

                                <div className="flex justify-between !text-base font-medium">
                                    <dt>Total</dt>
                                    <dd>
                                        {new Intl.NumberFormat("id-ID", {
                                            style: "currency",
                                            currency: "IDR",
                                        }).format(
                                            ticketSummary.economy *
                                                price.economy +
                                                ticketSummary.executive *
                                                    price.executive
                                        )}
                                    </dd>
                                </div>
                            </dl>

                            <div className="flex justify-end">
                                <Button
                                    onClick={handleCheckout}
                                    color="success"
                                    variant="contained"
                                >
                                    Confirm Booking
                                </Button>
                            </div>
                        </div>
                    </div>
                )}
            </div>
            <Button
                variant="contained"
                className="w-xl self-center"
                color={!confirmed ? "primary" : "error"}
                onClick={() => confirmedData(!confirmed)}
            >
                {!confirmed ? "Confirmed" : "Cancel"}
            </Button>
        </div>
    );
}
