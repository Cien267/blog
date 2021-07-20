<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;

use Pusher\Pusher;
use App\Events\NewComment;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::where('user_id','=', auth()->user()->id )->get();
        return view('home')->with('posts',$posts);
    }

    public function profile(){
        $user = User::where('id','=', auth()->user()->id )->first();
        return view('profile')->with('user', $user);
    }

    public function store(ImageRequest $request){
        $validated = $request->validated();

        $user = User::where('id','=', auth()->user()->id )->first();

        $imageName = time().'.'.$request->image->extension();

        $user->image = $imageName;

        $user->save();

        $request->image->move(public_path('images'), $imageName);

        return redirect('profile');

    }

    public function editProfile(Request $request){
        $user = auth()->user();
        return view('edit_profile')->with('user',$user);
    }

    public function updateProfile(ImageRequest $request){
        $user = auth()->user();

        $validated = $request->validated();

        if($request->image == null){
            $imageName = $user->image;
        }else {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $user->update([
            'name' => $request->name,
            'image' => $imageName,
            'phone' => $request->phone,
            'profession' => $request->profession,
            'email' => $request->email,
            'created_at' => now(),
        ]);
        return redirect()->route('user.profile')->with('success','Your profile has been updated');
    }

    public function storeComment(Request $request, Post $post){
        $userId = auth()->user()->id;
        $postId = $post->post_id;

        // dd($request);

        Comment::create([
            'content' => $request->comment_content,
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        $comment = ['content' => $request->comment_content,'user_id' => $userId,'post_id' => $postId, 'created_at' => now()];
        $user = ['id' => $userId, 'name' => auth()->user()->name, 'image' =>  auth()->user()->image];

        event(new NewComment($comment, $user));

        return back();
    }

    public function storeReply(Request $request, Post $post){

        $reply = new Comment();

        $reply->content = $request->get('reply_content');

        $reply->user()->associate($request->user());

        $reply->post_id = $post->post_id;

        $reply->parent_id = $request->get('comment_id');

        $post->comments()->save($reply);

        return back();

    }


    public function checkAuthorization($id){

        $user = User::where('id',$id)->first();

        return view('profile_friend')->with('user',$user);
    }
}
