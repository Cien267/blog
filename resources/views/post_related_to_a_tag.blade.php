@extends('layouts.app')

@section('content')



    <section class="blog-list px-3 py-5 p-md-5">
        <div class="container">
            @if($message = Session::get('fail'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            {{-- <div class="alert alert-success">
                <h1>{{$fail}}</h1>
            </div> --}}



            <br><br><br>
            @foreach ($posts as $post )
                {{-- @if($user->posts->count() > 0) --}}
                    {{-- @foreach ($user->posts as $post ) --}}
                        <div class="item mb-5">
                            <div class="media">
                                <a href="{{route('check-authorization',$post->user->id)}}"><img class="mr-3 img-fluid post-thumb d-none d-md-flex avatar avatar-online newsfeed" src="{{ url( '/images/'.$post->user->image ) }}" alt="image"></a>
                                <div class="media-body">
                                    <h3 class="title mb-1"><a href="{{route('post.detail', $post->post_id)}}">{{$post->post_title}}</a></h3>
                                    <div class="meta mb-1"><span class="date">Published at {{$post->created_at}}  </span><span class="time pl-2"></span><span class="comment"><a href="#">{{$post->comments->count()}} <i class="fa fa-comments" aria-hidden="true"></i></a></span></div>
                                    <div class="intro">{{$post->post_content}}</div>
                                    <a class="more-link" href="{{route('post.detail', $post->post_id)}}">Read more &rarr;</a>
                                </div><!--//media-body-->
                            </div><!--//media-->
                        </div><!--//item-->
                    {{-- @endforeach --}}
                {{-- @endif --}}
            @endforeach


            <div class="row make_a_space">

            </div>

        </div>
        {{-- <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div> --}}
        <div class="footer-basic">
            <footer>
                <div class="social">
                    <a href="#"><i class="icon fa fa-instagram"></i></a>
                    <a href="#"><i class="icon fa fa-snapchat"></i></a>
                    <a href="#"><i class="icon fa fa-twitter"></i></a>
                    <a href="#"><i class="icon fa fa-facebook"></i></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Home</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">About</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                </ul>
                <p class="copyright">Company Name © 2018</p>
                </footer>
            </div>
    </section>

@endsection
