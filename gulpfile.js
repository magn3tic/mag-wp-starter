const { src, dest, series, parallel, watch } = require('gulp');
const webpack = require('webpack');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const __if = require('gulp-if');
const argv = require('yargs').argv;
const browsersync = require('browser-sync').create();
const webpackConfig = require('./webpack.config.js');

const production = !!(argv.production);
console.log('is production: ', production);

const PATHS = {
  css: {
    scss: '_scss/**/*.scss',
    output: 'assets/css',
    watch: 'assets/css/*.css'
  }, 
  js: {
    entry: {
      main: '_js/main.js',
    },
    output: 'assets/js',
    filename: '[name].js'
  },
  html: {
    reload: '**/*.php'
  } 
};

// Serve w/ browser-sync
function localServe(callback) {
  if (production) return false;
  browsersync.init({
    proxy: 'http://localhost:8888/garmon/',
    files: PATHS.css.watch,
    ghostMode: false
  }, () => {
    callback();
  });
}

// Compile sass files
function compileSass() {
  return src(PATHS.css.scss)
    .pipe(__if(!production, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(__if(!production, sourcemaps.write('./')))
    .pipe(dest(PATHS.css.output));
}

// Run webpack for scripts
const WEBPACK_CONFIG = webpackConfig({ production }, PATHS);
console.log('config: ', WEBPACK_CONFIG);

function runWebpack(callback) {
  const webpackCompiler = webpack(WEBPACK_CONFIG);
  const onCompile = (err, stats) => {
    if (err) {
      console.log(`[WEBPACK-ERROR] ${err}`);
    } else {
      console.log(`[WEBPACK] ${stats.toString({chunks: false})}`);
      if (!production) browsersync.reload();
    }
    callback();
  };
  (production ?
  webpackCompiler.run(onCompile) : 
  webpackCompiler.watch({}, onCompile));
}

// Gulp watchers
watch(PATHS.css.scss, compileSass);
watch(PATHS.html.reload, callback => {
  browsersync.reload();
  callback();
});

// Default task pipeline
exports.default = series(parallel(compileSass, runWebpack), localServe);
