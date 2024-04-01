/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        'mi-color': '#B17'
      },
      screens:{
        'custom':'900px'
      }
    },
  },
  plugins: [],
}

