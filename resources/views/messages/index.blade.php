
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


