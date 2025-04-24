import Image from "next/image";
import Navbar from '../components/home/navbar';

const trains = [
    {
        id: 1,
        name: "Basic Tee",
        href: "#",
        imageSrc: "/product-page-01-related-product-01.jpg",
        imageAlt: "Front of men's Basic Tee in black.",
        price: "$35",
        color: "Black",
    },
    // More products...
];
export default function Home() {
    return (
        <div className="bg-white">
            <Navbar />
            <div className="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 className="text-2xl font-bold tracking-tight text-gray-900">
                    Customers also purchased
                </h2>

                <div className="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    {trains.map((trains) => (
                        <div key={trains.id} className="group relative">
                            <Image
                                aria-hidden
                                src={trains.imageSrc}
                                alt={trains.imageAlt}
                                width={16}
                                height={16}
                                className="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80"
                            />
                            <div className="mt-4 flex justify-between">
                                <div>
                                    <h3 className="text-sm text-gray-700">
                                        <a href={trains.href}>
                                            <span
                                                aria-hidden="true"
                                                className="absolute inset-0"
                                            />
                                            {trains.name}
                                        </a>
                                    </h3>
                                    <p className="mt-1 text-sm text-gray-500">
                                        {trains.color}
                                    </p>
                                </div>
                                <p className="text-sm font-medium text-gray-900">
                                    {trains.price}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
