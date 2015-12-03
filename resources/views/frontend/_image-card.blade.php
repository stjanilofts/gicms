<a href="/imagecache/original/{{ $item->img()->first() }}"
   class="Card image-popup">
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