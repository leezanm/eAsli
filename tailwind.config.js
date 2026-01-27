/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0f2f0',
          100: '#e0e5e0',
          200: '#c0cac0',
          300: '#9ba89f',
          400: '#7a8a7e',
          500: '#6b7d77',
          600: '#5a6d66',
          700: '#4a5d56',
          800: '#3a4d46',
          900: '#2a3d36',
        },
        secondary: {
          50: '#faf8f6',
          100: '#f5f3f0',
          200: '#ebe7e0',
          300: '#ddd7ce',
          400: '#cfc6ba',
          500: '#c2bab2',
          600: '#b5ada5',
          700: '#a89a98',
          800: '#9b8c8a',
          900: '#8e7e7c',
        },
        accent: {
          50: '#fdf9f3',
          100: '#fbf3e7',
          200: '#f7e7cf',
          300: '#f0d9b7',
          400: '#e6c89f',
          500: '#d4b896',
          600: '#c2a685',
          700: '#b09474',
          800: '#9e8263',
          900: '#8c7052',
        },
        neutral: {
          0: '#ffffff',
          50: '#f9f8f7',
          100: '#f5f3f0',
          200: '#e8dfd4',
          300: '#dcccc0',
          400: '#c4a893',
          500: '#8b8680',
          600: '#6b6660',
          700: '#4b4640',
          800: '#3a3530',
          900: '#2E2E2E',
        },
      },
      fontFamily: {
        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      animation: {
        pulse: 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        blob: 'blob 7s infinite',
      },
      keyframes: {
        blob: {
          '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
          '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
          '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
        },
      },
    },
  },
  plugins: [],
};
