import { BookingTrainList, getTrainByID } from "@/api/bookingTrain";
import Image from "next/image";
import Link from "next/link";

interface paramProps {
    params: {
        trainID: string;
    };
}
export default async function DetailTrainPage(params: paramProps) {
    const data: BookingTrainList = await (
        await getTrainByID(params.params.trainID)
    ).data;
    return (
        <div className="flex m-10 flex-col gap-5">
            <h1>Detail Train</h1>
            <div className="flow-root">
                <dl className="-my-3 divide-y divide-gray-200 rounded border border-gray-200 text-sm dark:divide-gray-700 dark:border-gray-800">
                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Train Name
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {data.name}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Image
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <Image
                                src={data.train_image}
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
                            {data.description}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Departure Time
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {data.departure_time}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Departure Location
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {data.origin_train_station.name}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Destination Location
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {data.destination_train_station.name}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Economy Price
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR",
                            }).format(data.economy_price)}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Executive Price
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR",
                            }).format(data.executive_price)}
                        </dd>
                    </div>

                    <div className="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt className="font-medium text-gray-900 dark:text-white">
                            Seats Available
                        </dt>

                        <dd className="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            {data.seats_available}
                        </dd>
                    </div>
                </dl>
            </div>
            <div>
                {data.seats_available > 0 ? (
                    <Link href={`/detail-train/book/${data.id}`} className="flex justify-end">
                        <div className="inline-block bg-blue-300 hover:bg-blue-400 text-black font-semibold py-2 px-4 rounded-md transition-all">
                            Book Now
                        </div>
                    </Link>
                ) : null}
            </div>
        </div>
    );
}
