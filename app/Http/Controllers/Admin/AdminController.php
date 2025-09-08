<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalPosts = Post::count();
        $pendingPosts = Post::where('status', 'pending')->count();
        $allPosts = Post::with(['user','category'])
                    ->latest()
                    ->paginate(1);

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'pendingPosts', 'allPosts'));
    }

    public function show(string $id)
    {
        $post = Post::with(['category', 'tags', 'user'])->findOrFail($id);

        return view('admin.show', compact('post'));
    }

    public function approvePost($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'publish';
        $post->save();

        return redirect()->route('admin.dashboard')->with('success', 'Post approved successfully');
    }

    public function rejectPost($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'rejected';
        $post->save();

        return redirect()->route('admin.dashboard')->with('success', 'Post rejected successfully');
    }
}
