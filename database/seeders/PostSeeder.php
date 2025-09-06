<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role','admin')->first();
        $user = User::where('role','user')->first();

        $post1 = Post::create([
            'user_id' => $admin->id,
            'category_id' => Category::where('slug','technology')->first()->id,
            'title' => 'Introduction to Laravel 12',
            'content' => 'Laravel 12 makes web development faster and easier...',
            'status' => 'publish'
        ]);
        $post1->tags()->attach([1,2]);

        $post2 = Post::create([
            'user_id' => $user->id,
            'category_id' => Category::where('slug','education')->first()->id,
            'title' => 'Learning PHP for Beginners',
            'content' => 'PHP is a great starting point for web development...',
            'status' => 'publish'
        ]);
        $post2->tags()->attach([2]);

        $post3 = Post::create([
            'user_id' => $admin->id,
            'category_id' => Category::where('slug','lifestyle')->first()->id,
            'title' => 'Balancing Coding and Daily Life',
            'content' => 'Being a developer means knowing how to manage time...',
            'status' => 'draft'
        ]);
        $post3->tags()->attach([3]);
    }
}
