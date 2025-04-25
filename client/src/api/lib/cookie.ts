export default function getCSRFToken() {
    const CSRF_TOKEN = decodeURIComponent(
        document.cookie
            .split(";")
            .find((cookie) => cookie.trim().startsWith("XSRF-TOKEN"))
            ?.split("=")[1] || ""
    );

    return CSRF_TOKEN;
}
