module.exports = function(grunt){
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        /* ############## SASS ############## */
        sass: {
            dist: {
                // Target options 
                options: {
                    outputStyle: 'expanded', //Values: nested, expanded, compact, compressed
                    indentWidth: 4 //Default: 2 Maximum: 10
                },
                // Dictionary of files
                files: {// 'destination': 'source'
                    'css/style.css': 'css/scss/style.scss',
                    'css/home.css': 'css/scss/home.scss',
                    'css/category.css': 'css/scss/category.scss',
                    'css/singular.css': 'css/scss/singular.scss'
                }
            }
        },
        /* ############## COMPRESSAO CSS ############## */
        cssmin:{
            options: {
                keepSpecialComments: 0
            },
            target:{
                files:{
                    'css/style.min.css': ['css/style.css'],
                    'css/home.min.css': ['css/home.css'],
                    'css/category.min.css': 'css/category.css',
                    'css/singular.min.css': ['css/singular.css']
                }
            }
        },
        
        /* ############## COMPRESSAO JS ############## */
        uglify:{
            my_target:{
                files:{
                    'js/custom.min.js' : [
                        'js/dev/sticky_menu.js',
                        'js/dev/scroll.js',
                    ],
                    'js/home.min.js' : [
                        'js/dev/home.js'
                    ],
                    'js/admin_custom.min.js' : [
                        'js/dev/admin_custom.js'
                    ]
                }
            }
        },
        
        /* ############## OBSERVADOR ############## */
        // Watch deve vir antes do BrowserSync
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
        //configuracao e opcoes: http://www.browsersync.io/docs/options/
        browserSync: {            
            files: ["css/*.css", "js/*.js", "*.php", "views/*.php"],
            options: {
                watchTask: true, // < VERY important
                background: true,
                
                /* === Autoload carregando site externo
                online: true, 
                open: "external",            
                proxy: "http://site.com.br/subpasta",
                */
                
                // Using localhost sub directories
                // http://localhost:8000 da conflito no servidor embutido do PHP
                proxy: "http://wp1.local", 
                
                //browser: ["chrome", "firefox", "opera", "iexplore"], // Open the site
                browser: ["chrome"], // Open the site 
                reloadOnRestart: false, // auto-reload all browsers following a Browsersync reload (Default: false)                
                notify: true, // show notifications in the browser. (Default: true)
                scrollProportionally: false, // Sync viewports to TOP position.  (Default: true)
                ghostMode: true, //Clicks, Scrolls & Form inputs on any device will be mirrored to all others
                
                // debug: Show me additional info about the process
                // info: Just show basic info (Default)
                // silent: output NOTHING to the commandline
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