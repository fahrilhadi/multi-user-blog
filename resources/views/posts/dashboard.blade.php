@extends('master')

@section('title')
    Dashboard | Multi User Blog App
@endsection

@section('main-content')
    <div class="max-w-2xl mx-auto px-4 py-10 space-y-5">

        {{-- Greeting --}}
        <div class="text-center">
            <h1 class="text-xl font-bold text-gray-900">
                Welcome, {{ Auth::user()->name }}
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
                <h3 class="text-sm font-medium text-gray-500">Published Posts</h3>
                <p class="mt-2 text-2xl font-bold text-green-600">{{ $published }}</p>
            </div>
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Pending Posts</h3>
                <p class="mt-2 text-2xl font-bold text-yellow-600">{{ $pendings }}</p>
            </div>
        </div>

        {{-- Table Posts --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">My Posts</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed">
                    <thead>
                        <tr class="bg-gray-50 text-sm text-gray-600">
                            <th class="py-3 px-4 border-b w-full">Title</th>
                            <th class="py-3 px-4 border-b w-full">Category</th>
                            <th class="py-3 px-4 border-b w-full">Status</th>
                            <th class="py-3 px-4 border-b w-full">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ Str::limit($post->title, 10, '...') }}</td>
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
                                <td class="px-4 py-3 border-b">
                                    <div class="flex items-center space-x-2">

                                        {{-- Pending: Edit & Delete --}}
                                        @if($post->status === 'pending')
                                            <a href="{{ route('posts.edit', $post) }}" 
                                            class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                                Edit
                                            </a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                <button type="button" onclick="openDeleteModal({{ $post->id }}, '{{ addslashes($post->title) }}')"
                                                        class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Approved/Publish: View --}}
                                        @if($post->status === 'approved' || $post->status === 'publish')
                                            <a href="{{ route('posts.show', $post) }}" 
                                            class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                                View
                                            </a>
                                        @endif

                                        {{-- Rejected: Delete --}}
                                        @if($post->status === 'rejected')
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                <button type="button" onclick="openDeleteModal({{ $post->id }}, '{{ addslashes($post->title) }}')"
                                                        class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    </div>
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
            <x-pagination :paginator="$posts" />
        </div>

    </div>

    <div id="deleteModal" class="fixed inset-0 backdrop-blur-sm z-[9999] hidden items-center justify-center">
      <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-center">
        <h2 class="text-lg font-semibold mb-2">Delete Post</h2>
        <p class="text-gray-600 text-sm mb-4">Are you sure you want to delete <span id="postTitle" class="font-medium"></span>?</p>
        <form id="deleteForm" method="POST" class="flex justify-center gap-3">
          @csrf
          @method('DELETE')
          <button type="button" onclick="closeDeleteModal()" 
                  class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:border-black transition shadow">
            Cancel
          </button>
          <button type="submit" 
                  class="px-4 py-2 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
            Delete
          </button>
        </form>
      </div>
    </div>
@endsection

@push('addon-script')
  <script>
    function openDeleteModal(postId, postTitle) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const titleSpan = document.getElementById('postTitle');

        form.action = '/posts/' + postId;
        titleSpan.textContent = postTitle;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
  </script>
@endpush