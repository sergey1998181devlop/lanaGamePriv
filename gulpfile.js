'use strict';

const gulp = require('gulp'),
    sass = require('gulp-sass'),
    csso = require('gulp-csso'),
    sourcemaps = require('gulp-sourcemaps'),
    merge = require('merge-stream'),
    through2 = require('through2'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    scss = {
        'css/**/*.scss': 'css'
    };

gulp.task('scss', () => {
    return merge(Object.keys(scss).map(source => {
        let destination = scss[source];

        return gulp.src(source)
            .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(csso({restructure: false, comments: 'exclamation'}))
            .pipe(sourcemaps.write('.'))
            .pipe(through2.obj(function(file, enc, cb) {
                let date = new Date();

                file.stat.atime = date;
                file.stat.mtime = date;

                cb(null, file);
            }))
            .pipe(gulp.dest(destination));
    }));
});

gulp.task('scss:watch', gulp.series('scss', () => {
    gulp.watch(Object.keys(scss), gulp.series('scss'));
}));

gulp.task('js', () => {
    return gulp.src('js/src/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('layout.js'))
        .pipe(uglify())
        .pipe(sourcemaps.mapSources(sourcePath  => `../src/${sourcePath}`))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('js/dest'));
});

gulp.task('js:watch', gulp.series('js', () => {
    gulp.watch('js/src/*.js', gulp.series('js'));
}));

gulp.task('all:watch', gulp.series('scss', () => {
    gulp.watch(Object.keys(scss), gulp.series('scss'));
    gulp.watch('js/src/*.js', gulp.series('js'));
}))

gulp.task('default', gulp.series('scss:watch'));
