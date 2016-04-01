<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@include('frontend._title')</title>
        <meta name="description" content="{{ isset($seo) ? $seo->title : config('formable.site_title') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="token" name="token" value="{{ csrf_token() }}">

        <meta property="og:title" content="{{ isset($seo) ? $seo->title : config('formable.site_title') }}" />
        <meta property="og:url" content="{{ \Request::root() }}/{{ \Request::path() }}" />

        @if(isset($seo))
            @if($seo->img()->exists())
                <meta property="og:image"
                      content="{{ \Request::root() }}/imagecache/facebook/{{ $seo->img()->first() }}" />
            @else
                <meta property="og:image" content="{{ \Request::root() }}/imagecache/facebook/facebook.jpg" />
            @endif

            @if($seo->content)
                <meta property="og:description" content="{{ shortenClean($seo->content, 200) }}" />
            @endif
        @else
            <meta property="og:image" content="{{ \Request::root() }}/imagecache/facebook/facebook.jpg" />
            <meta property="og:description" content="{{ config('formable.site_description') }}" />
        @endif

        <meta property="og:image:width" content="600"/>
        <meta property="og:image:height" content="315"/>

        <link rel="stylesheet" href="/css/bundle.css?v=5">
        <link rel="stylesheet" href="/css/app.css?v=5">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css?v=5">
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js?v=5"></script>
        <script src="/js/bundle.js?v=5"></script>
        <script>
        Vue.config.debug = false;
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        </script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '926354750792374',
              xfbml      : true,
              version    : 'v2.5'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/is_IS/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="Head {{ frontpage() ? 'frontpage' : '' }}">
            <div class="bg-image">
            </div>

            <div class="inner-container"> 

                @if(frontpage())
                    <div class="frontpage-content">
                        <div class="animated slideInDown">
                            <a href="/" id="logo"><img src="/img/logo-{{ lang() }}.png?v=2" /></a>
                        </div>
                        <div class="animated slideInUp">
                            @if(lang()=='is')
                                <h3>Öryggisgirðingar ehf bjóða heildarlausnir á girðingum, hliðum og aðgangskerfum.</h3>
                            @else
                                <h3>Sikkerhetsgjerder AS tilbyr komplette løsninger på gjerder porter, adgangssystemer og avanserte overvåkningsgjerder.</h3>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="frontpage-content">
                        <a href="/" id="logo"><img src="/img/logo-{{ lang() }}.png" /></a>
                    </div>
                @endif

            </div>
        </div>

        <div class="Menu" data-sticky>
            <nav class="main mobile">
                <div>
                    <a href="#"><i class="fa fa-navicon"></i> Valmynd</a>
                </div>
            </nav>
            <nav class="main slide">
                {!! kalMenuArray() !!}
            </nav>
        </div>

        @yield('crumbs')
                   
        @if(frontpage())

            @include('frontend._products', ['items'=>$categories, 'path_prefix'=>(lang() == 'is' ? 'vorur' : 'produkter')])

        @else
            
            @yield('content')

        @endif

        <div class="Footer">
            <section>
                <div>
                    <h3><i class="fa fa-globe"></i>{{ lang()=='no' ? 'Språk' : 'Tungumál' }}</h3>
                    <ul>
                        <li><a href="?language=no"><img src="/flagicons/Norway.png" />Norsk</a></li>
                        <li><a href="?language=is"><img src="/flagicons/Iceland.png" />Íslenska</a></li>
                    </ul>
                </div>

                <div class="righter">
                    <!--<h3><i class="fa fa-facebook"></i>Facebook</h3>-->
                    <div class="fb-page" data-href="https://www.facebook.com/%C3%96ryggisgir%C3%B0ingar-ehf-girdingis-238129502954060/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
                </div>

                <div class="fullwidth">
                    <hr>
                    @if(lang()=='no')
                        <p>Sikkerhetsgjerder AS · Tomteråsveien 23 · 2165 Hvam · Tlf 99 11 42 22 · <a href="mailto:post@sikkerhetsgjerder.no">post@sikkerhetsgjerder.no</a></p>
                    @else
                        <p>Öryggisgirðingar ehf · Suðurhraun 2 · 210 Garðabær · Sími 544 4222 · Fax 544 4221 · <a href="mailto:girding@girding.is">girding@girding.is</a></p>
                    @endif
                </div>
            </section>
        </div>
        
        <script src="/js/scripts.js?v=5"></script>
    </body>
</html>
