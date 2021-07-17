<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagController extends Controller
{
    public function tagList(){
        $tags = Tag::all();
        return view('tag_list')->with('tags', $tags);
    }

    public function tagPosts($id){
        $tag = Tag::where('id',$id)->first();
        // dd($tag);
        $posts = $tag->posts;

        $fail = "There are not any posts related to this tag!";

        return view('post_related_to_a_tag')->with('posts',$posts);




    }
}
