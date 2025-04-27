"use client";
import { getTrainByID, updateBookingTrain } from "@/api/bookingTrain";
import { useEffect, useState } from "react";
import { useRouter, useSearchParams } from "next/navigation";
import { getListStation, StationProps } from "@/api/trainStation";
import { getUserInfo } from "@/api/auth";
import Image from "next/image";

interface inputProps {
    name: string;
    train_image: File | null;
    description: string;
    departure_time: string;
    origin_train_station_id: string;
    destination_train_station_id: string;
    economy_price: number;
    executive_price: number;
    seats_available: number;
}
interface errorProps {
    name: Array<string> | null;
    train_image: Array<string> | null;
    description: Array<string> | null;
    departure_time: Array<string> | null;
    origin_train_station_id: Array<string> | null;
    destination_train_station_id: Array<string> | null;
    economy_price: Array<string> | null;
    executive_price: Array<string> | null;
    seats_available: Array<string> | null;
}

export default function BookingTrainUpdatePage() {
    const [form, setForm] = useState<inputProps>({
        name: "",
        train_image: null,
        description: "",
        departure_time: "",
        origin_train_station_id: "",
        destination_train_station_id: "",
        economy_price: 0,
        executive_price: 0,
        seats_available: 0,
    });
    const searchParams = useSearchParams();
    const trainID = searchParams.get("trainID") || "";
    const [station, setStation] = useState<StationProps[]>([]);
    const [imageURL, setImageURL] = useState("");
    const [error, setError] = useState<errorProps>({
        name: null,
        train_image: null,
        description: null,
        departure_time: null,
        origin_train_station_id: null,
        destination_train_station_id: null,
        economy_price: null,
        executive_price: null,
        seats_available: null,
    });
    const router = useRouter();

    useEffect(() => {
        getUserInfo().then((response) => {
            const Status = response.status;
            if (Status === 200) {
                const isAdmin = response.data.isAdmin;
                if (!isAdmin) {
                    router.push("/");
                }
            }
        });
        getTrainByID(trainID).then(async (response) => {
            const data = response.data;
            setForm({
                name: data.name,
                train_image: null,
                description: data.description,
                departure_time: data.departure_time,
                origin_train_station_id: data.origin_train_station.id,
                destination_train_station_id: data.destination_train_station.id,
                economy_price: data.economy_price,
                executive_price: data.executive_price,
                seats_available: data.seats_available,
            });
            setImageURL(data.train_image);
        });
        getListStation().then((response) => {
            setStation(response.data);
        });
    }, [router, trainID]);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        const formData = new FormData();

        for (const [key, value] of Object.entries(form)) {
            console.log(key, value)
            formData.append(key, value);
        }
        updateBookingTrain(formData, trainID)
            .then((response) => {
                const status = response.status;
                if (status === 200 || status === 201) {
                    router.push("/dashboard");
                }
            })
            .catch((error) => {
                if (error.status === 401 || error.status === 403) {
                    setError({
                        name: ["ure not admin"],
                        train_image: ["ure not admin"],
                        description: ["ure not admin"],
                        departure_time: ["ure not admin"],
                        origin_train_station_id: ["ure not admin"],
                        destination_train_station_id: ["ure not admin"],
                        economy_price: ["ure not admin"],
                        executive_price: ["ure not admin"],
                        seats_available: ["ure not admin"],
                    });
                } else {
                    setError(error.response.data.errors);
                }
            });
    };

    return (
        <form className="max-w-lg mx-auto" onSubmit={handleSubmit}>
            <div className="mb-5">
                <label
                    htmlFor="name"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Train name
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value={form.name}
                    onChange={(e) => setForm({ ...form, name: e.target.value })}
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cargo Express"
                    required
                />
                <strong className="font-bold text-red-600">{error.name}</strong>
            </div>
            <div className="mb-5">
                {form.train_image ? (
                    <Image
                        src={URL.createObjectURL(form.train_image)}
                        alt="Uploaded Poster"
                        width={700}
                        height={0}
                        className="rounded-md object-cover xl:h-[400px]"
                        priority={true}
                    />
                ) : null}
                {imageURL && !form.train_image ? (
                    <Image
                        src={imageURL}
                        alt="Uploaded Poster"
                        width={700}
                        height={0}
                        className="rounded-md object-cover xl:h-[400px]"
                        priority={true}
                    />
                ) : null}

                <label
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    htmlFor="train_image"
                >
                    Upload train image
                </label>
                <input
                    id="train_image"
                    onChange={(e) =>
                        setForm({
                            ...form,
                            train_image: e.target.files
                                ? e.target.files[0]
                                : null,
                        })
                    }
                    accept="image/*"
                    placeholder="Upload train image"
                    required
                    name="train_image"
                    className="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help"
                    type="file"
                />
                <strong className="font-bold text-red-600">
                    {error.train_image}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="description"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Train Description
                </label>
                <textarea
                    rows={4}
                    placeholder="Write a short description about the train"
                    name="description"
                    value={form.description}
                    onChange={(e) =>
                        setForm({ ...form, description: e.target.value })
                    }
                    id="description"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />

                <strong className="font-bold text-red-600">
                    {error.description}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="departure_time"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Train derparture time
                </label>
                <input
                    name="departure_time"
                    value={form.departure_time}
                    onChange={(e) =>
                        setForm({ ...form, departure_time: e.target.value })
                    }
                    type="datetime-local"
                    id="departure_time"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
                <strong className="font-bold text-red-600">
                    {error.departure_time}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="origin_train_station_id"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Select departure station
                </label>
                <select
                    id="origin_train_station_id"
                    name="origin_train_station_id"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                    value={form.origin_train_station_id || ""}
                    onChange={(e) =>
                        setForm({
                            ...form,
                            origin_train_station_id: e.target.value,
                        })
                    }
                >
                    <option value="" disabled hidden>
                        Choose a Station
                    </option>
                    {station.map((props) => (
                        <option key={props.id} value={props.id}>
                            {props.name}
                        </option>
                    ))}
                </select>
                <strong className="font-bold text-red-600">
                    {error.origin_train_station_id}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="destination_train_station_id"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Select destination station
                </label>
                <select
                    id="destination_train_station_id"
                    name="destination_train_station_id"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                    value={form.destination_train_station_id || ""}
                    onChange={(e) =>
                        setForm({
                            ...form,
                            destination_train_station_id: e.target.value,
                        })
                    }
                >
                    <option value="" disabled hidden>
                        Choose a Station
                    </option>
                    {station.map((props) => (
                        <option key={props.id} value={props.id}>
                            {props.name}
                        </option>
                    ))}
                </select>
                <strong className="font-bold text-red-600">
                    {error.destination_train_station_id}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="economy_price"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Economy Price
                </label>
                <input
                    type="number"
                    id="economy_price"
                    name="economy_price"
                    value={form.economy_price}
                    onChange={(e) =>
                        setForm({
                            ...form,
                            economy_price: Number(e.target.value),
                        })
                    }
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1000000"
                    required
                />
                <strong className="font-bold text-red-600">
                    {error.economy_price}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="executive_price"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Executive Price
                </label>
                <input
                    type="number"
                    id="executive_price"
                    name="executive_price"
                    value={form.executive_price}
                    onChange={(e) =>
                        setForm({
                            ...form,
                            executive_price: Number(e.target.value),
                        })
                    }
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1000000"
                    required
                />
                <strong className="font-bold text-red-600">
                    {error.executive_price}
                </strong>
            </div>
            <div className="mb-5">
                <label
                    htmlFor="seats_available"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Seats Available
                </label>
                <input
                    type="number"
                    id="seats_available"
                    name="seats_available"
                    value={form.seats_available}
                    onChange={(e) =>
                        setForm({
                            ...form,
                            seats_available: Number(e.target.value),
                        })
                    }
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1000000"
                    required
                />
                <strong className="font-bold text-red-600">
                    {error.executive_price}
                </strong>
            </div>
            <button
                type="submit"
                className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Submit
            </button>
        </form>
    );
}
