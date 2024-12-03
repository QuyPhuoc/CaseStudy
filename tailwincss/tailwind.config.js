/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/html/*.{html,php,js}'],
  theme: {
    extend: {
      backgroundImage: theme => ({
        bg: "url('https://lh3.googleusercontent.com/p/AF1QipMMidqhL8vOxHyyzQ2h5lA5QwWgo2ySx13NnS_e=s680-w680-h510')",
      }),
    },
  },
  plugins: [],
}

