<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalPosts   = Post::where('user_id', $user->id)->count();
        $published    = Post::where('user_id', $user->id)->where('status', 'publish')->count();
        $pendings       = Post::where('user_id', $user->id)->where('status', 'pending')->count();

        $posts = Post::with(['category','tags'])
                    ->where('user_id', $user->id)
                    ->latest()
                    ->paginate(1);

        return view('posts.dashboard', compact('totalPosts', 'published', 'pendings', 'posts'));
    }
}
