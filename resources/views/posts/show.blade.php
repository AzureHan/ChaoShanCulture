@extends('layouts.kit')

@section('title') {{ $post->title . " | " }}  @endsection

@section('content')

<div class="section">
	<div class="container">
		{!! $post->body !!}
	</div>
</div>

@endsection