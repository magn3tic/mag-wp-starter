const path = require('path');

const getEntries = paths => Object.keys(paths.js.entry).reduce((result, key) => {
  result[key] = `./${paths.js.entry[key]}`;
  return result;
}, {});

module.exports = (options, paths) => ({
  entry: getEntries(paths),

  output: {
    path: path.resolve(__dirname, paths.js.output),
    filename: '[name].js',
  },

  mode: options.production ? 'production' : 'development',

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
    extensions: [
      '.js',
      '.jsx',
    ],
    alias: {
      '@js': path.resolve(__dirname, './_js/'),
    },
  },
});