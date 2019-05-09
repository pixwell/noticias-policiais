module.exports = function(grunt){
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        /* SASS */
        sass: {
            dist: { 
                options: {
                    outputStyle: 'expanded',
                    indentWidth: 4
                },
                files: {'css/style.css': 'css/scss/style.scss'}
            }
        },
        /* COMPRESSAO CSS */
        cssmin:{
            options: {
                keepSpecialComments: 0
            },
            target:{
                files:{'css/style.min.css': 'css/style.css'}
            }
        },
        
        /* COMPRESSAO JS */
        uglify:{
            my_target:{
                files:{'js/custom.min.js' : 'js/dev/custom.js'}
            }
        },
        
        /* ############## OBSERVADOR ############## */
        watch:{
            options: {reload: true},           
            
            css:{
                files:[
                    'css/scss/components/*.scss', 
                    'css/scss/theme/*.scss', 
                    'css/scss/*.scss'
                ],
                tasks:['sass', 'cssmin']
            },
            
            js:{
                files:'js/dev/*.js',
                tasks:['uglify']
            }
        },
        
        /* ############## RELOAD DOS BROWSERS ############## */
        browserSync: {            
            files: ["css/*.css", "js/*.js", "*.php", "views/*.php"],
            options: {
                watchTask: true,
                background: true,
                proxy: "http://dev1.local",
                browser: ["chrome", "firefox", "opera", "iexplore"],
                reloadOnRestart: false,              
                notify: true,
                scrollProportionally: false,
                ghostMode: true,
                logLevel: "info"
            }
        }
    });
    
    /* ############## MENSAGEM NO PROCESSAMENTO ############## */
    grunt.log.writeln("Processando, perai ...");
    
    /* ############## CARREGANDO OS PLUGINS ############## */ 
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');
    
    /* ############## TAREFA DEFAULT ############## */    
    grunt.registerTask( "autoload", [ "browserSync", "watch" ]);
    grunt.registerTask( "css", [ "sass", "cssmin" ]);
    grunt.registerTask( "assets", [ "sass", "cssmin", "uglify" ]);
};