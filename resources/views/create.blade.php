@extends('layouts')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h1>Create a new post</h1>
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
            <a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        </div>
        <div class="row">
            <form action="{{ route('post.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" placeholder="title" name="title">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Content</label>
                  <textarea class="form-control" rows="3" placeholder="content" name="content"></textarea>
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" class="form-control" placeholder="add tag" name="tag">
                    <label for="tag" class="text-danger"> * Your tags should start with "#", and be separated by a space</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add" class="btn btn-primary">
                  </div>
              </form>
        </div>
    </div>
@endsection
