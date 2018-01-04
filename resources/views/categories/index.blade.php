@extends('layouts.kit')

@section('title') {{ " 目录 | " }}  @endsection

@section('plugins_css')
<!-- TTTTTTTTTTTTTTTTTTTT  -->
<link href="{{asset('plugins/simple-accordion/css/style.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div id="categories-index" class="section">
	<div class="container">

		<div class="acc-container">
			
			@foreach($categories as $category)
		  <div class="acc-btn">
		  	<h1 class="{{ $loop->first ? 'selected' : '' }}">
		  		{{ $category['title'] }}
		  		<small> ( {{ isset($category['children']) ? count($category['children']) : 1 }} 个目录 ) </small>
	  		</h1>
	  	</div>
		  <div class="acc-content {{ $loop->first ? 'open' : '' }}">
		    <div class="acc-content-inner">
		    	@if(isset($category['children']))
			    	@foreach($category['children'] as $category)
	        	<a href="{{ route('posts.category',['id'=>$category['id']]) }}"
	        	 class="btn btn-neutral"
	        	 > {{ $category['title'] }} </a>
	        	@endforeach
		    	@else
	        	<a href="{{ route('posts.category',['id'=>$category['id']]) }}"
	        	 class="btn btn-neutral"
	        	 > {{ $category['title'] }} </a>
		    	@endif
		    </div>
		  </div>
		  @endforeach
		
		</div>

	</div>
</div>
@endsection

@section('level_js')
<script src="{{asset('plugins/simple-accordion/js/index.js')}}"></script>
@endsection