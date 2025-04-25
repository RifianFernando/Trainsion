import { AxiosResponse } from "axios";
import { api } from "./axios";
import csrf from "./csrf";
import getCSRFToken from "./lib/cookie";

export default async function createBookingTrain(
    formData: FormData
): Promise<AxiosResponse> {
    try {
        await csrf();
        const response = await api.post("/api/trains", formData, {
            headers: {
                "X-XSRF-TOKEN": getCSRFToken(),
            },
        });

        return response;
    } catch (error) {
        throw error;
    }
}
