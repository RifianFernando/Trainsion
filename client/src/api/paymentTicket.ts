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

export async function cancelBookingTicket(
    ticketID: string
): Promise<AxiosResponse> {
    try {
        await csrf();
        const response = await api.delete(`/api/payment/${ticketID}`, {
            headers: {
                "X-XSRF-TOKEN": getCSRFToken(),
            },
        });

        return response;
    } catch (error) {
        throw error;
    }
}

export async function handleRejectAndAcceptPaymentStatusApi(
    ticketID: string,
    type: "reject" | "accept"
): Promise<AxiosResponse> {
    try {
        await csrf();
        const response = await api.post(
            `/api/payment/handle/${ticketID}`,
            { type },
            {
                headers: {
                    "X-XSRF-TOKEN": getCSRFToken(),
                },
            }
        );

        return response;
    } catch (error) {
        throw error;
    }
}
