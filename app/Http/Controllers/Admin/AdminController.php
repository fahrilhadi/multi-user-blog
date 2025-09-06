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
}
