/**
 *  Welcome to your gulpfile!
 *  The gulp tasks are split into several files in the gulp directory
 *  because putting it all here was too long
 */

'use strict';


var gulp = require('gulp');
var less = require('gulp-less');
var babel = require('gulp-babel');
var concat = require('gulp-concat');

/**
 *  Default task clean temporaries directories and launch the
 *  main optimization build task
 */
gulp.task('less', function () {
  return gulp.src('assets/less/portfolio.less')
    .pipe(less()) // Using gulp-less
    .pipe(gulp.dest('assets/css/'))
});

gulp.task('default', ['js', 'less'], function () {
  gulp.watch('assets/less/**/*.less', ['less']);
  gulp.watch('assets/**/*.js', ['js']);
});

gulp.task('js', function () {
  return gulp.src([
    'assets/js/**/*.js',
    '!assets/js/portfolio.js',
    '!assets/js/cropper.js'
  ])
    .pipe(concat('js/portfolio.js'))
    .pipe(babel({
      presets: ['es2015']
    }))
    .pipe(gulp.dest('assets'));
});