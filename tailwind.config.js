const defaultTheme = require('tailwindcss/defaultTheme')

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
    },
  },
  plugins: [
    require('@tailwindcss/ui'),
    require('@tailwindcss/custom-forms'),
    require('@tailwindcss/aspect-ratio'),
    require('tailwindcss-plugins/pagination')
  ]
}
