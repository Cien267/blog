@extends('layouts.app')

@section('content')
    @foreach ($notifications as $noti)

        {{-- @php
        dd($noti->updated_at->toDateTimeString());

         $notification = json_decode($noti->data);
         $time = json_decode($noti)->created_at;
        @endphp --}}
        {{-- @php dd($noti->data['likes']); @endphp --}}
        @if(isset($noti->data['comment']))
            <div><span>{{$noti->data['user']['name']}}</span> has commented on your post at <span>{{$noti->updated_at->toDateTimeString()}}</span></div>
        @endif
        @if (isset($noti->data['likes']))
            <div><span>{{$noti->data['user']['name']}}</span> has liked your post at <span>{{$noti->updated_at->toDateTimeString()}}</span></div>
        @endif


        {{-- <div>
            @php
                 dd(json_decode($noti)->created_at);
            @endphp
        </div> --}}
    @endforeach
@endsection
