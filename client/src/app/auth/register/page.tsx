"use client";
import { getUserInfo, register } from "@/api/auth";
import Link from "next/link";
import { redirect } from "next/navigation";
import { FormEvent, useEffect, useState } from "react";

export default function Register() {
    const [form, setForm] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });
    const [error, setError] = useState("");
    const [isLoading, setIsLoading] = useState(false);

    const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        setIsLoading(true);
        setError("");

        try {
            const response = await register({
                name: form.name,
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation,
            });

            const errorStatus = response.status;
            console.log("errorStatus", errorStatus);
            if (errorStatus === 422) {
                setError("Email or Password is incorrect!");
            } else if (errorStatus === 404 || errorStatus === 401) {
                setError("unauthorized access");
            } else if (errorStatus === 500) {
                setError("server error");
            } else if (errorStatus === 204 || errorStatus === 200) {
                window.location.reload();
            }
        } catch (err) {
            console.error("Login error:", err);
        } finally {
            setIsLoading(false);
        }
    };

    // check if user already logged in
    useEffect(() => {
        getUserInfo().then((response) => {
            const Status = response.status;
            if (Status === 200) {
                const isAdmin = response.data.isAdmin;
                if (isAdmin) {
                    redirect("/dashboard");
                } else if (!isAdmin) {
                    redirect("/");
                }
            } else if (Status === 401) {
                setError("unauthorized access");
            } else if (Status === 404) {
                setError("user not found");
            } else if (Status === 500) {
                setError("server error");
            }
        })
    }, []);

    return (
        <div
            className="flex h-screen justify-end bg-cover bg-center"
            style={{
                backgroundImage: "url('/login-train.jpg')"
            }}
        >
            <div className="flex h-full w-1/2 flex-col items-start justify-center gap-10 rounded-l-[3rem] bg-white px-20 py-60 text-3xl font-bold text-black">
                <div className="flex flex-col gap-3">
                    <div className="text-5xl text-[#0C4177]">Welcome Back</div>
                    <div className="text-lg font-medium text-[#353535]">
                        Please input your credentials to use the feature
                    </div>
                </div>

                <form
                    onSubmit={handleSubmit}
                    className="flex w-full flex-col gap-10"
                >
                    <div>
                        <label
                            htmlFor="name"
                            className="block text-lg font-medium text-gray-700"
                        >
                            Name
                        </label>
                        <input
                            type="name"
                            id="name"
                            className="mt-1  w-full rounded-md border bg-[#3F79B4]/10 px-3 py-2 shadow-sm sm:text-sm"
                            value={form.name}
                            onChange={(e) => {
                                setForm((prev) => ({
                                    ...prev,
                                    name: e.target.value,
                                }));
                            }}
                            required
                        />
                    </div>

                    <div>
                        <label
                            htmlFor="email"
                            className="block text-lg font-medium text-gray-700"
                        >
                            Email address
                        </label>
                        <input
                            type="email"
                            id="email"
                            className="mt-1  w-full rounded-md border bg-[#3F79B4]/10 px-3 py-2 shadow-sm sm:text-sm"
                            value={form.email}
                            onChange={(e) => {
                                setForm((prev) => ({
                                    ...prev,
                                    email: e.target.value,
                                }));
                            }}
                            required
                        />
                    </div>

                    <div>
                        <label
                            htmlFor="password"
                            className="block text-lg font-medium text-gray-700"
                        >
                            Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            value={form.password}
                            onChange={(e) => {
                                setForm((prev) => ({
                                    ...prev,
                                    password: e.target.value,
                                }));
                            }}
                            required
                        />
                    </div>

                    <div>
                        <label
                            htmlFor="password_confirmation"
                            className="block text-lg font-medium text-gray-700"
                        >
                            Password Confirmation
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            value={form.password_confirmation}
                            onChange={(e) => {
                                setForm((prev) => ({
                                    ...prev,
                                    password_confirmation: e.target.value,
                                }));
                            }}
                            required
                        />
                    </div>

                    <div>
                        {error && (
                            <div className="mb-4 text-sm text-red-600">
                                {error}
                            </div>
                        )}

                        <button
                            type="submit"
                            className="flex w-full justify-center rounded-md border border-transparent bg-[#0C4177] py-3 text-sm font-medium text-white shadow-sm"
                            disabled={isLoading}
                        >
                            {isLoading ? "Registering..." : "Register"}
                        </button>

                        <Link
                            href="/auth/login"
                            className="mt-4 text-center text-sm font-medium text-[#0C4177]"
                        >
                            have Account ?
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    );
}
