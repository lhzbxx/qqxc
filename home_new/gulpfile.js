/*
 * @Author: LuHao
 * @Date:   2015-12-04 10:37:04
 * @Last Modified by:   LuHao
 * @Last Modified time: 2016-02-21 01:44:54
 */

// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    del = require('del');
    concat = require('gulp-concat'),
    cache = require('gulp-cache'),
    browserSync = require('browser-sync'),
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector');

// Constant
var SRC = 'src/**/*'
var DIST = 'dist/**/*';

// HTMLs
gulp.task('htmls', function() {
    return gulp.src('src/**/*.html')
        .pipe(gulp.dest('dist/'))
})

// Styles
gulp.task('styles', function() {
    return gulp.src('src/styles/*.scss')
        .pipe(sass({ sourcemap: true }))
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('dist/styles'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(gulp.dest('dist/css'))
})

// Styles with rev
gulp.task('styles-rev', function() {
    return gulp.src('src/styles/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('dist/styles'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(rev())
        .pipe(gulp.dest('dist/css'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('dist/rev'));
})

// Rev
gulp.task('rev', function() {
    return gulp.src(['dist/rev/*.json', 'dist/**/*.html'])
        .pipe(revCollector())
        .pipe(gulp.dest('dist/**/*.html'));
});

// Scripts
gulp.task('scripts', function() {
    return gulp.src('src/scripts/**/*.js')
        // .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
        .pipe(concat('main.js'))
        .pipe(gulp.dest('dist/scripts'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'))
})

// Images
gulp.task('images', function() {
    return gulp.src('src/images/*')
        .pipe(cache(imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: true
        })))
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
    gulp.watch('src/styles/**/*.scss', ['styles']);
    // Watch .js files
    gulp.watch('src/scripts/**/*.js', ['scripts']);
    // Watch image files
    gulp.watch('src/images/**/*', ['images']);
    // Watch html files
    gulp.watch('src/**/*.html', ['htmls']);
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
