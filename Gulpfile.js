var gulp = require('gulp'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat');

gulp.task('default', ['js', 'css', 'fonts']);

gulp.task('css', function () {
    gulp.src(['node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'res/scss/style.scss'])
        .pipe(concat('style.scss'))
        .pipe(sass())
        .pipe(gulp.dest('res/public/css/'));
});

gulp.task('js', function () {
    gulp.src([
            'res/js/script.js',
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js'
        ])
        .pipe(gulp.dest('res/public/js/'));
});

gulp.task('fonts', function () {
    gulp.src('node_modules/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest('res/public/fonts/'));
});

gulp.task('watch', function () {
    gulp.watch('res/scss/*.scss', ['css']);
    gulp.watch('res/js/*.js', ['js']);
});
