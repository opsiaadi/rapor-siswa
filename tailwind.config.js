/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: ["./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        heading: '#374151', // gray-700
        body: '#6b7280', // gray-500
        'default-medium': '#d1d5db', // gray-300
        'neutral-secondary-medium': '#f9fafb', // gray-50
        brand: {
          DEFAULT: '#6366f1', // indigo-500
          strong: '#4338ca', // indigo-700
          medium: '#a5b4fc', // indigo-300
          soft: '#e0e7ff', // indigo-100
        },
      },
      borderRadius: {
        base: '0.5rem',
        xs: '0.125rem',
      },
      boxShadow: {
        xs: '0 0.5px 1.5px rgba(0,0,0,0.05)',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

