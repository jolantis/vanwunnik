module.exports = function(grunt) {

	grunt.config('browserSync', {
		dev: {
			files: {
				src: [
					'<%= project.styles %>/main.css',
					// '<%= project.styles %>/mobile.css',
					'<%= project.scripts %>/head.js',
					'<%= project.scripts %>/main.js',
					// '<%= project.scripts %>/mobile.js',
					'site/templates/*.php',
					'site/snippets/*.php',
					'content/**/*.md',
				]
			},
			options: {
				watchTask: true,
				open: false, // 'external'
				host: 'vanwunnik.test',
				proxy: 'vanwunnik.test',
				port: 3000,
				// tunnel: 'vanwunnik',                                            // Attempt to use the URL "http://vanwunnik.localtunnel.me"
				// logConnections: true,
				logFileChanges: true,
				// open: false, // 'ui'
				browser: 'google chrome',
				// xip: true,
				reloadOnRestart: true,
				notify: false,
				ghostMode: {
					clicks: true,
					forms: true,
					scroll: true,
				},
			},
		},
	});

};
