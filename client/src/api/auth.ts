import { AxiosResponse } from "axios";
import { api } from "./axios";

export const login = async (credentials: {
    email: string;
    password: string;
}) => {
    try {

        const csrf = () => api.get("/sanctum/csrf-cookie");
        await csrf();
        const response = await api.post("/login", credentials);
        if (response.status === 200) {
            return response;
        } else if (response.status === 401) {
            throw new Error("Invalid credentials");
        } else {
            throw new Error("Login failed");
        }
    } catch (error) {
        console.error("Login error:", error);
        throw error;
    }
};

export const logout = async () => {
    try {
        const response = await api.post("/logout");
        if (response.status === 200) {
            return response;
        } else if (response.status === 401) {
            throw new Error("Invalid credentials");
        } else {
            throw new Error("Login failed");
        }
    } catch (error) {
        console.error("Login error:", error);
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

export const register = async (data: {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}) => {
    try {
        const response = await api.post("/register", data);
        if (response.status === 200 || response.status === 204) {
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
}

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
