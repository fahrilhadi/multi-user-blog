@extends('master')

@section('title')
    Create Post | Multi User Blog App
@endsection

@push('addon-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main-content')
    <div class="w-full">
        <div class="max-w-2xl mx-auto px-4 py-10">

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                        class="@error('title') is-invalid @enderror w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-black text-sm"
                        placeholder="Enter post title">
                </div>

                {{-- Content --}}
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="6"
                            class="@error('content') is-invalid @enderror w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-black text-sm"
                            placeholder="Write your content here...">{{ old('content') }}</textarea>
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category"
                        class="w-full category-select">
                        <option value="">-- Select or type category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tags --}}
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <select name="tags[]" id="tags"
                        class="w-full tags-select" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->name }}" {{ collect(old('tags'))->contains($tag->name) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Category: single select + allow new input
            $('#category').select2({
                tags: true,
                placeholder: "Select or type a category",
                allowClear: true
            });

            // Tags: multiple select + allow new input
            $('#tags').select2({
                tags: true,
                placeholder: "Select or type tags",
            });
        });
    </script>
@endpush