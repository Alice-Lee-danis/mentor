/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./src/**/*.{js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {
      backgroundColor:{
        "d-blue": "#202731",
        "v-d-blue": "#141519",
        "m-grey": "#262F38",
        "l-grey": "#7C8898",
        "orange": "#FE7512"
      },
      fontSize:{
        "s-card":"15px"
      },
      colors:{
        "orange": "#FE7512",
        "m-grey": "#262F38",
        "l-grey": "#7C8898",
      }
    },
  },
  plugins: [],
}

