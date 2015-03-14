module.exports = function(grunt) {

	grunt.initConfig({
		
		pkg: grunt.file.readJSON('package.json'),

		concat: {
			dist: {
				src: [
				'assets/js/vendor/royalslider.js',
				'assets/js/vendor/velocity.js',
				'assets/js/vendor/velocity-ui.js'
				],
				dest: 'assets/js/min/plugins.js'
			}
		},

		uglify: {
			build: {
				files: {
					'assets/js/min/plugins.min.js': ['assets/js/min/plugins.js'],
					'assets/js/min/global.min.js' : ['assets/js/global.js']
				}
			}
		},

		compass: {
			dist: {
				options: {
					config: 'config.rb'
				}
			}
		},

		watch: {
			options: {
				livereload: true
			},
			site: {
				files: ['**/*.php']
			},
			css: {
				files: ['sass/**/*.scss'],
				tasks: ['compass']
			},
			scripts: {
				files: ['assets/js/app.js'],
				tasks: ['concat','uglify']
			}
		}

	});


	//load all out tasks
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');

	grunt.registerTask('default', ['concat','uglify','watch','compass']);

}