import type { NextConfig } from "next";

const nextConfig: NextConfig = {
    /* config options here */
    // https://nextjs.org/docs/messages/next-image-unconfigured-host
    images: {
        domains: [
            "https://images.unsplash.com",
            'localhost'
        ]
    },
};

export default nextConfig;
