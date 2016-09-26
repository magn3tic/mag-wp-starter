
//required plugins
var gulp = require('gulp'),
		sass = require('gulp-sass'),
		sourcemaps = require('gulp-sourcemaps'),
		concat = require('gulp-concat'),
		uglify = require('gulp-uglify'),
		plumber = require('gulp-plumber'),
		beep = require('beepbeep'),
		browserSync = require('browser-sync').create();

//project settings
var settings = {
	server: 'http://localhost:8888/mag-starter/',
	siteFiles: '**/*.php',
	sassDir: '_sass/**/*.scss',
	cssDest:  'assets/css',
	jsPluginsDir: [
		'_js/vendor/velocity.js',
		'_js/vendor/velocity-ui.js',
		'_js/vendor/flickity.js'
		],
	jsDir: '_js/*.js',
	jsDest: 'assets/js'
};

//plumber error handling
var onError = function(err) {
	beep();
	console.log(err);
	this.emit('end');
};

// serve/init browsersync
gulp.task('serve', ['sass'], function() {
	browserSync.init({
		proxy: settings.server
	});
	gulp.watch(settings.sassDir, ['sass']);
	gulp.watch(settings.jsDir, ['js']).on('change',browserSync.reload);
	gulp.watch(settings.siteFiles).on('change',browserSync.reload);
});

//compile sass
gulp.task('sass', function() {
	gulp.src(settings.sassDir)
		.pipe(plumber(onError))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(settings.cssDest))
		.pipe(browserSync.stream());
});

//creates js plugin file, from files in /vendor folder
gulp.task('jsplugins', function() {
	gulp.src(settings.jsPluginsDir)
		.pipe(concat('plugins.js'))
		.pipe(uglify())
		.pipe(gulp.dest(settings.jsDest));
});

//authored theme javascript
gulp.task('js', function() {
	gulp.src(settings.jsDir)
		.pipe(plumber(onError))
		.pipe(concat('global.js'))
		.pipe(uglify())
		.pipe(gulp.dest(settings.jsDest));
});

//defaults task
gulp.task('default', ['sass','jsplugins','js','serve']);



