module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
      cssmin: {
        combine: {
          files: {
            './web/css/style.min.css': [
              './bower_components/bootstrap/dist/css/bootstrap.min.css',
              './assets/css/overrides.css',
              './assets/css/app.css'
            ]
          }
        }
      },
      uglify: {
        options: {
          sourceMap: true,
        },
        main: {
          files: {
            './web/js/app.min.js': [
              './bower_components/jquery/dist/jquery.min.js',
              './bower_components/bootstrap/dist/js/bootstrap.min.js',
              './assets/js/*.js'
            ]
          }
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
      },
      watch: {
        css: {
          files: './assets/css/*.css',
          tasks: ['cssmin'],
          options: {
            debounceDelay: 250
          }
        },
        js: {
          files: './assets/js/*.js',
          tasks: ['uglify'],
          options: {
            debounceDelay: 250
          }
        },
        // Reload the watcher when this config file changes
        grunt: {
          files: ['Gruntfile.js'],
          options: {
            reload: true
          }
        }
      }
  });

  // Load all required tasks
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['cssmin', 'uglify', 'copy']);

  // Runs tasks when files change
  grunt.registerTask('dev', ['watch']);
};