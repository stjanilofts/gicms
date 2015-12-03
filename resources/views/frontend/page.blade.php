@extends('frontend.layout')

@section('crumbs')

	@include('frontend._crumbs', ['crumbs'=>crumbs()])

@stop

@section('content')

		<div class="Page">
			<div class="Page__contents">
				<h1>{{ $page->translation('title') }}</h1>

				{!! cmsContent($page) !!}

				@if(\Request::is('hafa-samband') || \Request::is('ta-kontakt'))
					@include('frontend.forms.contact')
				@endif

				<hr>

				<div class="fb-like" data-href="{{ \Request::root() }}/{{ \Request::path() }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
			</div>
		</div>

		@if(\Request::is('fyrirtaekid'))
			<div class="Map" style="line-height: 1em; font-size: 1em; padding: 0; margin: 0; overflow: hidden; height: 600px; border: none !important; ">
				<iframe width="100%" height="600" frameborder="0" style="border: none !important; line-height: 1em; font-size: 1em; padding: 0; margin: 0;" src="http://ja.is/kort/embedded/?zoom=9&x=357250&y=400618&layer=map&q=%C3%96ryggisgir%C3%B0ingar+ehf%2C+Su%C3%B0urhrauni+2"></iframe>
			</div>
		@endif
	
@stop