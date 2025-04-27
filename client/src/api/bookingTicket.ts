import { api } from "./axios";
import csrf from "./csrf";
import getCSRFToken from "./lib/cookie";

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

export async function createUserBookingTicket(
    data: UserBookingTicketProps
) {
    try {
        await csrf();
        const response = await api.post('api/booking-ticket', data, {
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
