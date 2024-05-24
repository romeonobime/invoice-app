/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    colors: {
      'primary': '#7C5DFA',
      'primary-light': '#9277FF',
      'danger': '#EC5757',
      'danger-light': '#9277FF',
    },
    screens: {
      'sm': '641px',
      'md': '769px',
    },
    extend: {},
  },
  plugins: [],
}
