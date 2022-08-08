const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')


module.exports = {
  corePlugins: {
    appearance: false,
  },
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {

    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      blue: colors.blue,
      white: colors.white,
      gray: colors.gray,
      emerald: colors.emerald,
      indigo: colors.indigo,
      yellow: colors.yellow,
        indigo: {
          50: '#59b4ed',
          100: '#50a3d7',
          200: '#468fbd',
          300: '#3c7aa1',
          400: '#306281',
          500: '#254c64',
          600: '#1c3a4d',
          700: '#183242',
          800: '#142936',
          900: '#10212c'
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/ui'),
    require('@tailwindcss/custom-forms'),
    require('@tailwindcss/aspect-ratio'),
    require('tailwindcss-plugins/pagination')
  ]
}
