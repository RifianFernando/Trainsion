import { AxiosResponse } from "axios";
import csrf from "./csrf";
import getCSRFToken from "./lib/cookie";
import { api } from "./axios";

export async function payBookingTicket(
    formData: FormData
): Promise<AxiosResponse> {
    try {
        await csrf();
        const response = await api.post("/api/payment", formData, {
            headers: {
                "X-XSRF-TOKEN": getCSRFToken(),
            },
        });

        return response;
    } catch (error) {
        throw error;
    }
}
