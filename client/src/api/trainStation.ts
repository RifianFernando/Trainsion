import { AxiosResponse } from "axios";
import { api } from "./axios";

export interface StationProps {
    id: string;
    name: string;
}

interface ListStationProps {
    data: StationProps[];
}

export async function getListStation(): Promise<ListStationProps> {
    try {
        const response: AxiosResponse<ListStationProps> = await api.get(
            "api/station"
        );

        return response.data;
    } catch (error) {
        throw error;
    }
}
