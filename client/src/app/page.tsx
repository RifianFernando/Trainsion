import Image from "next/image";
import Navbar from '../components/home/navbar';
import { BookingTrainList, getTrainList } from "@/api/bookingTrain";
import { Button } from "@mui/material";

export default async function Home() {
    const trains = await getTrainList();
    return (
        <div className="bg-white">
            <Navbar />
            <div className="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 className="text-2xl font-bold tracking-tight text-gray-900">
                    Train List
                </h2>

                <div className="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    {trains.data?.map((trains: BookingTrainList) => (
                        <div key={trains.id} className="group relative">
                            <Image
                                aria-hidden
                                src={trains.train_image}
                                alt={`image of ${trains.name}`}
                                width={16}
                                height={16}
                                className="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80"
                            />
                            <div className="mt-4 flex justify-between">
                                <div>
                                    <h3 className="text-sm text-gray-700">
                                        <span
                                            aria-hidden="true"
                                            className="absolute inset-0"
                                        />
                                        {trains.name}
                                    </h3>
                                    <p className="mt-1 text-sm text-gray-500">
                                        Departure {trains.departure_time}
                                    </p>
                                </div>
                                <p className="text-sm font-medium text-gray-900">
                                    start from{" "}
                                    {new Intl.NumberFormat("id-ID", {
                                        style: "currency",
                                        currency: "IDR",
                                    }).format(trains.economy_price)}
                                </p>
                            </div>
                            <div className="mt-4 flex justify-between">
                                <Button href={`/detail-train/${trains.id}`} variant="contained">Select Train</Button>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
