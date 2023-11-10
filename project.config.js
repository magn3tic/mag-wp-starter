require('dotenv').config();
const path = require('path');

const production = process.env.NODE_ENV === 'production';

module.exports = {
  // path to the site on localhost
  localBaseUrl: process.env.LOCAL_BASE_URL || 'http://localhost:8888/starter-wp/',

  // template files to live-reload on change
  watchTemplates: '**/*.php',

  // i/o paths for css/scss files
  css: {
    scss: '_scss/**/*.scss',
    output: 'assets/css',
    watch: 'assets/css/*.css'
  }, 

  // webpack settings (used for js only)
  webpack: {
    entry: {
      main: '_js/main.js',
    },
    output: {
      path: path.resolve(__dirname, 'assets/js'),
      filename: '[name].js',
    },
    mode: production ? 'production' : 'development',
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
            },
          },
        },
      ],
    },
    resolve: {
      modules: [
        path.resolve(__dirname, './node_modules'),
      ],
      extensions: ['.js', '.jsx'],
      alias: {
        '@': path.resolve(__dirname, './_js/'),
      },
    },
  }
};
