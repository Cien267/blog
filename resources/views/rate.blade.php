<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row" style="height: 200px"></div>
        <div class="row">
            <script>
                document.write('<a href="' + document.referrer + '" class="btn btn-primary">Back</a>');
          </script>
        </div>
        <div class="row" style="height: 100px"></div>
        <div class="row"><h2>Rate this post:</h2></div>
        <div class="row">
            <ul class="list-inline rating"style="display:flex; list-style: none;text-decoration: none;" title="average rating">
                @for ($count = 1; $count <= 5; $count++ )
                @php
                    if($count <= $rating){
                        $color = 'color:#ffcc00';
                    }else{
                        $color = 'color:#ccc';
                    }

                @endphp
                    <li title="star-rating"
                    id="{{$post->post_id}}-{{$count}}"
                    data-index="{{$count}}"
                    data-post_id="{{$post->post_id}}"
                    data-user_id="{{$post->user->id}}"
                    data-rating="{{$rating}}"
                    class="rating"
                    style="cursor:pointer; {{$color}}; font-size: 30px;"

                    >&#9733</li>
                @endfor
            </ul>
        </div>

    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });



         //rating
                function remove_background(post_id){
                    for(var count = 1; count <= 5; count++){
                        $('#'+post_id+'-'+count).css('color','#ccc');
                    }
                }
                $(document).on('mouseenter', '.rating', function(){
                    var index = $(this).data("index");
                    var post_id = $(this).data("post_id");
                    remove_background(post_id);
                    for(var count = 1; count <= index; count++){
                        $('#'+post_id+'-'+count).css('color','#ffcc00');
                    }
                });
                $(document).on('mouseleave', '.rating', function(){
                    var index = $(this).data("index");
                    var post_id = $(this).data("post_id");
                    var rating = $(this).data("rating");
                    remove_background(post_id);
                    for(var count = 1; count <= index; count++){
                        $('#'+post_id+'-'+count).css('color','#ffcc00');
                    }
                });

                $(document).on('click', '.rating', function(){
                    var index = $(this).data("index");
                    var post_id = $(this).data("post_id");
                    var user_id = $(this).data("user_id");
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "/insert-rate",
                        type: "POST",
                        data: {
                            index: index,
                            post_id: post_id,
                            _token: _token,
                            user_id: user_id,

                        }

                    })
                });

    </script>
</body>

</html>




