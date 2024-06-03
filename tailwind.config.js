/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*.php", "partials/_email.php"],
  theme: {
    extend: {
      maxHeight: {
        31: "7.75rem",
        34: "8.5rem",
        18: "4.5rem",
      },
      minHeight: {
        31: "7.75rem",
        34: "8.5rem",
        18: "4.5rem",
      },
      animation: {
        'spin-slow': 'spin 4s linear infinite',
      }
    },
  },
  plugins: [],
};
