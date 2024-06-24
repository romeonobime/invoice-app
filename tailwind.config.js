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
      'danger-light': '#FF9797',
      'neutral-lightest': '#DFE3FA',
      'neutral-lighter': '#7E88C3',
      'neutral-light': '#888EB0',
      'neutral': '#252945',
      'neutral-dark': '#1E2139',
      'neutral-darker': '#141625',
      'neutral-darkest': '#0C0E16',
      'light': '#F8F8FB',
    },
    screens: {
      'sm': '641px',
      'md': '769px',
    },
    extend: {},
  },
  plugins: [],
}
