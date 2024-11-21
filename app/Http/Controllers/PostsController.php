<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostsController extends Controller
{
     public function index()
    {
        $categories = Category::all(); // Retrieve all categories
        $posts = Post::with('category')->paginate(10); // Include the category relationship
        return view('posts.index', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']), // Generate the slug from the title
            'description' => $validated['description'],
            'image' => $imagePath,
            'category_id' => $validated['category_id']
        ]);

        return redirect()->route('posts.index')->with('success', __('messages.post_added'));
    }

   public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image && Storage::exists('public/' . $post->image)) {
                Storage::delete('public/' . $post->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

         // Generate new slug based on updated title
        $validated['slug'] = Str::slug($validated['title'], '-');

        // Update the post with new data
        $post->update($validated);

        return redirect()->route('posts.index')->with('success', __('messages.post_updated'));
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', __('messages.post_deleted'));
    }

    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return response()->json($post);
    }
}


