var gulp = require("gulp");
var ts = require("gulp-typescript");
var tsProject = ts.createProject("frontend/web/js/tsconfig.json");
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var less = require('gulp-less');
var path = require('path');

gulp.task("js", function () {
    var tsResult = tsProject.src('./frontend/web/js')  
                   .pipe(tsProject());
    return tsResult.js.pipe(gulp.dest('.'));
});

gulp.task('less', function () {
  return gulp.src('./frontend/web/css/**/*.less')
    .pipe(less())
    .pipe(gulp.dest('./frontend/web/css/compile'));
});
    
gulp.task('minify', ['less'], function(){
   return gulp.src('frontend/web/css/compile/**/*.css')
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(concat('build.min.css'))
        .pipe(gulp.dest('frontend/web/css/build'))
});

gulp.task('css', ['less', 'minify']);

gulp.task('watch', function() {
    gulp.watch(['./frontend/web/css/**/*.less'], ['css']);
    gulp.watch(['./frontend/web/js/**/*.ts', ['ts']]);
});

