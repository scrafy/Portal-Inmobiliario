var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    livereload = require('gulp-livereload'),
    cleanCss = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    rubySass = require('gulp-ruby-sass');


function cssCompile() {
    return rubySass(['resources/assets/scss/app.scss'])
        .on('error', rubySass.logError)
        .pipe(gulp.dest('public/css'))
        .pipe(livereload());
}

function cssMin() {
    return cssCompile()
        .pipe(cleanCss())
        .pipe(rename('app.min.css'))
        .pipe(gulp.dest('public/css'));
}

function jsMin() {
    return gulp.src([
        'public/js/vendors/jquery.js',
        'public/js/vendors/jquery-ui.js',
        'public/js/vendors/bootstrap.js',
        'public/js/init.js',
        'public/js/home.js',
        'public/js/letting.js',
        'public/js/footer.js'
    ])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
}

function watch() {
    livereload.listen();
    gulp.watch('resources/assets/scss/**/*.scss', cssCompile);
}

exports.cssCompile = cssCompile;
exports.cssMin = cssMin;
exports.jsMin = jsMin;
exports.watch = watch;

gulp.task('css-compile', cssCompile);
gulp.task('css-min', cssMin);
gulp.task('js-min', jsMin);
gulp.task('watch', watch);


