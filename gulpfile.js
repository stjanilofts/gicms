var elixir = require('laravel-elixir');

require('laravel-elixir-stylus');

elixir(function(mix) {
    // Compile CSS
    mix

		.stylus('app.styl')
		
        .styles(
            [
                //'magnific-popup/magnific-popup.css'
                'slick/slick.css',
                'slick/slick-theme.css'
            ], // Source files
            'public/css/bundle.css' // Destination file
        )

        // Compile JavaScript
        .scripts(
            [
                'vue/vue.min.js',
                'vue-resource/vue-resource.min.js',
                //'underscore/underscore-min.js',
                //'magnific-popup/jquery.magnific-popup.min.js'
                'slick/slick.min.js'
            ],
            'public/js/bundle.js' // Destination file
        )
        
        .browserSync({
            proxy: 'girding.dev',
            notify: false
        });
});
