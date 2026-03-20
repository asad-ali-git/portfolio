/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{vue,js,ts,jsx,tsx}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      colors: {
        surface: {
          950: '#0c0c0f',
          900: '#111116',
          800: '#1c1c24',
          700: '#26263a',
          600: '#32324a',
        },
        ink: {
          DEFAULT: '#eeeef2',
          soft: '#8c8ca0',
          faint: '#52525e',
        },
        accent: {
          DEFAULT: '#7c6af7',
          light: '#a99ffa',
          dark: '#5b48e0',
          glow: 'rgba(124,106,247,0.2)',
        },
        sand: {
          DEFAULT: '#e8c97e',
          light: '#f0daa0',
          dark: '#c4a455',
        },
        dark: {
          950: '#0c0c0f',
          900: '#111116',
          800: '#1c1c24',
          700: '#26263a',
          600: '#32324a',
        },
        cyan: { glow: '#06b6d433' },
      },
      opacity: {
        3: '0.03',
        6: '0.06',
        8: '0.08',
        12: '0.12',
        15: '0.15',
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'hero-gradient': 'linear-gradient(135deg, #0c0c0f 0%, #111116 50%, #1c0c2e 100%)',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-out forwards',
        'slide-up': 'slideUp 0.65s cubic-bezier(0.16,1,0.3,1) forwards',
        'slide-left': 'slideLeft 0.65s cubic-bezier(0.16,1,0.3,1) forwards',
        float: 'float 8s ease-in-out infinite',
        'pulse-slow': 'pulse 5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'spin-slow': 'spin 20s linear infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(28px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideLeft: {
          '0%': { opacity: '0', transform: 'translateX(24px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-14px)' },
        },
      },
      boxShadow: {
        glow: '0 0 40px rgba(124,106,247,0.22)',
        'glow-lg': '0 0 80px rgba(124,106,247,0.32)',
        'glow-sand': '0 0 30px rgba(232,201,126,0.15)',
        card: '0 1px 0 rgba(255,255,255,0.04), 0 8px 40px rgba(0,0,0,0.45)',
        'card-light': '0 1px 0 rgba(0,0,0,0.03), 0 4px 20px rgba(0,0,0,0.07)',
        glass: '0 8px 32px rgba(0,0,0,0.4)',
      },
      backdropBlur: {
        xs: '2px',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
