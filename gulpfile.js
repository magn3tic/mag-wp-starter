const { src, dest, series, parallel, watch } = require('gulp');
const webpack = require('webpack');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const __if = require('gulp-if');
const browsersync = require('browser-sync').create();
const projectConfig = require('./project.config.js');

const prod = projectConfig.production;
console.log('is production: ', prod);

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
  if (prod) {
    callback();
    return false;
  }
  browsersync.init({
    proxy: projectConfig.localBaseUrl,
    files: projectConfig.css.watch,
    ghostMode: false
  }, () => {
    callback();
  });
}

// Compile sass files
function compileSass() {
  return src(projectConfig.css.scss)
    .pipe(__if(!prod, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(__if(!prod, sourcemaps.write('./')))
    .pipe(dest(projectConfig.css.output));
}

// Run webpack for scripts
function runWebpack(callback) {
  const webpackCompiler = webpack(projectConfig.webpack);
  const onCompile = (err, stats) => {
    if (err) {
      console.log(`[WEBPACK-ERROR] ${err}`);
    } else {
      console.log(`[WEBPACK] ${stats.toString({chunks: false})}`);
      if (!prod) browsersync.reload();
    }
    callback();
  };
  (prod ?
  webpackCompiler.run(onCompile) : 
  webpackCompiler.watch({}, onCompile));
}

// Gulp watchers
if (!prod) {
  watch(PATHS.css.scss, compileSass);
  watch(PATHS.html.reload, callback => {
    browsersync.reload();
    callback();
  });
}

// Default task pipeline
exports.default = series(parallel(compileSass, runWebpack), localServe);
