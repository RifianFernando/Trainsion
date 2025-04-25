import { AxiosResponse } from "axios";
import { api } from "./axios";
import csrf from "./csrf";
import getCSRFToken from "./lib/cookie";

export async function createBookingTrain(
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

export interface BookingTrainList {
    id: string;
    name: string;
    train_image: string;
    description: string;
    departure_time: string;
    economy_price: number;
    executive_price: number;
    seats_available: number;
    origin_train_station: {
        id: string;
        name: string;
    };
    destination_train_station: {
        id: string;
        name: string;
    };
}

interface TrainProps {
    data: BookingTrainList[];
}

export async function getTrainList(): Promise<TrainProps> {
    try {
        const response: AxiosResponse<TrainProps> = await api.get("api/trains");

        return response.data;
    } catch (error) {
        throw error;
    }
}
