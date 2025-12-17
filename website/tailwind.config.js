const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.php", "./src/**/*.{html,js,ts,jsx,tsx}"],
    theme: {
        extend: {
            fontFamily: {
                // Set default font in below order
                sans: [
                    "Helvetica",
                    "Arial",
                    ...defaultTheme.fontFamily.sans,
                ]
            },
            colors: {
                "vet-black": "#1E1E1E",
                "purple": "#5D5A88",
                "red": "#ED1C24",
                "light-green": "#1D9D22",
                "gray": "#626262",
                "yellow": "#F3AD09",
                "deep-gray": "#D9D9D933",
                "shalow-gray": "#DBDBDB",
                "blue" : "#36C6F3",
                "light-blue" : "#E1F7FD",
                "gray-text": "#716F6F",
                "standard-gray": "#A3A3A3",
                "common-gray": "#6D6D6D",
                "light-gray": "#E0E0E0",
                "quick-gray": "#858585",
                "rare-gray": "#C4C4C4",
                "gray-border": "#D9D9D9",
                "grayed": "#D3D3D3",
                "light-gray-border": "#E5E5E5",
                "off-white": "#E8E8E8",
                "deep-gray-border": "#716F6F5C",
                "standard-wireframe": "#737373",
                "info": "#2563EB"
            },
            // .container from 1536px and above should be 10rem
            container: {
                center: true,
                padding: {
                    DEFAULT: "1.25rem",
                    // "2xl": "4rem",
                },
            },
        },
        // .container defaults
        container: {
            center: true,
            padding: "1.25rem",
            screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1536px",
                "3xl": "1780px", // Or choose a value that suits your design needs
                "4xl": "2560px", // Or choose a value that suits your design needs
            },
        },
    },
    plugins: [],
};