module.exports = function(grunt) {
  const sass = require('node-sass');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dev: {
        options: {
          implementation: sass,
          outputStyle: 'compressed',
          sourceMap: true,
        },
        files: {
          'assets/admin/css/custom-admin.min.css': 'assets/scss/custom-admin.scss',
          'assets/css/main.min.css': 'assets/scss/main.scss',
        }
      },
      dist: {
        options: {
          implementation: sass,
          outputStyle: 'compressed',
          sourceMap: false,
        },
        files: {
          'assets/admin/css/custom-admin.min.css': 'assets/scss/custom-admin.scss',
          'assets/css/main.min.css': 'assets/scss/main.scss',
        }
      }
    },

    autoprefixer: {
      dev: {
        options: {
          map: true,
          browsers: ['last 2 versions', 'ie 8', 'ie 9']
        },
        files: {
          'assets/admin/css/custom-admin.min.css': 'assets/admin/css/custom-admin.min.css',
          'assets/css/main.min.css': 'assets/css/main.min.css',
        }
      },
      dist: {
        options: {
          map: false,
          browsers: ['last 2 versions', 'ie 8', 'ie 9']
        },
        files: {
          'assets/admin/css/custom-admin.min.css': 'assets/admin/css/custom-admin.min.css',
          'assets/css/main.min.css': 'assets/css/main.min.css',
        }
      }
    },

    watch: {
      scripts: {
        files: ['assets/scss/**/*.scss'],
        tasks: ['sass:dev', 'autoprefixer:dev']
      }
    }
  });

  grunt.registerTask('default', ['watch']);
  grunt.registerTask('dist', ['sass:dist', 'autoprefixer:dist']);

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');
}