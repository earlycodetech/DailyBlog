<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->sortBy('title');
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|string|max:255|unique:posts",
            'category' => "required|numeric|exists:categories,id",
            'abstract' => "required|string|max:255",
            'content' => "required|string",
            'cover_image' => "required|image|file|mimes:png,jpg,jpeg|max:1028"
        ]);


        // Get the file
        $file = $request->file('cover_image');

        // Create a new name for the file
        $file_new_name = "post_cover_" . time() . "." . $file->extension();

        // Create a location where the file will be stored
        $file_location = public_path("uploads");

        // Move the file to a permanent location
        $file->move($file_location, $file_new_name);

        // Create a path to that file for the database
        $file_path = "uploads/" . $file_new_name;

        $slug = Str::slug($data['title']);


        Post::create([
            'category_id' => $data['category'],
            'title' => $data['title'],
            'slug' => $slug,
            'abstract' => $data['abstract'],
            'content' => $data['content'],
            'cover_image' => $file_path
        ]);

        return back()->with('success', "Post Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $categories =  Category::all()->sortBy('title');

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $old_cover_image = $post->cover_image;

        $data = $request->validate([
            'title' => "required|string|max:255|unique:posts,title,".$id,
            'category' => "required|numeric|exists:categories,id",
            'abstract' => "required|string|max:255",
            'content' => "required|string",
            'cover_image' => "nullable|image|file|mimes:png,jpg,jpeg|max:1028"
        ]);

        $slug = Str::slug($data['title']);


        if ($request->hasFile('cover_image')) {
            // Get the file
            $file = $request->file('cover_image');

            // Create a new name for the file
            $file_new_name = "post_cover_" . time() . "." . $file->extension();

            // Create a location where the file will be stored
            $file_location = public_path("uploads");

            // Move the file to a permanent location
            $file->move($file_location, $file_new_name);

            // Create a path to that file for the database
            $file_path = "uploads/" . $file_new_name;



            Post::where('id', $id)->update([
                'category_id' => $data['category'],
                'title' => $data['title'],
                'slug' => $slug,
                'abstract' => $data['abstract'],
                'content' => $data['content'],
                'cover_image' => $file_path
            ]);

        
            // DELETE OLD FILE
            $old_path = public_path($old_cover_image);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
        } else {

            Post::where('id', $id)->update([
                'category_id' => $data['category'],
                'title' => $data['title'],
                'slug' => $slug,
                'abstract' => $data['abstract'],
                'content' => $data['content'],
            ]);
        }


        return back()->with('success', "Post Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post =  Post::findOrFail($id);
        $cover_image = $post->cover_image;
        $path = public_path($cover_image);

        if ($post->delete()) {
            if (File::exists($path)) {
                File::delete($path);
            }

            return back()->with('success', "Post Deleted");
        }else {
            return back()->with('error', "Post failed to delete");
        }
    }
}
