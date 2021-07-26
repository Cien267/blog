<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script stype="text/javascript">
        $(document).ready(function () {

            //autocomplete search
            $('#keywords').keyup(function(){
                var query = $(this).val();
                if(query != ''){
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/autocomplete-ajax')}}",
                        method: "POST",
                        data :{
                            query: query,
                            token: token
                        },
                        success: function(data){
                            $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                        }
                    });
                }else {
                    $('#search_ajax').fadeOut();
                }
            });

            $(document).on('click','.li_autocomplete', function(){
                $('#keywords').val($(this).text());
                $('#search_ajax').fadeOut();
            })


            //ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#leave_comment_button').click(function(){
                    var content = $("textarea[name=comment_content]").val();
                    var user_id = "{{ Auth::id() }}";
                    var post_id = $("input[name=postid]").val();
                    $.ajax({
                        url: "/detail/store_comment",
                        type: "POST",
                        data: {
                            content: content,
                            user_id: user_id,
                            post_id: post_id,
                        }
                    });
                });



            //pusher
            Pusher.logToConsole = true;
            var pusher = new Pusher('7d211f0edc5b3cebe172', {
            cluster: 'ap1',
            forceTLS: true
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('comment-added', function(data) {
                console.log($('#link').attr('href')); //http://localhost:8000/1/profile
                console.log(data.user);
                var author_id = $("input[name=author_id]").val();
                var x = $('#link').attr('href').replace(author_id, data.user.id);
                console.log(x);
                $('#comment').append(`
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="media"> <a href="${x}"><img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="{{ url( '/images/${data.user.image}' ) }}" /> </a>
                                    <div class="media-body pb-5">
                                        <div class="row">
                                            <div class="col-8 d-flex">
                                                <h5><a href="${x}">${data.user.name}</a></h5> <span class="pl-2"><i class="fa fa-clock-o"></i> Posted at ${data.comment.created_at}<span id="post_at"></span></span>
                                            </div>
                                            <div class="col-4">
                                                <div class="pull-right reply"> <button class="btn btn-link" id="reply_button"><span><i class="fa fa-reply"></i> reply</span></button> </div>
                                            </div>
                                        </div>
                                        <div class="cmt_content">
                                            ${data.comment.content}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                `);



            });

        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile_style.css')}}">

    {{-- css --}}

    <style>


        *,
        *::before,
        *::after {
          box-sizing: border-box;
        }

        body {
          font-family: "Roboto", sans-serif;
        }

        h1 {
          margin: 0 0 50px;
          font-family: "Montserrat", sans-serif;
          color: #213251;
          text-align: center;
        }

        p {
          margin: 0;
          font-family: "Roboto", sans-serif;
          line-height: 1.6;
          font-size: 17px;
          letter-spacing: 0.16px;
        }

        .vcv-container {
          padding: 30px;
        }

        .vce {
          margin-bottom: 30px;
        }

        .vce-message-box,
        .vce-outline-message-box,
        .vce-semi-filled-message-box,
        .vce-simple-message-box {
          border-radius: 5px;
          padding: 17px 20px;
          font-size: 1em;
        }

        .vce-message-box {
          color: #fff;
        }

        .vce-message-box-inner,
        .vce-outline-message-box-inner,
        .vce-simple-message-box-inner {
          padding-left: 2.5em;
          position: relative;
        }

        .vce-message-box-icon,
        .vce-outline-message-box-icon {
          position: absolute;
          bottom: 0;
          left: 0;
          top: 50%;
          font-weight: 400;
          height: 100%;
          font-size: 1.7em;
          line-height: 1;
          font-weight: 400;
          font-style: normal;
          -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
          display: flex;
          align-items: center;
        }

        .vce-message-box-style--success {
          background: #4bd67b;
        }

        .vce-message-box-style--information {
          background: #71b2df;
        }

        .vce-message-box-style--warning {
          background: #f5c76f;
        }

        .vce-message-box-style--error {
          background: #f57e7c;
        }

        .vce-outline-message-box {
          color: #fff;
          border-width: 2px;
          border-style: solid;
        }

        .vce-outline-message-box-style--success,
        .vce-semi-filled-message-box-style--success,
        .vce-simple-message-box-style--success {
          border-color: #4bd67b;
          color: #4bd67b;
        }

        .vce-outline-message-box-style--information,
        .vce-semi-filled-message-box-style--information,
        .vce-simple-message-box-style--information {
          border-color: #71b2df;
          color: #71b2df;
        }

        .vce-outline-message-box-style--warning,
        .vce-semi-filled-message-box-style--warning,
        .vce-simple-message-box-style--warning {
          border-color: #f5c76f;
          color: #f5c76f;
        }

        .vce-outline-message-box-style--error,
        .vce-semi-filled-message-box-style--error,
        .vce-simple-message-box-style--error {
          border-color: #f57e7c;
          color: #f57e7c;
        }

        .vce-semi-filled-message-box {
          border-width: 1px;
          border-style: solid;
          overflow: hidden;
          position: relative;
        }

        .vce-semi-filled-message-box-inner {
          padding-left: 60px;
        }

        .vce-semi-filled-message-box-icon {
          -webkit-transition: none;
          transition: none;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          font-style: normal;
          font-weight: 400;
          width: 60px;
          display: flex;
          justify-content: center;
          align-items: center;
          color: #fff;
        }

        .vce-semi-filled-message-box-style--success .vce-semi-filled-message-box-icon {
          background: #4bd67b;
        }

        .vce-semi-filled-message-box-style--information .vce-semi-filled-message-box-icon {
          background: #71b2df;
        }

        .vce-semi-filled-message-box-style--warning .vce-semi-filled-message-box-icon {
          background: #f5c76f;
        }

        .vce-semi-filled-message-box-style--error .vce-semi-filled-message-box-icon {
          background: #f57e7c;
        }

        .vce-simple-message-box {
          border-width: 1px;
          border-style: solid;
        }

        .vce-simple-message-box-icon {
          -webkit-transition: none;
          transition: none;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          font-style: normal;
          font-weight: 400;
          width: 2.5em;
          height: 100%;
          display: flex;
          align-items: center;
        }

        .vce-simple-message-box-style--success {
          background: lighten(#4bd67b, 40%);
        }

        .vce-simple-message-box-style--information {
          background: lighten(#71b2df, 25%);
        }

        .vce-simple-message-box-style--warning {
          background: lighten(#f5c76f, 25%);
        }

        .vce-simple-message-box-style--error {
          background: lighten(#f57e7c, 20%);
        }
              </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-th-list" aria-hidden="true"></i>
                </a>
                <a class="navbar-brand" href="{{ url('/newsfeed') }}">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                </a>
                <a class="navbar-brand" href="{{ url('/messenger') }}">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
                <a class="navbar-brand" href="{{ url('/tags') }}">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                </a>
                <a class="navbar-brand" href="{{ url('/notification') }}">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('user.profile') }}">

                                        Your Profile
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
