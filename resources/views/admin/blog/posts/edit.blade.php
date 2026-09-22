@extends('layouts.admin')

@section('title', 'Edit Blog Post | Bin Roshan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('admin.blog.posts.index') }}"
               class="text-xs uppercase tracking-widest text-gray-500 hover:text-black transition">
                ← Back to Blog Posts
            </a>

            <p class="mt-8 text-xs uppercase tracking-[0.35em] text-[#BE8B3E] font-semibold">
                Admin Panel
            </p>

            <h1 class="mt-3 text-4xl font-light">
                Edit Blog Post
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Update your blog article and publishing settings.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50
                        px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blog.posts.update', $blogPost) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Main Content --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Post Content
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Update the main content of your article.
                    </p>
                </div>

                {{-- Title --}}
                <div class="mb-6">
                    <label for="title"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $blogPost->title) }}"
                           required
                           maxlength="255"
                           placeholder="Enter post title"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  text-gray-900 placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-black
                                  focus:border-transparent">

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="mb-6">
                    <label for="slug"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Slug
                    </label>

                    <input type="text"
                           id="slug"
                           name="slug"
                           value="{{ old('slug', $blogPost->slug) }}"
                           maxlength="255"
                           placeholder="my-blog-post"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  text-gray-900 placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-black
                                  focus:border-transparent">

                    <p class="mt-1 text-xs text-gray-500">
                        Keep this unique and SEO-friendly.
                    </p>

                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-6">
                    <label for="blog_category_id"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Category
                    </label>

                    <select id="blog_category_id"
                            name="blog_category_id"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   text-gray-900 bg-white
                                   focus:outline-none focus:ring-2 focus:ring-black
                                   focus:border-transparent">

                        <option value="">No Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('blog_category_id', $blogPost->blog_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('blog_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div class="mb-6">
                    <label for="excerpt"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Excerpt
                    </label>

                    <textarea id="excerpt"
                              name="excerpt"
                              rows="4"
                              placeholder="Short summary of the article..."
                              class="w-full rounded-lg border border-gray-300 px-4 py-3
                                     text-gray-900 placeholder-gray-400
                                     focus:outline-none focus:ring-2 focus:ring-black
                                     focus:border-transparent">{{ old('excerpt', $blogPost->excerpt) }}</textarea>

                    <p class="mt-1 text-xs text-gray-500">
                        Short description shown on the blog listing page.
                    </p>

                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div>
                    <label for="content"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>

                    <textarea id="content"
                              name="content"
                              rows="16"
                              required
                              placeholder="Write your article content here...">{{ old('content', $blogPost->content) }}</textarea>

                    <p class="mt-1 text-xs text-gray-500">
                        Use the editor to format headings, paragraphs, lists, links and other content.
                    </p>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Featured Image --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-gray-900">
                    Featured Image
                </h2>

                <p class="text-sm text-gray-500 mt-1 mb-5">
                    Replace the current featured image if needed.
                </p>

                @php
                    $image = $blogPost->featured_image;

                    if ($image && !str_starts_with($image, 'http')) {
                        $image = asset('storage/' . ltrim($image, '/'));
                    }
                @endphp

                {{-- Current Image --}}
                @if($image)
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Current Image
                        </p>

                        <img src="{{ $image }}"
                             alt="{{ $blogPost->title }}"
                             class="w-full max-w-md h-56 object-cover rounded-xl
                                    border border-gray-200">
                    </div>
                @endif

                <label for="featured_image"
                       class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ $image ? 'Replace Image' : 'Upload Image' }}
                </label>

                <input type="file"
                       id="featured_image"
                       name="featured_image"
                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-gray-600
                              file:mr-4 file:py-2.5 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-gray-100 file:text-gray-700
                              hover:file:bg-gray-200">

                <p class="mt-2 text-xs text-gray-500">
                    JPG, JPEG, PNG or WEBP. Maximum size: 4MB.
                </p>

                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Publishing --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-gray-900">
                    Publishing
                </h2>

                <p class="text-sm text-gray-500 mt-1 mb-6">
                    Choose whether this post should be visible on the public blog.
                </p>

                {{-- Publish Checkbox --}}
                <div class="flex items-start gap-3 mb-6">

                    <input type="hidden"
                           name="is_published"
                           value="0">

                    <input type="checkbox"
                           id="is_published"
                           name="is_published"
                           value="1"
                           {{ old('is_published', $blogPost->is_published) ? 'checked' : '' }}
                           class="mt-1 h-4 w-4 rounded border-gray-300
                                  text-black focus:ring-black">

                    <div>
                        <label for="is_published"
                               class="text-sm font-semibold text-gray-700 cursor-pointer">
                            Publish this post
                        </label>

                        <p class="text-xs text-gray-500 mt-1">
                            Uncheck this option to save the post as a draft.
                        </p>
                    </div>

                </div>

                {{-- Published At --}}
                <div>
                    <label for="published_at"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Published Date & Time
                    </label>

                    <input type="datetime-local"
                           id="published_at"
                           name="published_at"
                           value="{{ old(
                               'published_at',
                               $blogPost->published_at
                                   ? $blogPost->published_at->format('Y-m-d\TH:i')
                                   : ''
                           ) }}"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  text-gray-900
                                  focus:outline-none focus:ring-2 focus:ring-black
                                  focus:border-transparent">

                    <p class="mt-1 text-xs text-gray-500">
                        Leave empty to use the existing publication date or current date when publishing.
                    </p>

                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- SEO --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-gray-900">
                    SEO Settings
                </h2>

                <p class="text-sm text-gray-500 mt-1 mb-6">
                    Optional metadata for search engines.
                </p>

                {{-- Meta Title --}}
                <div class="mb-6">
                    <label for="meta_title"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Meta Title
                    </label>

                    <input type="text"
                           id="meta_title"
                           name="meta_title"
                           value="{{ old('meta_title', $blogPost->meta_title) }}"
                           maxlength="255"
                           placeholder="SEO title"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  text-gray-900 placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-black
                                  focus:border-transparent">

                    <p class="mt-1 text-xs text-gray-500">
                        Recommended: around 50–60 characters.
                    </p>

                    @error('meta_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meta Description --}}
                <div>
                    <label for="meta_description"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Meta Description
                    </label>

                    <textarea id="meta_description"
                              name="meta_description"
                              rows="3"
                              maxlength="500"
                              placeholder="Short description for search engines..."
                              class="w-full rounded-lg border border-gray-300 px-4 py-3
                                     text-gray-900 placeholder-gray-400
                                     focus:outline-none focus:ring-2 focus:ring-black
                                     focus:border-transparent">{{ old('meta_description', $blogPost->meta_description) }}</textarea>

                    <p class="mt-1 text-xs text-gray-500">
                        Recommended: around 150–160 characters.
                    </p>

                    @error('meta_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Form Actions --}}
            <div class="flex flex-col-reverse sm:flex-row sm:items-center
                        sm:justify-end gap-3">

                <a href="{{ route('admin.blog.posts.index') }}"
                   class="border border-gray-300 rounded-full px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-300 hover:text-white transition">
                    Cancel
                </a>

                <button type="submit"
                        class="bg-[#BE8B3E] rounded-full cursor-pointer border border-[#BE8B3E] hover:bg-transparent hover:text-[#BE8B3E] text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition">
                    Update Post
                </button>

            </div>

        </form>

    </div>
</div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('content');

            if (!textarea) {
                return;
            }

            const wrapper = document.createElement('div');

            wrapper.id = 'content-editor';
            wrapper.className = 'bg-white rounded-lg';

            textarea.parentNode.insertBefore(wrapper, textarea);
            textarea.style.display = 'none';

            const quill = new Quill('#content-editor', {
                theme: 'snow',
                placeholder: 'Write your article content here...',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ indent: '-1' }, { indent: '+1' }],
                        ['blockquote', 'code-block'],
                        ['link'],
                        [{ align: [] }],
                        ['clean']
                    ]
                }
            });

            const existingContent = @json(
                old('content', $blogPost->content ?? '')
            );

            if (existingContent) {
                quill.root.innerHTML = existingContent;
            }

            const form = textarea.closest('form');

            form.addEventListener('submit', function () {
                textarea.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush