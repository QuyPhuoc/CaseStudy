/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{html,php,js}'],
  theme: {
    extend: {
      backgroundImage: theme => ({
        bg: "url('https://lh3.googleusercontent.com/p/AF1QipMMidqhL8vOxHyyzQ2h5lA5QwWgo2ySx13NnS_e=s680-w680-h510')",
      }),
      width: {
        "mainviewport": "calc(100vw - 20rem)",
      "mainviewportwithrightpanel": "calc(100vw - 10rem)",},
      backgroundColor: theme => ({
        "shade": "rgba(0, 0, 0, 0.5)"}),
    },
  },
  plugins: [],
}

