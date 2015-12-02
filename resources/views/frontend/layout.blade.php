<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@include('frontend._title')</title>
        <meta name="description" content="{{ config('formable.site_description') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="token" name="token" value="{{ csrf_token() }}">

        <meta property="og:title" content="{{ isset($page) ? $page->title : config('formable.site_title') }}" />
        <meta property="og:url" content="{{ \Request::root() }}/{{ \Request::path() }}" />

        @if(isset($page))
            @if($page->img()->exists())
                <meta property="og:image"
                      content="{{ \Request::root() }}/imagecache/facebook/{{ $page->img()->first() }}" />
            @else
                <meta property="og:image" content="{{ \Request::root() }}/imagecache/facebook/facebook.jpg" />
            @endif

            @if($page->content)
                <meta property="og:description" content="{{ shortenClean($page->content, 200) }}" />
            @endif
        @else
            <meta property="og:image" content="{{ \Request::root() }}/imagecache/facebook/facebook.jpg" />
            <meta property="og:description" content="{{ config('formable.site_description') }}" />
        @endif

        <meta property="og:image:width" content="600"/>
        <meta property="og:image:height" content="315"/>

        <link rel="stylesheet" href="/css/bundle.css">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/js/bundle.js"></script>
        <script>
        Vue.config.debug = true;
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        </script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="Head {{ frontpage() ? 'frontpage' : '' }}"
             style="background: url('/imagecache/frontpagebanner/mynd1.jpg') center center no-repeat; background-size: cover;">
            <a href="/" id="logo"><img src="/img/logo-{{ lang() }}.png" /></a>
        </div>

        <div class="Menu">
            <nav class="main">
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
            <a href="?language=no">Norsk</a>
            <a href="?language=is">Íslenska</a>
            <h1>hey</h1>
        </div>
        <div id="Bottom">
            @if(lang()=='no')
                <p>Sikkerhetsgjerder AS · Tomteråsveien 23 · 2165 Hvam · Tlf 99 11 42 22 · <a href="mailto:post@sikkerhetsgjerder.no">post@sikkerhetsgjerder.no</a></p>
            @else
                <p>Öryggisgirðingar ehf · Suðurhraun 2 · 210 Garðabær · Sími 544 4222 · Fax 544 4221 · <a href="mailto:girding@girding.is">girding@girding.is</a></p>
            @endif
        </div>

        <script src="/js/scripts.js"></script>
    </body>
</html>
