module.exports = function (grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		concat: {
			main: {
				src: [
					'../js/weatherController.js',
				],
				dest: '../js/weatherApp.js',
				nonull: true
			}
		},

		uglify: {
			options: {
				sourceMap: true
			},
			main: {
				src: '../js/weatherApp.js',
				dest: '../js/weatherApp.min.js',
				nonull: true
			}
		},

		compass: {
			dist: {
				options: {
					config: 'scss/config.rb',
					basePath: 'scss/',
					force: true
				}
			}
		},

		cssmin: {
			options: {
				keepSpecialComments: 0,
				rebase: false,
				sourceMap: true
			},
			dist: {
				src: '../stylesheets/screen.css',
				dest: '../stylesheets/screen.min.css'
			}
		},

		watch: {
			scripts: {
				files: ['../js/*.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false
				}
			},
			css: {
				files: ['scss/sass/**/*.scss'],
				tasks: ['compass', 'cssmin'],
				options: {
					spawn: false,
					livereload: true
				}
			}
		}
	});

	// Load the plugin that provides the "concat" task.
	grunt.loadNpmTasks('grunt-contrib-concat');

	// Load the plugin that provides the "trim trailing spaces" task.
	grunt.loadNpmTasks('grunt-trimtrailingspaces');

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');

	// Load the plugin that provides the "compass" task.
	grunt.loadNpmTasks('grunt-contrib-compass');

	// Load the plugin that provides the "min" & "cssmin" task.
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	// Load the plugin that provides the "watch" task.
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('default', ['concat', 'uglify', 'compass', 'cssmin']);
};
