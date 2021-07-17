@extends('layouts')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h1>Edit the post</h1>
        </div>
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
             @endif
        </div>
        <div class="row">
            <a href="{{route('home')}}" class="btn btn-default">Back</a>
        </div>
        <div class="row">
            <form action="{{ route( 'post.update',$post->post_id) }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" placeholder="title" name="title" value="{{$post->post_title}}">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Content</label>
                  <textarea class="form-control" rows="3" placeholder="content" name="content">{{$post->post_content}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                  </div>
              </form>
        </div>
    </div>
@endsection
