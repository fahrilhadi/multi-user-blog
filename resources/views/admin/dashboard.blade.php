@extends('master')

@section('title')
    Admin Dashboard | Multi User Blog App
@endsection

@section('main-content')
    <div class="max-w-2xl mx-auto px-4 py-10 space-y-5">

        {{-- Greeting --}}
        <div class="text-center">
            <h1 class="text-xl font-bold text-gray-900">
                Welcome back, {{ Auth::user()->name }} 🎉
            </h1>
            <p class="mt-1 text-sm text-gray-600">Here’s an overview of the platform activity.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Posts</h3>
                <p class="mt-2 text-2xl font-bold text-green-600">{{ $totalPosts }}</p>
            </div>
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Pending Posts</h3>
                <p class="mt-2 text-2xl font-bold text-yellow-600">{{ $pendingPosts }}</p>
            </div>
        </div>

        {{-- Table Pending Posts --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">All Posts</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed">
                    <thead>
                        <tr class="bg-gray-50 text-sm text-gray-600">
                            <th class="py-3 px-4 border-b w-full">Title</th>
                            <th class="py-3 px-4 border-b w-full">Author</th>
                            <th class="py-3 px-4 border-b w-full">Category</th>
                            <th class="py-3 px-4 border-b w-full">Status</th>
                            <th class="py-3 px-4 border-b w-full">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allPosts as $post)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ Str::limit($post->title, 10, '...') }}</td>
                                <td class="py-3 px-4 border-b">{{ $post->user->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $post->category->name ?? '-' }}</td>
                                <td class="py-3 px-4 border-b">
                                    @if ($post->status === 'publish')
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Publish</span>
                                    @elseif ($post->status === 'pending')
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-lg">Pending</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-lg">Rejected</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b">
                                    <a href="{{ url('/') }}" 
                                        class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                        View
                                    </a>
                                    {{-- <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
                                        @csrf
                                        <button class="px-2 py-1 rounded-lg border border-green-500 text-green-600 hover:bg-green-50 text-sm shadow">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 rounded-lg border border-red-500 text-red-600 hover:bg-red-50 text-sm shadow">
                                            Delete
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    No pending posts.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-pagination :paginator="$allPosts" />
        </div>

    </div>
@endsection