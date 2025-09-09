@extends('master')

@section('title')
    Multi User Blog App
@endsection

@section('main-content')
    <div class="max-w-2xl mx-auto px-4 py-6">
        @if ($posts->isEmpty())
            <div class="p-8 border border-gray-200 rounded-xl shadow bg-white text-center">
                <h1 class="text-lg font-semibold text-gray-700 mb-2">
                    No posts available yet
                </h1>
                <p class="text-sm text-gray-500">
                    Please log in or register to add your first post.
                </p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <div class="p-6 border border-gray-200 rounded-xl shadow bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $post->title }}
                            </h2>
                        </div>

                        <p class="text-sm text-gray-500 mb-3">
                            By <span class="font-medium">{{ $post->user->name }}</span> 
                            in <span class="font-medium">{{ $post->category->name }}</span> · 
                            {{ $post->created_at->format('M d, Y') }}
                        </p>

                        <p class="text-gray-700 mb-3">
                            {{ Str::limit($post->content, 120) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>

                            <a href="{{ route('posts.show', $post->slug) }}" 
                            class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:border-black hover:bg-gray-50 transition">
                                Read More →
                            </a>
                        </div>
                    </div>
                @endforeach
                <x-pagination :paginator="$posts" />
            </div>
        @endif
    </div>
@endsection