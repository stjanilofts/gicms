@extends('frontend.layout')

@section('crumbs')

	@include('frontend._crumbs', ['crumbs'=>crumbs()])

@stop

@section('content')

	<div class="product-container">
		<div class="Product"
			 style="background: #333 url('/imagecache/productbg/{{ $item->img()->first() }}') center center no-repeat; background-size: cover;">
			<div class="Product__left">
				<div class="Product__images">
					<div class="Product__image">
						<a class="image-popup" href="/imagecache/original/{{ $item->img()->first() }}"><img data-image="{{ $item->img()->first() }}" src="/imagecache/large/{{ $item->img()->first() }}" /></a>
					</div>

					@if(count($item->img()->all()) > 1)
						<div class="Product__extra-images" style="margin-bottom: 0;">
							@foreach($item->img()->all() as $img)
								<div class="Product__extra-image">
									<img data-image="{{ $img['name'] }}" src="/imagecache/medium/{{ $img['name'] }}" />
								</div>
							@endforeach
						</div>
					@endif
				</div>
			</div>

			<div class="Product__right">
				<div class="Product__content">
					<h1>{{ $item->title }}</h1>

					{!! cmsContent($item) !!}

					@if($item->file()->all())
						<h3>Nánari upplýsingar</h3>
						@foreach($item->file()->all() as $file)
							<a class="takki smaller" href="/files/{{ $file['name'] }}"><i class="fa fa-file-o"></i> {{ $file['title'] ?: $item['title'] }}</a>
						@endforeach
					@endif

					<hr>

					<div class="fb-like" data-href="{{ \Request::root() }}/{{ \Request::path() }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				</div>
			</div>
		</div>
	</div>

	@if($item->modelName() != 'Category')
		@include('frontend._products', ['items'=>$item->getVisibleSiblings()->sortBy('order'), 'path_cut'=>$item->slug])
	@endif

	<script>
	$('.Product__extra-image img').click(function() {
		console.log($(this).attr('data-image'));
		$('.Product__image img').attr('src', '/imagecache/large/' + $(this).attr('data-image'));
		$('.Product__image a').attr('href', '/imagecache/original/' + $(this).attr('data-image'));
	});
	$('.Product__extra-images').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		arrows: false,
		responsive: [
			{
				breakpoint: 1400,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
		]
	});
	</script>
@stop