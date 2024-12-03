/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/html/*.{html,php,js}'],
  theme: {
    extend: {
      backgroundImage: theme => ({
        URL: "url('https://source.unsplash.com/random')",
      }),
    },
  },
  plugins: [],
}

