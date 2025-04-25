import axios from "axios";

const api = axios.create({
    baseURL: `${process.env.NEXT_PUBLIC_API_URL}`,
    withCredentials: true,
    headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "*",
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json", //change this if you need to send form data to multipart/form-data
    },
});

export { api };
