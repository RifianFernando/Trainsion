import axios from "axios";

// https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie
function getCookie(name: string): string | null | undefined {
    try {
        const cookies = document.cookie.split(";");
        for (const cookie of cookies) {
            const [cookieName, cookieValue] = cookie.trim().split("=");
            if (cookieName === name) {
                return decodeURIComponent(cookieValue);
            }
        }
    } catch (error) {
        console.error("Error getting cookie:", error);
        return null;
    }
    return undefined;
}

const token = decodeURIComponent(getCookie("XSRF-TOKEN")!);
const api = axios.create({
    baseURL: `${process.env.NEXT_PUBLIC_API_URL}`,
    withCredentials: true,
    headers: {
        "X-XSRF-TOKEN": token,
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "*",
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json", //change this if you need to send form data to multipart/form-data
    },
});

export { api };
