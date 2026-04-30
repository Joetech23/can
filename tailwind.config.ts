import type { Config } from 'tailwindcss'

const config: Config = {
  content: [
    './src/pages/**/*.{js,ts,jsx,tsx,mdx}',
    './src/components/**/*.{js,ts,jsx,tsx,mdx}',
    './src/app/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  theme: {
    extend: {
      colors: {
        navy: {
          DEFAULT: '#0a1f44',
          50:  '#e8ecf3',
          100: '#c5cedf',
          200: '#9dafc9',
          300: '#7590b3',
          400: '#4d719d',
          500: '#0a1f44',
          600: '#08193a',
          700: '#06142f',
          800: '#040e24',
          900: '#02091a',
        },
        teal: {
          DEFAULT: '#168ca2',
          50:  '#e8f6f9',
          100: '#b9e4ec',
          200: '#89d2df',
          300: '#59c0d2',
          400: '#35b2c8',
          500: '#168ca2',
          600: '#107688',
          700: '#0b5f6e',
          800: '#074854',
          900: '#03313a',
        },
        green: {
          DEFAULT: '#34b2aa',
          50:  '#eaf8f7',
          100: '#beecea',
          200: '#91e0dc',
          300: '#63d4ce',
          400: '#45cbc3',
          500: '#34b2aa',
          600: '#2a9690',
          700: '#207a75',
          800: '#165e5a',
          900: '#0c423f',
        },
        orange: {
          DEFAULT: '#F18316',
          50:  '#fef5e7',
          100: '#fce3b9',
          200: '#fad08a',
          300: '#f8bd5b',
          400: '#f6ae37',
          500: '#F18316',
          600: '#d4720a',
          700: '#b86104',
          800: '#9c5000',
          900: '#803f00',
        },
      },
      fontFamily: {
        sans:    ['Inter', 'system-ui', 'sans-serif'],
        display: ['DM Serif Display', 'Georgia', 'serif'],
      },
      animation: {
        'fade-in':       'fadeIn 0.6s ease-out forwards',
        'slide-up':      'slideUp 0.6s ease-out forwards',
        'slide-in-left': 'slideInLeft 0.6s ease-out forwards',
        'slide-in-right':'slideInRight 0.6s ease-out forwards',
        'float':         'float 3s ease-in-out infinite',
        'pulse-slow':    'pulse 3s ease-in-out infinite',
      },
      keyframes: {
        fadeIn:      { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
        slideUp:     { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
        slideInLeft: { '0%': { opacity: '0', transform: 'translateX(-30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
        slideInRight:{ '0%': { opacity: '0', transform: 'translateX(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%':      { transform: 'translateY(-10px)' },
        },
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic':  'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
      },
      boxShadow: {
        'soft':   '0 2px 20px rgba(10, 31, 68, 0.07)',
        'medium': '0 4px 30px rgba(10, 31, 68, 0.12)',
        'large':  '0 8px 40px rgba(10, 31, 68, 0.18)',
        'teal':   '0 4px 20px rgba(22, 140, 162, 0.32)',
        'navy':   '0 4px 20px rgba(10, 31, 68, 0.28)',
      },
    },
  },
  plugins: [],
}

export default config
