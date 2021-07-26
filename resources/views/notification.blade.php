@extends('layouts.app')

@section('content')


        {{-- @php
        dd($noti->updated_at->toDateTimeString());

         $notification = json_decode($noti->data);
         $time = json_decode($noti)->created_at;
        @endphp --}}
        {{-- @php dd($noti->data['likes']); @endphp --}}

            <div></div>


            <div></div>



        {{-- <div>
            @php
                 dd(json_decode($noti)->created_at);
            @endphp
        </div> --}}


    <div class="vcv-container">
        <h1>Notifications</h1>
        @foreach ($notifications as $noti)
        @if(isset($noti->data['comment']))
        <div class="vce-message-box vce vce-message-box-style--success">
          <div class="vce-message-box-inner">
            <span class="vce-message-box-text">
              <p><span>{{$noti->data['user']['name']}}</span> has commented on your post at <span>{{$noti->updated_at->toDateTimeString()}}</span></p>
            </span>
          </div>
        </div>
        @endif

        @if (isset($noti->data['likes']))
        <div class="vce-message-box vce vce-message-box-style--error">
          <div class="vce-message-box-inner">
            <span class="vce-message-box-text">
              <p><span>{{$noti->data['user']['name']}}</span> has liked your post at <span>{{$noti->updated_at->toDateTimeString()}}</span></p>
            </span>
          </div>
        </div>
        @endif
        @endforeach

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
