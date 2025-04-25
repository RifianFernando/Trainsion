import { api } from "./axios";

export default function csrf() {
    return api.get("/sanctum/csrf-cookie", {
        withCredentials: true,
    });
}
