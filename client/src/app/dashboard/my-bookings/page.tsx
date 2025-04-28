"use client";
import {
    getUserSessionBookingTicket,
    UserSessionBookingTicket,
    userTicketProps,
} from "@/api/bookingTicket";
import { cancelBookingTicket } from "@/api/paymentTicket";
import Navbar from "@/components/home/navbar";
import { Box, Button, Modal } from "@mui/material";
import Image from "next/image";
import { useEffect, useState } from "react";

const style = {
    position: "absolute",
    top: "50%",
    left: "50%",
    transform: "translate(-50%, -50%)",
    width: 400,
    bgcolor: "background.paper",
    border: "2px solid #000",
    boxShadow: 24,
    p: 4,
};

export default function MyBookingsPage() {
    const [data, setData] = useState<UserSessionBookingTicket[]>([]);
    const [modalData, setModalData] = useState<userTicketProps[]>([]);

    useEffect(() => {
        getUserSessionBookingTicket().then((response) => {
            setData(response.data);
        });
    }, []);

    const handleCancelPayment = async (ticketID: string) => {
        await cancelBookingTicket(ticketID)
            .then((response) => {
                if (response.status == 200) {
                    window.location.reload();
                }
            })
            .catch((error) => {
                console.error("Error while canceling payment", error);
            });
    };

    const [open, setOpen] = useState(false);
    const handleOpen = (data: userTicketProps[]) => {
        setOpen(true);
        setModalData(data);
    };
    const handleClose = () => setOpen(false);
    return (
        <div>
            <Navbar />
            <Modal
                open={open}
                onClose={handleClose}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <div className="flex flex-col gap-5">
                        {modalData.map((item, idx) => {
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
                                                    {item.name}
                                                </dd>
                                            </div>

                                            <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                                <dt className="font-medium text-gray-900 dark:text-white">
                                                    Passenger Email
                                                </dt>

                                                <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                    {item.email}
                                                </dd>
                                            </div>

                                            <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                                <dt className="font-medium text-gray-900 dark:text-white">
                                                    Passenger Phone Number
                                                </dt>

                                                <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                    {item.phone_number}
                                                </dd>
                                            </div>

                                            <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                                <dt className="font-medium text-gray-900 dark:text-white">
                                                    Class
                                                </dt>

                                                <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                    {item.class}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                </Box>
            </Modal>
            {/* show booking list of the user */}
            <div className="flex flex-col gap-20 mt-30">
                {data.map((data, idx) => {
                    let totalTicketPrice = 0;
                    data.booking_tickets.map((item) => {
                        totalTicketPrice +=
                            item.class == "Economy"
                                ? data.train.economy_price
                                : data.train.executive_price;
                    });
                    return (
                        <div key={idx} className="flex flex-col">
                            <dl className="-my-3 divide-y divide-gray-200 rounded border border-gray-200 text-sm dark:divide-gray-700 dark:border-gray-800">
                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Train Name
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {data.train.name}
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Train Image
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        <Image
                                            // TODO: change this using {train.trainImage}
                                            src="/login-train.jpg"
                                            width={30}
                                            height={30}
                                            alt="train img"
                                        />
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Description
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {data.train.description}
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Departure Time
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {data.train.departure_time}
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Departure Location
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {data.train.origin_train_station.name}
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Destination Location
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {
                                            data.train.destination_train_station
                                                .name
                                        }
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Status Payment
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {data.payment_tickets.status}
                                    </dd>
                                </div>

                                <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                    <dt className="font-medium text-gray-900 dark:text-white">
                                        Total Payment
                                    </dt>

                                    <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                        {new Intl.NumberFormat("id-ID", {
                                            style: "currency",
                                            currency: "IDR",
                                        }).format(totalTicketPrice)}
                                    </dd>
                                </div>
                            </dl>
                            {data.payment_tickets.status == "Unpaid" ? (
                                <div>
                                    <div className="flex justify-around items-center mt-5">
                                        <div className="flex justify-center items-center">
                                            <div className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                <Button
                                                    variant="contained"
                                                    color="error"
                                                    onClick={() =>
                                                        handleCancelPayment(
                                                            data.id
                                                        )
                                                    }
                                                >
                                                    Cancel Payment
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="flex justify-around items-center text-gray-700 sm:col-span-2 dark:text-gray-200">
                                            <Button
                                                href={`/dashboard/my-bookings/upload-payment-proof/${data.id}`}
                                                variant="contained"
                                                color="success"
                                            >
                                                Pay Now
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                            ) : data.payment_tickets.status === "Paid" ? (
                                <div className="flex justify-around items-center text-gray-700 sm:col-span-2 dark:text-gray-200">
                                    <div className="flex justify-around items-center mt-5">
                                        <Button
                                            onClick={() =>
                                                handleOpen(data.booking_tickets)
                                            }
                                            variant="contained"
                                            color="success"
                                        >
                                            Order Summary
                                        </Button>
                                    </div>
                                </div>
                            ) : null}
                        </div>
                    );
                })}
            </div>
        </div>
    );
}
