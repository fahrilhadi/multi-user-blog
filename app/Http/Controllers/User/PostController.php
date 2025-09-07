<?php

namespace App\Http\Controllers\User;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user','category','tags'])
                    ->where('status', 'publish')
                    ->latest()
                    ->paginate(2);

        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|array',
            'tags.*'   => 'nullable|string|max:50'
        ],[
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
            'category.required' => 'Category is required',
        ]);

        if (empty($request->title) && empty($request->content)) {
            return back()
                ->withErrors(['all' => 'Title, Content & Category are required'])
                ->withInput();
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Buat / Ambil kategori
        $category = Category::firstOrCreate(
            ['name' => $request->category],
        );

        // 3. Buat post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending', // agar di approve admin dulu
            'user_id' => Auth::id(),
            'category_id' => $category->id,
        ]);

        // 4. Tangani tags
        if ($request->filled('tags')) {
            $tagIds = [];

            foreach ($request->tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('dashboard')->with('success', 'Post created successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
