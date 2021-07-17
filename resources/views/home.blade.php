@extends('layouts.app')

@section('content')
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="container">
        <div class="row text-center">
            <h1>List Blogs</h1>
        </div>
        <div class="row">
            <a href="{{route('post.create')}}" class="btn btn-success">Create a new post</a>
        </div>
        <div class="row">

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post )
                        <tr>
                            <th scope="row">{{$post->post_id}}</th>
                            <td>{{$post->post_title}}</td>
                            <td>{{$post->post_content}}</td>
                            <td>
                                <form method="POST" action="{{ route(  'post.destroy',$post->post_id) }}">
                                    @csrf
                                    <a href="{{ route( 'post.edit', $post->post_id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    {{ method_field('Delete')}}
                                    <input type="submit" class="btn btn-danger btn-sm delete-post" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
        {{-- <div class="row">
            <h1>List Images</h1>
        </div>
        <div class="row">
            <a href="{{route('image.create')}}" class="btn btn-success">Upload a new image</a>
        </div>

        <div class="row">

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image )
                        <tr>
                            <th scope="row">{{$image->id}}</th>
                            <td>{{$image->title}}</td>
                            <td><img src="public/images/{{$image->url}}" alt=""></td>
                            <td>
                                <form method="POST" action="{{ route(  'post.destroy',$post->post_id) }}">
                                    @csrf
                                    <a href="{{ route( 'post.edit', $post->post_id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    {{ method_field('Delete')}}
                                    <input type="submit" class="btn btn-danger btn-sm delete-post" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

        </div> --}}

    </div>
@endsection
