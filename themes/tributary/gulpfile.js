'use strict';

/* Nota revisar siempre la documentacion para ver si se esta actualizando los
plugins */

// Load plugins
var gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({ camelize: true }),
	sass    = require('gulp-ruby-sass'), //no olvidar esta variable hay actualización
	lr      = require('tiny-lr'),
	server  = lr();

// Styles
gulp.task('styles', function() {
  	//return gulp.src('assets/styles/source/*.sass')
  	return sass( 'assets/styles/source/*.sass' , { style :'compressed' , compass: true } )
	.pipe(plugins.autoprefixer({
			browsers: ['last 2 version', 'safari 5', 'ie 8', 'ie 9'],
			cascade : true
        })
	)
	.pipe(gulp.dest('assets/styles/build'))
	.pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('./'))
	.pipe(plugins.notify({ message: 'Tarea de estilos completa' }));
});

// Vendor Plugin Scripts
gulp.task('plugins', function() {
  return gulp.src(['assets/js/source/plugins.js', 'assets/js/vendor/*.js'])
	.pipe(plugins.concat('plugins.js'))
	.pipe(gulp.dest('assets/js/build'))
	.pipe(plugins.rename({ suffix: '.min' }))
	.pipe(plugins.uglify())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/js'))
	.pipe(plugins.notify({ message: 'Tarea Completa de Vendor Scripts' }));
});

// Site Scripts
gulp.task('scripts', function() {
  return gulp.src(['assets/js/source/*.js', '!assets/js/source/plugins.js'])
	.pipe(plugins.jshint('.jshintrc'))
	.pipe(plugins.jshint.reporter('default'))
	.pipe(plugins.concat('main.js'))
	.pipe(gulp.dest('assets/js/build'))
	.pipe(plugins.rename({ suffix: '.min' }))
	.pipe(plugins.uglify())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/js'))
	.pipe(plugins.notify({ message: 'Tarea Completa de Scripts' }));
});

// Images
gulp.task('images', function() {
  return gulp.src('assets/images/**/*')
	.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/images'))
	.pipe(plugins.notify({ message: 'Tarea Completa de Imágenes' }));
});

// Watch
gulp.task('watch', function() {

  // Listen on port 35729
  server.listen(35729, function (err) {
	if (err) {
	  return console.log(err)
	};

	// Watch .scss files
	gulp.watch('assets/styles/source/**/*.sass', ['styles']);

	// Watch .js files
	gulp.watch('assets/js/**/*.js', ['plugins', 'scripts']);

	// Watch image files
	gulp.watch('assets/images/**/*', ['images']);

  });

});

// Tarea por defecto
gulp.task('default', ['styles','plugins', 'scripts', 'images', 'watch']);