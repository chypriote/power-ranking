var gulp = require('gulp'),
		plumber = require('gulp-plumber'),
		rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-cssnano');
var browserSync = require('browser-sync');

gulp.task('serve', function() {
	browserSync({
		proxy: "127.0.0.1/power",
		online: false
	});
});

gulp.task('reload', function () {
	browserSync.reload();
});


gulp.task('styles', function(){
	gulp.src(['css/**/*.css', '!css/**/*.min.css'])
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
	.pipe(autoprefixer('last 2 versions'))
	.pipe(gulp.dest('css/'))
	.pipe(rename({suffix: '.min'}))
	.pipe(minifycss())
	.pipe(gulp.dest('css/'))
	.pipe(browserSync.reload({stream:true}))
});

gulp.task('scripts', function(){
	return gulp.src(['js/**/*.js', '!js/**/*.min.js'])
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
		.pipe(gulp.dest('js/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify())
		.pipe(gulp.dest('js/'))
		.pipe(browserSync.reload({stream:true}))
});

gulp.task('default', ['serve'], function(){
	gulp.watch(['css/**/*.css', '!css/**/*.min.css'], ['reload']);
	gulp.watch(['js/**/*.js', '!js/**/*.min.js'], ['reload']);
	gulp.watch(['*.php', '*.html'], ['reload']);
});