import Link from "next/link";
import Navbar from "../home/navbar";
import { Button } from "@mui/material";

export default function Dashboard() {
    return (
        <div className="bg-gray-100 dark:bg-gray-900 min-h-screen">
            <Navbar />
            <section className="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-16">
                <div className="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div className="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div className="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div className="w-full md:w-1/2">
                                <form className="flex items-center">
                                    <label
                                        htmlFor="simple-search"
                                        className="sr-only"
                                    >
                                        Search
                                    </label>
                                    <div className="relative w-full">
                                        <div className="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg
                                                aria-hidden="true"
                                                className="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    fillRule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clipRule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            id="simple-search"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search"
                                            required
                                        />
                                    </div>
                                </form>
                            </div>
                            <div className="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <Link
                                    href="/dashboard/booking-train/create"
                                    id="createProductModalButton"
                                    data-modal-target="createProductModal"
                                    data-modal-toggle="createProductModal"
                                    className="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                >
                                    <svg
                                        className="h-3.5 w-3.5 mr-2"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true"
                                    >
                                        <path
                                            clipRule="evenodd"
                                            fillRule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        />
                                    </svg>
                                    Add product
                                </Link>
                            </div>
                        </div>
                        <div className="overflow-x-auto">
                            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" className="px-4 py-4">
                                            Product name
                                        </th>
                                        <th scope="col" className="px-4 py-3">
                                            Category
                                        </th>
                                        <th scope="col" className="px-4 py-3">
                                            Brand
                                        </th>
                                        <th scope="col" className="px-4 py-3">
                                            Description
                                        </th>
                                        <th scope="col" className="px-4 py-3">
                                            Price
                                        </th>
                                        <th scope="col" className="px-4 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr className="border-b dark:border-gray-700">
                                        <th
                                            scope="row"
                                            className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Monitor BenQ EX2710Q
                                        </th>
                                        <td className="px-4 py-3">
                                            TV/Monitor
                                        </td>
                                        <td className="px-4 py-3">BenQ</td>
                                        <td className="px-4 py-3 max-w-[12rem] truncate">
                                            What is a product description? A
                                            product description describes a
                                            product.
                                        </td>
                                        <td className="px-4 py-3">$499</td>
                                        <td className="px-4 py-3 flex items-center justify-center gap-4">
                                            <Button
                                                variant="contained"
                                                title="Actions"
                                                id="monitor-benq-ex2710q-dropdown-button"
                                                data-dropdown-toggle="monitor-benq-ex2710q-dropdown"
                                                type="button"
                                            >
                                                Update
                                            </Button>
                                            <Button
                                                variant="contained"
                                                color="warning"
                                                id="monitor-benq-ex2710q-dropdown"
                                                aria-labelledby="monitor-benq-ex2710q-dropdown-button"
                                            >
                                                Delete
                                            </Button>
                                        </td>
                                    </tr>
                                    <tr className="border-b dark:border-gray-700">
                                        <th
                                            scope="row"
                                            className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Monitor BenQ EX2710Q
                                        </th>
                                        <td className="px-4 py-3">
                                            TV/Monitor
                                        </td>
                                        <td className="px-4 py-3">BenQ</td>
                                        <td className="px-4 py-3 max-w-[12rem] truncate">
                                            What is a product description? A
                                            product description describes a
                                            product.
                                        </td>
                                        <td className="px-4 py-3">$499</td>
                                        <td className="px-4 py-3 flex items-center justify-center gap-4">
                                            <Button
                                                variant="contained"
                                                title="Actions"
                                                id="monitor-benq-ex2710q-dropdown-button"
                                                data-dropdown-toggle="monitor-benq-ex2710q-dropdown"
                                                type="button"
                                            >
                                                Update
                                            </Button>
                                            <Button
                                                variant="contained"
                                                color="warning"
                                                id="monitor-benq-ex2710q-dropdown"
                                                aria-labelledby="monitor-benq-ex2710q-dropdown-button"
                                            >
                                                Delete
                                            </Button>
                                        </td>
                                    </tr>
                                    <tr className="border-b dark:border-gray-700">
                                        <th
                                            scope="row"
                                            className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Monitor BenQ EX2710Q
                                        </th>
                                        <td className="px-4 py-3">
                                            TV/Monitor
                                        </td>
                                        <td className="px-4 py-3">BenQ</td>
                                        <td className="px-4 py-3 max-w-[12rem] truncate">
                                            What is a product description? A
                                            product description describes a
                                            product.
                                        </td>
                                        <td className="px-4 py-3">$499</td>
                                        <td className="px-4 py-3 flex items-center justify-center gap-4">
                                            <Button
                                                variant="contained"
                                                title="Actions"
                                                id="monitor-benq-ex2710q-dropdown-button"
                                                data-dropdown-toggle="monitor-benq-ex2710q-dropdown"
                                                type="button"
                                            >
                                                Update
                                            </Button>
                                            <Button
                                                variant="contained"
                                                color="warning"
                                                id="monitor-benq-ex2710q-dropdown"
                                                aria-labelledby="monitor-benq-ex2710q-dropdown-button"
                                            >
                                                Delete
                                            </Button>
                                        </td>
                                    </tr>
                                    <tr className="border-b dark:border-gray-700">
                                        <th
                                            scope="row"
                                            className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Monitor BenQ EX2710Q
                                        </th>
                                        <td className="px-4 py-3">
                                            TV/Monitor
                                        </td>
                                        <td className="px-4 py-3">BenQ</td>
                                        <td className="px-4 py-3 max-w-[12rem] truncate">
                                            What is a product description? A
                                            product description describes a
                                            product.
                                        </td>
                                        <td className="px-4 py-3">$499</td>
                                        <td className="px-4 py-3 flex items-center justify-center gap-4">
                                            <Button
                                                variant="contained"
                                                title="Actions"
                                                id="monitor-benq-ex2710q-dropdown-button"
                                                data-dropdown-toggle="monitor-benq-ex2710q-dropdown"
                                                type="button"
                                            >
                                                Update
                                            </Button>
                                            <Button
                                                variant="contained"
                                                color="warning"
                                                id="monitor-benq-ex2710q-dropdown"
                                                aria-labelledby="monitor-benq-ex2710q-dropdown-button"
                                            >
                                                Delete
                                            </Button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}
