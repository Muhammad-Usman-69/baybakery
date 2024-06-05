/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*.php", "partials/_email.php"],
  theme: {
    extend: {
      minHeight: {
        27: "6.75rem",
      },
      animation: {
        'spin-slow': 'spin 4s linear infinite',
      }
    },
  },
  plugins: [],
};
