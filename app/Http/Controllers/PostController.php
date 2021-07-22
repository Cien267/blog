<?php

namespace App\Http\Controllers;

use DB;
use App\Tag;
use App\Post;
use App\Rate;
use App\User;
use App\Comment;
use App\Notification;

use Jorenvh\Share\Share;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewLikeNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(){
        return view('create');
    }

    public function store(PostRequest $request){
        $validated = $request->validated();

        $post = new Post();
        $post->create([
            'user_id' => auth()->user()->id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'created_at' => now(),
        ]);
        $postId = Post::orderBy('post_id','desc')->first()->post_id;

        $tagList = explode(" ",$request->tag );

        foreach($tagList as $tag){

            $result = Tag::where('name', $tag)->first();
            if($result) {
                $tagId = $result->id;
            }else {
                Tag::create([
                    'name' => $tag,
                    'created_at' => now(),
                ]);
                $tagId = Tag::orderBy('id','desc')->first()->id;
            }

            $tag = Tag::find($tagId); //tag id

            $tag->posts()->attach($postId); //post id

        }

        return redirect('home')->with('success', 'a blog has been added!');
    }

    public function edit(Post $post, Request $request){

        return view('edit')->with('post', $post);
    }

    public function update(Request $request, Post $post){
        $post->update([
            'post_title' => $request->title,
            'post_content' => $request->content,
            'created_at' => now(),
        ]);
        return redirect()->route('home')->with('success','post has been updated');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('home')->with('success','post has been deleted');
    }


    public function getnewsfeed(){

        $posts = Post::with(['user' => function($query){
            $query->with('comments');
        }])->orderBy('created_at','desc')->paginate(5);


        return view('newsfeed')->with('posts',$posts);

    }

    public function search(Request $request){

        $data = $this->userService->search($request->input('search'));

        return view('search',['users'=>$data]);
    }

    public function detail(Post $post){

        $comments = Comment::with('user')
                            ->where('post_id', $post->post_id)
                            ->with(['replies' =>function($q){
                                $q->with('user');
                            }])->get();

        // $data = $post->with(['comments' => function($q){
        //     $q->with('user');
        // }])->get();dd($data);


            // dd($post->load('tags'));
        $tags = $post->tags;

        $share =  new Share();
        $share->currentPage()->facebook()
                            ->twitter()
                            ->linkedin()
                            ->whatsapp()
                            ->telegram();
        // dd($share);
        // $tags = Tag::with('posts')->first()->posts;


        $rating = round(Rate::where('post_id',$post->post_id)->avg('rating'));


        return view('detail')->with('post',$post)
                            ->with('comments', $comments)
                            ->with('tags',$tags)
                            ->with('share', $share)
                            ->with('rating', $rating);
    }

    public function countLike($id){
        $post = Post::where('post_id', $id)->first();
        $likeAmount =  $post->like;
        $likeAmount++;
        $post->like = $likeAmount;
        $post->save();

        $userId  = $post->user->id;
        if($userId != auth()->user()->id){
            $user = User::where('id',$userId)->first();
            $user->notify(new NewLikeNotification($likeAmount));

        }


        return back();
    }

    public function showNoti(){
        // $notifications = Notification::all();
        // $notifications = json_decode($notifications);
        // dd($notifications);
        // foreach($notifications as $noti){
        //     dd($noti);
        // }
        $user = User::where('id',auth()->user()->id)->first();
        $notifications =$user->notifications;
        // dd($notifications);

        return view('notification')->with('notifications', $notifications);
    }


    public function rate(Post $post){

        $rating = round(Rate::where('post_id',$post->post_id)->avg('rating'));
        return view('rate')->with('post',$post)
                            ->with('rating',$rating);
    }

    public function insert_rate(Request $request){
        $data = $request->all();
        $rate = new Rate();
        $rate->post_id = $data['post_id'];
        $rate->rating = $data['index'];
        $rate->user_id = $data['user_id'];
        $rate->save();
        echo 'done';
    }



}
