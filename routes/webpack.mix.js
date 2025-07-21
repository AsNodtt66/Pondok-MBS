const mix = require('laravel-mix');
const GoogleFontsPlugin = require('google-fonts-plugin');

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .postCss('resources/css/app.css', 'public/css', [
  require('tailwindcss')
  ])
  .options({
    processCssUrls: false
  })
  .webpackConfig({
    plugins: [
      new GoogleFontsPlugin({
        fonts: [
          { family: 'Poppins', variants: ['300', '400', '500', '600', '700'] }
        ],
        path: 'public/fonts/'
      })
    ]
  });