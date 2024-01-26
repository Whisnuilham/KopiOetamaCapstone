import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        colors: {
            primary: {
              50: '#EBF5FF',
              100: '#E1EFFE',
              200: '#C3DDFD',
              300: '#A4CAFE',
              400: '#76A9FA',
              500: '#3F83F8',
              600: '#1C64F2',
              700: '#1A56DB',
              800: '#1E429F',
              900: '#233876',
            },
          },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('flowbite/plugin')],
};
