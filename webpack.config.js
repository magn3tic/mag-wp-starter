
module.exports = (options, paths) => {
  
  const plugins = [];
  if (options.production) {
    const uglify = new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false
      }, 
      output: {
        comments: false
      }
    });
    plugins.push(uglify);
  }

  return {
    entry: './' + paths.js.entry,
    output: {
      filename: paths.js.filename,
      path: __dirname + '/' + paths.js.output
    },
    mode: options.production ? 'production' : 'development',
    module: {
      rules: [{
        test: /\.js$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', {
                "targets": {
                  "browsers": options.browserlist
                },
                "debug": false
              }]
            ]
          }
        }
      }]
    },
    plugins
  };
};