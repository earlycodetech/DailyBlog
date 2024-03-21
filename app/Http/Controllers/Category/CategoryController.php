<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all();
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'title' => "required|string|unique:categories,title"
        ]);

        $slug = Str::slug($validatedData['title'], "-");



        Category::create([
            'title' => $validatedData['title'],
            'slug' =>  $slug
        ]);


        return back()->with('success', "Category Created Successfully");

        // return redirect('/categories');
        // return redirect()->route('categories.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $category = Category::find($id);
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        # Check if the record to be edited exists

        // $category = Category::where('slug', '=', $slug)->get();
        // $category = Category::where('slug', '=', $slug)->first();

        // if (!$category) {
        //     return back()->with('error', "This category does not exist");
        // }

        $category = Category::where('slug', '=', $slug)->firstOrFail();
        return view("categories.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'title' => "required|string|unique:categories,title," . $id
        ]);

        $slug = Str::slug($validatedData['title'], "-");



        Category::where('id', $id)->update([
            'title' => $validatedData['title'],
            'slug' =>  $slug
        ]);

        return redirect()
                ->route('categories.edit', ['category' => $slug])
                ->with('success', "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return back()->with('success', "Category has been deleted");
    }
}
