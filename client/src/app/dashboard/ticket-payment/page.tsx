"use client";
import {
    getAllBookingTicket,
    UserSessionBookingTicket,
} from "@/api/bookingTicket";
import { handleRejectAndAcceptPaymentStatusApi } from "@/api/paymentTicket";
import Navbar from "@/components/home/navbar";
import { Button } from "@mui/material";
import Image from "next/image";
import { useEffect, useState } from "react";

export default function MyBookingsPage() {
    const [data, setData] = useState<UserSessionBookingTicket[]>([]);
    useEffect(() => {
        getAllBookingTicket().then((response) => {
            setData(response.data);
        });
    }, []);

    const handleRejectAndAcceptPaymentStatus = async (
        ticketID: string,
        type: "reject" | "accept"
    ) => {
        await handleRejectAndAcceptPaymentStatusApi(ticketID, type)
            .then((response) => {
                if (response.status == 200) {
                    window.location.reload();
                }
            })
            .catch((error) => {
                console.error("Error while canceling payment", error);
            });
    };

    return (
        <div>
            <Navbar />
            {/* show booking list of the user */}
            <div className="flex m-10 flex-col gap-5">
                <div className="flex flex-col gap-5 mt-10">
                    <h1>Booking Train List</h1>
                    <div className="flex flex-col gap-20 mt-10">
                        {data.map((data, idx) => {
                            let totalTicketPrice = 0;
                            data.booking_tickets.map((item) => {
                                totalTicketPrice +=
                                    item.class == "Economy"
                                        ? data.train.economy_price
                                        : data.train.executive_price;
                            });
                            return (
                                <div key={idx} className="flex flex-col gap-5">
                                    <h1>
                                        Reserved By Account Name:{" "}
                                        {data.booking_tickets[0].name}
                                    </h1>
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
                                                {
                                                    data.train
                                                        .origin_train_station
                                                        .name
                                                }
                                            </dd>
                                        </div>

                                        <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                            <dt className="font-medium text-gray-900 dark:text-white">
                                                Destination Location
                                            </dt>

                                            <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                {
                                                    data.train
                                                        .destination_train_station
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
                                                {new Intl.NumberFormat(
                                                    "id-ID",
                                                    {
                                                        style: "currency",
                                                        currency: "IDR",
                                                    }
                                                ).format(totalTicketPrice)}
                                            </dd>
                                        </div>

                                        <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                            <dt className="font-medium text-gray-900 dark:text-white">
                                                Payment Proof
                                            </dt>

                                            <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                {data.payment_tickets.status ==
                                                "Pending" ? (
                                                    <Image
                                                        src={
                                                            data.payment_tickets
                                                                .payment_proof_img
                                                        }
                                                        width={200}
                                                        height={200}
                                                        alt="train img"
                                                    />
                                                ) : (
                                                    data.payment_tickets.status
                                                )}
                                            </dd>
                                        </div>
                                    </dl>
                                    {data.payment_tickets.status ==
                                    "Pending" ? (
                                        <div>
                                            <div className="flex justify-around items-center mt-5">
                                                <div className="flex justify-center items-center">
                                                    <div className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                        <Button
                                                            variant="contained"
                                                            color="error"
                                                            onClick={() =>
                                                                handleRejectAndAcceptPaymentStatus(
                                                                    data.id,
                                                                    "reject"
                                                                )
                                                            }
                                                        >
                                                            Reject Payment
                                                        </Button>
                                                    </div>
                                                </div>

                                                <div className="flex justify-around items-center text-gray-700 sm:col-span-2 dark:text-gray-200">
                                                    <Button
                                                        variant="contained"
                                                        color="success"
                                                        onClick={() =>
                                                            handleRejectAndAcceptPaymentStatus(
                                                                data.id,
                                                                "accept"
                                                            )
                                                        }
                                                    >
                                                        Accept Payment
                                                    </Button>
                                                </div>
                                            </div>
                                        </div>
                                    ) : null}
                                </div>
                            );
                        })}
                    </div>
                </div>
            </div>
        </div>
    );
}
