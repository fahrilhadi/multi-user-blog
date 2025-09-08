@extends('master')

@section('title')
    View Post | Multi User Blog App
@endsection

@section('main-content')
    <div class="w-full">
        <div class="max-w-2xl mx-auto px-4 py-10">
            
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
                
                {{-- Title + Status --}}
                <div class="mb-4">
                    <h1 class="text-lg font-bold text-gray-900 mb-2">
                        {{ $post->title }}
                    </h1>
                    @php
                        $statusColor = match($post->status) {
                            'publish' => 'bg-green-100 text-green-700 border-green-300',
                            'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
                            'rejected' => 'bg-red-100 text-red-700 border-red-300',
                            default => 'bg-gray-100 text-gray-700 border-gray-300'
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $statusColor }}">
                        {{ ucfirst($post->status) }}
                    </span>
                </div>

                {{-- Category --}}
                <div class="mb-6">
                    <span class="text-sm text-gray-500">Category:</span>
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-lg">
                        {{ $post->category->name ?? '-' }}
                    </span>
                </div>

                {{-- Content --}}
                <div class="mb-6 prose max-w-none">
                    {!! nl2br(e($post->content)) !!}
                </div>

                {{-- Tags --}}
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Tags:</span>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @forelse($post->tags as $tag)
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-lg text-xs">
                                {{ $tag->name }}
                            </span>
                        @empty
                            <span class="text-sm text-gray-500">No tags</span>
                        @endforelse
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <p>Published on: {{ $post->created_at->format('M d, Y') }}</p>
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                        Back to List
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection