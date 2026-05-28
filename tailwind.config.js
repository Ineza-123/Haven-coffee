/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./includes/*.php",
    "./admin/*.php",
    "./assets/js/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'coffee-dark': '#3E2723',
        'coffee-light': '#5D4037',
        'cream': '#FFF8E1',
        'beige': '#D7CCC8',
      },
    },
  },
  plugins: [],
}
