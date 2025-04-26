import {  BookingTrainList, getTrainByID } from "@/api/bookingTrain";

export default async function Page({
    params,
}: {
    params: Promise<{ param: string }>;
}) {
    const { param } = await params;
    const response = await getTrainByID(param)
    const train: BookingTrainList = response.data;

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        // const formData = new FormData();

        // for (const [key, value] of Object.entries(form)) {
        //     formData.append(key, value);
        // }
        // createBookingTrain(formData)
        //     .then((response) => {
        //         const status = response.status;
        //         if (status === 200 || status === 201) {
        //             router.push("/dashboard");
        //         }
        //     })
        //     .catch((error) => {
        //         if (error.status === 401) {
        //             router.push("/auth/login");
        //         } else {
        //             setError(error.response.data.errors);
        //         }
        //     });
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
                    defaultValue={train.name}
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cargo Express"
                    required
                />
                {/* <strong className="font-bold text-red-600">{error.name}</strong> */}
            </div>
            <div className="mb-5">
                <label
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    htmlFor="train_image"
                >
                    Upload train image
                </label>
                <input
                    id="train_image"
                    accept="image/*"
                    placeholder="Upload train image"
                    required
                    name="train_image"
                    className="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help"
                    type="file"
                />
                {/* <strong className="font-bold text-red-600">
                    {error.train_image}
                </strong> */}
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
                    defaultValue={train.description}
                    id="description"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />

                {/* <strong className="font-bold text-red-600">
                    {error.description}
                </strong> */}
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
                    defaultValue={train.departure_time}
                    type="datetime-local"
                    id="departure_time"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
                {/* <strong className="font-bold text-red-600">
                    {error.departure_time}
                </strong> */}
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
                    defaultValue={train.origin_train_station.id || ""}
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
                            economy_price: e.target.value,
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
                            executive_price: e.target.value,
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
                            seats_available: e.target.value,
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
