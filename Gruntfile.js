module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
      concat: {
        js: {
          src: [
            './bower_components/jquery/dist/jquery.min.js',
            './bower_components/bootstrap/dist/js/bootstrap.min.js'
          ],
          dest: './web/js/app.js'
        },
        css: {
          src: [
            './bower_components/bootstrap/dist/css/bootstrap.min.css',
          ],
          dest: './web/css/style.css'
        }
      },
      copy: {
        main: {
          flatten: true,
          expand: true,
          filter: 'isFile',
          cwd: './bower_components/bootstrap/dist/fonts',
          src: ['**'],
          dest: './web/fonts/'
        }
      }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');

  // Default task(s).
  grunt.registerTask('default', ['concat', 'copy']);

};