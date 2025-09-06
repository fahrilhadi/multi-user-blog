@extends('master')

@section('title')
    Dashboard | Multi User Blog App
@endsection

@section('main-content')
<div class="max-w-2xl mx-auto px-4 py-10 space-y-5">

    {{-- Greeting --}}
    <div class="text-center">
        <h1 class="text-xl font-bold text-gray-900">
            Welcome, {{ Auth::user()->name }} 🎉
        </h1>
        <p class="mt-1 text-sm text-gray-600">Here’s a quick overview of your activity.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h3 class="text-sm font-medium text-gray-500">Total Posts</h3>
            <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalPosts }}</p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h3 class="text-sm font-medium text-gray-500">Published</h3>
            <p class="mt-2 text-2xl font-bold text-green-600">{{ $published }}</p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h3 class="text-sm font-medium text-gray-500">Drafts</h3>
            <p class="mt-2 text-2xl font-bold text-yellow-600">{{ $drafts }}</p>
        </div>
    </div>

    {{-- Table Posts --}}
    <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">My Posts</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-sm text-gray-600">
                        <th class="py-3 px-4 border-b">Title</th>
                        <th class="py-3 px-4 border-b">Category</th>
                        <th class="py-3 px-4 border-b">Status</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="text-sm text-gray-700 hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $post->title }}</td>
                            <td class="py-3 px-4 border-b">{{ $post->category->name ?? '-' }}</td>
                            <td class="py-3 px-4 border-b">
                                @if ($post->status === 'publish')
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Publish</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b flex space-x-2">
                                <a href="{{ route('posts.edit', $post->id) }}" 
                                   class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">
                                No posts yet. <a href="{{ route('posts.create') }}" class="text-black underline">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

</div>
@endsection