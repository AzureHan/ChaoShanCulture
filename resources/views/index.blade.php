@extends('layouts.kit')

@section('content')
<div class="section">
  <div class="container tim-container">
    
    <div id="categories-posts">
      @foreach($categories as $category)
      @if(!$loop->first)
      <hr>
      @endif
      <div class="category-posts">     
        <div class="tim-title">
            <h3> {{ $category->title }} </h3>
        </div>
        <div class="row">
          @foreach($category->posts->take(5) as $post)
            <div class="post-item">
              <div class="{{ $post->images_count > 0 ? 'col-md-9' : 'col-md-12' }}">
                <p>
                  <span class="label label-primary"> {{ $post->category->title }} </span>
                  <a href="{{ URL('/p/' . $post->id) }}" class="btn btn-simple post-title"> {{ $post->title }} </a>
                </p>
                <p class="hidden-xs">
                  <i class="fa fa-calendar"></i>
                  <small> {{ $post->create_date }} </small>
                </p>
                <p class="hidden-xs">
                  <span class="btn-simple"> {{ $post->body }} </span>
                </p>
              </div>
              @if($post->images_count > 0)
              <div class="col-md-3">
                <div class="post-cover img-rounded img-responsive">
                  <img class="img-responsive" alt="{{ $post->title }}"
                    src="{{ asset('storage/posts/images/'.$post->images->first()->uri) }}">
                </div>
              </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
    <!-- end categories div -->

  </div>
</div>
@endsection