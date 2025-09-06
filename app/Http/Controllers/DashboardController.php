<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalPosts   = Post::where('user_id', $user->id)->count();
        $published    = Post::where('user_id', $user->id)->where('status', 'publish')->count();
        $drafts       = Post::where('user_id', $user->id)->where('status', 'draft')->count();

        $posts = Post::with(['category','tags'])
                    ->where('user_id', $user->id)
                    ->latest()
                    ->paginate(2);

        return view('posts.dashboard', compact('totalPosts', 'published', 'drafts', 'posts'));
    }
}
