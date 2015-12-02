@extends('frontend.layout')

@section('crumbs')

	@include('frontend._crumbs', ['crumbs'=>crumbs()])

@stop

@section('content')

		<div class="Page">
			<h1>{{ $page->translation('title') }}</h1>

			{!! cmsContent($page) !!}

			@if(\Request::is('hafa-samband') || \Request::is('ta-kontakt'))
				@include('frontend.forms.contact')
			@endif
		</div>
	
@stop