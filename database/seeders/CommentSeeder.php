<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role','user')->first();

        Comment::create([
            'user_id' => $user->id,
            'post_id' => Post::where('title','Introduction to Laravel 12')->first()->id,
            'content' => 'Great introduction, very helpful!'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'post_id' => Post::where('title','Learning PHP for Beginners')->first()->id,
            'content' => 'Thanks! This is really easy to understand.'
        ]);
    }
}
