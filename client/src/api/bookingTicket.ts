import { AxiosResponse } from "axios";
import { api } from "./axios";
import csrf from "./csrf";
import getCSRFToken from "./lib/cookie";
import { BookingTrainList } from "./bookingTrain";

export interface UserSessionBookingTicket {
    id: string;
    user_id: string;
    train_id: string;
    payment_tickets: {
        id: string;
        payment_proof_img: string;
        status: string;
        user_booking_ticket_id: string;
    };
    booking_tickets: userTicketProps[];
    train: BookingTrainList;
}

interface apiGetUserSessionBookingTicket {
    data: UserSessionBookingTicket[];
}

export async function getUserSessionBookingTicket(): Promise<apiGetUserSessionBookingTicket> {
    try {
        const response: AxiosResponse<apiGetUserSessionBookingTicket> =
            await api.get("api/booking-ticket");

        return response.data;
    } catch (error) {
        throw error;
    }
}

export async function getAllBookingTicket(): Promise<apiGetUserSessionBookingTicket> {
    try {
        const response: AxiosResponse<apiGetUserSessionBookingTicket> =
            await api.get("api/booking-ticket/admin");

        return response.data;
    } catch (error) {
        throw error;
    }
}

interface apiGetUserSessionBookingTicketByID {
    data: UserSessionBookingTicket;
}

export async function getUserSessionBookingTicketByID(
    btID: string
): Promise<apiGetUserSessionBookingTicketByID> {
    try {
        const response: AxiosResponse<apiGetUserSessionBookingTicketByID> =
            await api.get(`api/booking-ticket/${btID}`);

        return response.data;
    } catch (error) {
        throw error;
    }
}

export interface userTicketProps {
    name: string;
    email: string;
    phone_number: string;
    class: string;
}

interface UserBookingTicketProps {
    trainID: string;
    userData: userTicketProps[];
}

export async function createUserBookingTicket(data: UserBookingTicketProps) {
    try {
        await csrf();
        const response = await api.post("api/booking-ticket", data, {
            withCredentials: true,
            headers: {
                "X-XSRF-TOKEN": getCSRFToken(),
            },
        });

        return response;
    } catch (error) {
        throw error;
    }
}
