<a href="{{ isset($path_prefix) ? '/'.$path_prefix.'/' : '/'.(isset($path_cut) ? rtrim(\Request::path(), $path_cut) : \Request::path().'/') }}{{ $item->slug }}"
   class="Card">
    <span class="Card__content">
        {{ $item->title }}
    </span>
    <span class="Card__image"
          style="background: url('/imagecache/medium/{{ $item->img()->first() }}') center center no-repeat;
                 background-size: cover;">
    </span>
    <span class="Card__color">
    </span>
</a>