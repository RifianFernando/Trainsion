"use client";
import {
    getUserSessionBookingTicketByID,
    userTicketProps,
} from "@/api/bookingTicket";
import { payBookingTicket } from "@/api/paymentTicket";
import { Button } from "@mui/material";
import Image from "next/image";
import { use, useEffect, useState } from "react";
import { redirect } from "next/navigation";

export default function UploadPaymentProofPage({
    params,
}: {
    params: Promise<{ btID: string }>;
}) {
    const { btID } = use(params);
    const [ticket, setTicket] = useState<userTicketProps[]>([]);
    const [paymentTicket, setPaymentTicket] = useState<{
        payment_proof_img: null | File;
        payment_tickets_id: string;
    }>({
        payment_proof_img: null,
        payment_tickets_id: "",
    });
    const [ticketPrice, setTicketPrice] = useState<{
        economy: number;
        executive: number;
    }>();
    const [errorMsg, setErrorMsg] = useState("");
    let totalBuy = 0;

    useEffect(() => {
        getUserSessionBookingTicketByID(btID).then((response) => {
            const bookingTicketInfo = response.data.booking_tickets;
            setTicketPrice({
                economy: response.data.train.economy_price,
                executive: response.data.train.executive_price,
            });
            setPaymentTicket({
                payment_tickets_id: response.data.payment_tickets.id,
                payment_proof_img: null,
            });
            setTicket(bookingTicketInfo);
        });
    }, [btID]);

    const handleSubmitPayment = async (e: React.FormEvent) => {
        e.preventDefault();
        const formData = new FormData();
        if (
            paymentTicket.payment_tickets_id !== "" &&
            paymentTicket.payment_proof_img != null
        ) {
            formData.append(
                "payment_tickets_id",
                paymentTicket.payment_tickets_id
            );
            formData.append(
                "payment_proof_img",
                paymentTicket.payment_proof_img
            );
        }
        await payBookingTicket(formData)
            .then((response) => {
                if (response.status == 200) {
                    redirect("/dashboard/my-bookings");
                }
            })
            .catch((error) => {
                if (error.status === 401 || error.status === 403) {
                    setErrorMsg('unauthorized');
                } else {
                    setErrorMsg(
                        error.response.data.errors.payment_proof_img[0]
                    );
                }
            });
    };

    return (
        <form onSubmit={(e) => handleSubmitPayment(e)}>
            <div className="mt-8 flex justify-center border-t border-gray-100 pt-8">
                <div className="w-screen max-w-lg space-y-4">
                    <div className="flex flex-col gap-5">
                        <h1>Ticket Detail</h1>
                        {ticket.map((item, idx: number) => {
                            if (ticketPrice != undefined) {
                                totalBuy +=
                                    item.class == "Economy"
                                        ? ticketPrice.economy
                                        : ticketPrice.executive;
                            }
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

                                            <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                                <dt className="font-medium text-gray-900 dark:text-white">
                                                    Price
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
                    <dl className="space-y-0.5 text-sm text-gray-700">
                        <div className="flex justify-between !text-base font-medium">
                            <dt>Total</dt>
                            <dd>
                                {new Intl.NumberFormat("id-ID", {
                                    style: "currency",
                                    currency: "IDR",
                                }).format(totalBuy)}
                            </dd>
                        </div>
                    </dl>

                    <label
                        htmlFor="payment_proof_img"
                        className="flex flex-col items-center rounded border border-gray-300 p-4 text-gray-900 shadow-sm sm:p-6"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            strokeWidth="1.5"
                            stroke="currentColor"
                            className="size-6"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75"
                            />
                        </svg>

                        <span className="mt-4 font-medium">
                            {" "}
                            Upload your file(s){" "}
                        </span>

                        <span className="mt-2 inline-block rounded border border-gray-200 bg-gray-50 px-3 py-1.5 text-center text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-100">
                            Browse files
                        </span>
                        {paymentTicket.payment_proof_img ? (
                            <Image
                                src={URL.createObjectURL(
                                    paymentTicket.payment_proof_img
                                )}
                                alt="Uploaded Poster"
                                width={700}
                                height={0}
                                className="rounded-md object-cover xl:h-[400px]"
                                priority={true}
                            />
                        ) : null}
                        <input
                            multiple
                            type="file"
                            id="payment_proof_img"
                            className="sr-only"
                            name="payment_proof_img"
                            onChange={(e) =>
                                setPaymentTicket({
                                    ...paymentTicket,
                                    payment_proof_img: e.target.files
                                        ? e.target.files[0]
                                        : null,
                                })
                            }
                        />
                        <strong className="font-bold text-red-600">
                            {errorMsg}
                        </strong>
                    </label>

                    <div className="flex justify-end">
                        <Button
                            color="success"
                            variant="contained"
                            type="submit"
                        >
                            Upload Payment Proof
                        </Button>
                    </div>
                </div>
            </div>
        </form>
    );
}
