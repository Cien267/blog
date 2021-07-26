@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-5">
            <h1 style="color:#5F9EA0">All tags:</h1>
        </div>
        <div class="row">
            @foreach ($tags as $tag)
                <div class="col-3 pb-4">
                    <a href="{{route('tag.posts', $tag->id)}}" class="btn btn-xs btn-outline-success tag-btn animated zoomIn">{{$tag->name}} ({{$tag->posts->count()}})</a>
                </div>
            @endforeach
        </div>
        <div class="row make_a_space">

        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-snapchat"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
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
@endsection
