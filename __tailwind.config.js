import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/',
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./resources/js/**/*.vue",
        "./app/Models/Traits/Attribute/*.{php}"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"IBM Plex Sans"', 'Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
