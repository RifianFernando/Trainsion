import { AxiosResponse } from "axios";
import { api } from "./axios";

function csrf() {
    return api.get("/sanctum/csrf-cookie", {
        withCredentials: true,
    });
}

export const login = async (credentials: {
    email: string;
    password: string;
}) => {
    try {
        await csrf();
        const response = await api.post("/login", credentials, {
            withCredentials: true,
            headers: {
                "X-XSRF-TOKEN": decodeURIComponent(
                    document.cookie
                        .split(";")
                        .find((cookie) =>
                            cookie.trim().startsWith("XSRF-TOKEN")
                        )
                        ?.split("=")[1] || ""
                ),
            },
        });
        if (response.status === 200 || response.status === 204) {
            const userData = await getUserInfo();
            sessionStorage.setItem("user", JSON.stringify(userData.data));
            return response;
        } else if (response.status === 401) {
            throw new Error("Invalid credentials");
        } else if (response.status === 422) {
            throw new Error("Invalid credentials");
        } else {
            throw new Error("Registration failed");
        }
    } catch (error) {
        console.error("Login error:", error);
        throw error;
    }
};

export const register = async (data: {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}) => {
    try {
        await csrf();
        const response = await api.post("/register", data, {
            withCredentials: true,
            headers: {
                "X-XSRF-TOKEN": decodeURIComponent(
                    document.cookie
                        .split(";")
                        .find((cookie) =>
                            cookie.trim().startsWith("XSRF-TOKEN")
                        )
                        ?.split("=")[1] || ""
                ),
            },
        });
        if (response.status === 200 || response.status === 204) {
            const userData = await getUserInfo();
            sessionStorage.setItem("user", JSON.stringify(userData.data));
            return response;
        } else if (response.status === 422) {
            throw new Error("Invalid credentials");
        } else {
            throw new Error("Registration failed");
        }
    } catch (error) {
        console.error("Registration error:", error);
        throw error;
    }
};

export const logout = async () => {
    try {
        await csrf();
        const response = await api.post(
            "/logout",
            {},
            {
                withCredentials: true,
                headers: {
                    "X-XSRF-TOKEN": decodeURIComponent(
                        document.cookie
                            .split(";")
                            .find((cookie) =>
                                cookie.trim().startsWith("XSRF-TOKEN")
                            )
                            ?.split("=")[1] || ""
                    ),
                },
            }
        );
        if (response.status === 200 || response.status === 204) {
            sessionStorage.removeItem("user");
            return response;
        } else if (response.status === 401) {
            throw new Error("Invalid credentials");
        } else {
            throw new Error("Logout failed");
        }
    } catch (error) {
        console.error("Logout error:", error);
        throw error;
    }
};

export const forgetPassword = async (email: string) => {
    try {
        const response = await api.post("/forget-password", { email });
        if (response.status === 200) {
            return response.status;
        } else {
            throw new Error("Forget password failed");
        }
    } catch (error) {
        console.error("Forget password error:", error);
        throw error;
    }
};

export const resetPassword = async (data: {
    token: string;
    email: string;
    password: string;
    password_confirmation: string;
}) => {
    try {
        const response = await api.post("/reset-password", data);
        if (response.status === 200) {
            return response.status;
        } else {
            throw new Error("Reset password failed");
        }
    } catch (error) {
        console.error("Reset password error:", error);
        throw error;
    }
};

export const getUserType = async (): Promise<AxiosResponse> => {
    try {
        const response = await api.get("/user-type");

        return response.data.user_type;
    } catch (error) {
        throw error;
    }
};

interface UserProps {
    name: string;
    email: string;
    isAdmin: number;
}

export const getUserInfo = async (): Promise<AxiosResponse<UserProps>> => {
    try {
        const response = await api.get<UserProps>("/api/user");

        return response;
    } catch (error) {
        throw error;
    }
};
