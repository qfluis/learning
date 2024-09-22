/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js}"],
  safelist: [
    'bg-green-600',
    'bg-green-500',
    'bg-green-700',
    'ring-offset-green-700'
  ],
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

