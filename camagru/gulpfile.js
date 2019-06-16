var gulp = require('gulp');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
var reload = browserSync.reload;

gulp.task('serve', function () {
	connect.server({}, function () {
		browserSync({
			proxy: '127.0.0.1:8000'
		});
	});
	
	gulp.watch('**/**').on('change', reload);
});