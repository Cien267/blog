@extends('layouts.app')

@section('content')

    <div class="main-wrapper">

	    <article class="blog-post px-3 py-5 p-md-5">
            {{-- <a href="{{route('newsfeed')}}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> --}}
		    <div class="container">

			    <header class="blog-post-header">
				    <h2 class="title mb-2">{{$post->post_title}}</h2>
				    <div class="meta mb-3"><span class="date">Published at {{$post->created_at}}  </span><span class="time pl-2"></span><span class="comment"><a href="#comment">{{count($comments)}} <i class="fa fa-comments" aria-hidden="true"></i></a></span><span class="comment pl-2"><a href="#">0 <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></span><span class="comment pl-2"><a href="#">0 <i class="fa fa-share" aria-hidden="true"></i></a></span></div>

                        <div class="meta mb-3">
                            @foreach ($tags as $tag)
                                <span class="date pl-2"><a href="{{route('tag.posts', $tag->id)}}">{{$tag->name}}</a></span>
                            @endforeach
                        </div>


			    </header>

			    <div class="blog-post-body">

				    <h3 class="mt-5 mb-3">Author:  <a href="{{route('check-authorization',$post->user->id)}}">{{$post->user->name}}</a> </h3>
				    <p>{{$post->post_content}}</p>
				    <pre>
					    <code style="color: green">
                            if you like this post, do not hesitate to give it a like: <a href="#"><i style="font-size: 30px" class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
					    </code>
				    </pre>
			    </div>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container mb-5 mt-5">
    <div class="card">
        <div class="row">

            <div class="col-md-12" id="comment">
                <h3 class="text-center mb-5">Comments ({{count($comments)}})</h1></h3>
            @foreach ($comments as $comment )
                @if($comment->parent_id == 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="media"> <a href="{{route('check-authorization',$comment->user->id)}}"><img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="{{ url( '/images/'.$comment->user->image ) }}" /> </a>
                            <div class="media-body pb-5">
                                <div class="row">
                                    <div class="col-8 d-flex">
                                        <h5><a href="{{route('check-authorization',$comment->user->id)}}">{{$comment->user->name}}</a></h5> <span class="pl-2"><i class="fa fa-clock-o"></i> Posted at {{$comment->created_at}}</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="pull-right reply"> <button class="btn btn-link" id="reply_button"><span><i class="fa fa-reply"></i> reply</span></button> </div>
                                    </div>
                                </div> {{$comment->content}}
                                @foreach ($comment->replies as $reply)
                                <div class="media mt-4"> <a class="pr-3" href="{{route('check-authorization',$comment->user->id)}}"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="{{ url( '/images/'.$reply->user->image ) }}" /></a>
                                    <div class="media-body">

                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <a class="pr-3" href="{{route('check-authorization',$comment->user->id)}}"><h5>{{$reply->user->name}}</a></h5> <span class="pl-2"><i class="fa fa-clock-o"></i> Posted at {{$reply->created_at}}</span>
                                                </div>
                                            </div> <div class="pl-3">{{$reply->content}}</div>

                                    </div>
                                </div>
                                @endforeach
                                <div class="row leave_comment pt-4">
                                    <form class="form-block" method="post" action="{{route('user.comment.reply.store', $post->post_id)}}">
                                        @csrf
                                             <div class="text-info ">Reply here:</div>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <textarea name="reply_content" id="reply_field" class="form-input" required="" placeholder="Text here"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                            <input type="submit" class="btn btn-primary pull-right" value="Reply">
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                @endif
            @endforeach

                <div class="row leave_comment" >
                    <form class="form-block" method="post" action="{{route('user.comment.store', $post->post_id)}}">
                        @csrf
                            <div class="row pt-4 font-weight-bold text-info pl-4">
                                Leave a comment:
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea name="comment_content" class="form-input" required="" placeholder="Text here"></textarea>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary pull-right" value="Comment">
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>





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
    </div>
</div>
@endsection
