module.exports = function (grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		clean: {
			build: {
				src: "build"
			}
		},

		copy: {
			build: {
				files: [
					{
						expand: true,
						cwd: 'source/',
						src: ['client/**/*.html', 'client/**/*.css', 'client/**/*.js', 'server/**'],
						dest: 'build/'
					}
				]
			}
		},

		cssmin: {
			build: {
				files: {
					'build/client/demo/_assets/libraries/clever-contact/styles/form.min.css': ['source/client/demo/_assets/libraries/clever-contact/styles/form.css'],
					'build/client/demo/_assets/styles/main.min.css': ['source/client/demo/_assets/styles/main.css']
				}
			}
		},

		htmlmin: {
			build: {
				options: {
					collapseWhitespace: true
				},
				files: {
					'build/client/demo/contact.min.html': ['source/client/demo/contact.html']
				}
			}
		},

		jshint: {
			options: {
				curly: true,
				eqeqeq: true,
				immed: true,
				latedef: true,
				newcap: true,
				noarg: true,
				sub: true,
				undef: true,
				unused: true,
				boss: true,
				eqnull: true,
				browser: true,
				globals: {
					jQuery: true
				}
			},
			gruntfile: {
				src: 'Gruntfile.js'
			}
		},

		open: {
			demo: {
				path: 'http://localhost:<%= serve.options.port %>/contact.html'
			}
		},

		serve: {
			options: {
				port: 9000,
				serve: {
					path: 'build/client/demo'
				}
			}
		},

		uglify: {
			build: {
				files: {
					'build/client/demo/_assets/libraries/clever-contact/clever-contact.min.js': ['source/client/demo/_assets/libraries/clever-contact/clever-contact.js'],
					'build/client/demo/_assets/scripts/contact.min.js': ['source/client/demo/_assets/scripts/contact.js'],
					'build/client/library/clever-contact.min.js': ['source/client/library/clever-contact.js']
				}
			}
		},

		watch: {
			gruntfile: {
				files: '<%= jshint.gruntfile.src %>',
				tasks: ['jshint:gruntfile']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-htmlmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-open');
	grunt.loadNpmTasks('grunt-serve');

	grunt.registerTask('build', ['clean', 'copy', 'htmlmin', 'cssmin', 'uglify']);

	grunt.registerTask('default', ['build', 'demo']);

	grunt.registerTask('demo', ['open:demo', 'serve']);
};