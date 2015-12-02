@if(isset($crumbs) && !empty($crumbs))
	<div class="container">
		<div id="crumbs">
			<ul>
				{{-- <li><a href="/"><i class="fa fa-home"></i></a></li> --}}
				<li><a href="/">HEIM</a></li>
			
				@foreach($crumbs as $slug => $crumb)
					@if(\Request::path() != ltrim(rtrim($crumb['path'], '/'), '/'))
						<li><a href="{{ $crumb['path'] }}">{{ $crumb['title'] }}</a></li>
					@else
						<li>{{ $crumb['title'] }}</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>
@endif