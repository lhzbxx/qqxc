/*
 * @Author: LuHao
 * @Date:   2015-12-04 10:37:04
 * @Last Modified by:   LuHao
 * @Last Modified time: 2015-12-20 08:31:13
 */

// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    cache = require('gulp-cache'),
    autoprefixer = require('gulp-autoprefixer'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    browserSync = require('browser-sync'),
    del = require('del');

// Constant
var SRC_JS = 'src/*.js'
var DEST = 'dist';

// HTMLs
gulp.task('htmls', function() {
    return gulp.src('src/**/*.html')
        .pipe(gulp.dest('dist/'))
})

// Styles
gulp.task('styles', function() {
    return gulp.src('src/styles/*.css')
        .pipe(gulp.dest('dist/css'))
})

// Scripts
gulp.task('scripts', function() {
    return gulp.src('src/scripts/**/*.js')
        .pipe(gulp.dest('dist/js'))
})

// Images
gulp.task('images', function() {
    return gulp.src('src/images/*')
        // .pipe(cache(imagemin({
        //     optimizationLevel: 3,
        //     progressive: true,
        //     interlaced: true
        // })))
        .pipe(gulp.dest('dist/img'))
});

// Clean
gulp.task('clean', function() {
    return del(['dist']);
});

// Default task
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts', 'images', 'htmls');
})

gulp.task('watch', ['browser-sync'], function() {
    // Watch .scss files
    gulp.watch('src/styles/**/*.css', ['styles']);
    // Watch .js files
    gulp.watch('src/scripts/**/*.js', ['scripts']);
    // Watch image files
    gulp.watch('src/images/**/*', ['images']);
    // Watch html files
    gulp.watch('src/**/*', ['htmls']);
});

gulp.task('browser-sync', ['default'], function() {
    var files = [
        'dist/**/*'
    ];
    browserSync.init(files, {
        server: {
            baseDir: "dist",
            index: "index.html"
        }
    });
    gulp.watch(['dist/**/*']).on('change', browserSync.reload);
});
