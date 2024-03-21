<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function homepage()
    {
        $latest = Post::latest()->take(3)->get();

        // $categories = Category::oldest('title')->with('posts')->get();
        // $categories = Category::oldest('title')->with(['posts' => function ($query) {
        //     $query->take(2);
        // }])->get();

        // $categories = Category::oldest('title')->with(['posts' => function ($query) {
        //     $query->orderBy('created_at', 'desc')->take(6);
        // }])->has('posts')->get();

        $categories = Category::oldest('title')->has('posts')->get();


        return view('welcome', compact('latest', 'categories'));
    }


    public function post_view($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $hasLiked = false;
        if (auth()->check()) {
            $user_id = auth()->id();
            $post_id = $post->id;
            $hasLiked = Like::where('user_id', $user_id)->where('post_id', $post_id)->exists();  
        }
        return view('posts.read', compact('post' , 'hasLiked'));
    }


    public function new_comment(Request $request, $slug)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', "You need to be logged in to leave a comment");
        }

        $data = $request->validate([
            'comment' => "required|string|max:255"
        ]);

        $post = Post::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'comment' => $data['comment']
        ]);

        return back()->withFragment('comments')->with('success', 'Comment Added');
    }


    public function new_like(Request $request, $slug)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', "You need to be logged in to like a post");
        }



        $post = Post::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $check_user_like = Like::where('user_id', $user->id)->where('post_id', $post->id)->exists();

        if ($check_user_like) {
            Like::where('user_id', $user->id)->where('post_id', $post->id)->delete();
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id
            ]);
        }

        return back();
    }


    public function contact_view()
    {
        return view('contact');
    }

    public function contact_submit(Request $request)
    {
       $data =  $request->validate([
        'name' => "required|string",
        'email' => "required|string|email",
        'message' => "required|string"
       ]);

       $to = "dailyblog@blog.com";
       Mail::to($to)
        ->send(new ContactMail($data));
       
        return back()->with('success', "Mail has been sent");
    }
}
