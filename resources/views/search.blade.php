@extends('layouts.app')

@section('content')


    @if($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <section class="blog-list px-3 py-5 p-md-5">
        <a href="{{route('newsfeed')}}" class="btn btn-primary mb-4"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        <div class="container">

            @foreach ($posts as $post )

                    {{-- @foreach ($user->posts as $post ) --}}
                        <div class="item mb-5">
                            <div class="media">
                                <img class="mr-3 img-fluid post-thumb d-none d-md-flex avatar avatar-online" src="{{ url( '/images/'.$post->user->image ) }} " alt="image">
                                <div class="media-body">
                                    <h3 class="title mb-1"><a href="{{route('post.detail', $post->post_id)}}">{{$post->post_title}}</a></h3>
                                    <div class="meta mb-1"><span class="date">Published at {{$post->created_at}}</span><span class="time"></span><span class="comment"><a href="#">4 comments</a></span></div>
                                    <div class="intro">{{$post->post_content}}</div>
                                    <a class="more-link" href="{{route('post.detail', $post->post_id)}}">Read more &rarr;</a>
                                </div><!--//media-body-->
                            </div><!--//media-->
                        </div><!--//item-->
                    {{-- @endforeach --}}

            @endforeach

            <nav class="blog-nav nav nav-justified my-5">
              <a class="nav-link-prev nav-item nav-link rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
              <a class="nav-link-next nav-item nav-link rounded-right" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
            </nav>

        </div>
    </section>
@endsection
