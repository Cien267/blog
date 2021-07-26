
<div class="row heading">
    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
      <div class="heading-avatar-icon">
        <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
      </div>
    </div>
    <div class="col-sm-8 col-xs-7 heading-name">
      <a class="heading-name-meta">John
      </a>
      <span class="heading-online">Online</span>
    </div>
    <div class="col-sm-1 col-xs-1  heading-dot pull-right">
      <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
    </div>
  </div>




  @foreach ($messages as $message)
<div class="row message-body">
    <div class="col-sm-12 {{ ($message->sender_id == Auth::id()) ? 'message-main-sender' : 'message-main-receiver' }}">
      <div class="{{ ($message->sender_id == Auth::id()) ? 'sender' : 'receiver' }}">
        <div class="message-text">
          {{$message->content}}
        </div>
        <span class="message-time pull-right">
            {{ date('d M y, h:i a', strtotime($message->created_at)) }}
        </span>
      </div>
    </div>
  </div>
@endforeach


