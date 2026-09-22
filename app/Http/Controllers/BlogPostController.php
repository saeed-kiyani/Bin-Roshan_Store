<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::query()
            ->with('category')
            ->latest()
            ->get();

        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_category_id' => [
                'nullable',
                'integer',
                'exists:blog_categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],
            'excerpt' => [
                'nullable',
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'is_published' => [
                'nullable',
                'boolean',
            ],
            'published_at' => [
                'nullable',
                'date',
            ],
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']);

        if (BlogPost::where('slug', $slug)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'This slug is already in use.',
                ]);
        }

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')
                ->store('blog/posts', 'public');
        }

        $isPublished = $request->boolean('is_published');

        $publishedAt = $isPublished
            ? ($validated['published_at'] ?? now())
            : null;

        BlogPost::create([
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $imagePath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.blog.posts.edit', compact(
            'blogPost',
            'categories'
        ));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'blog_category_id' => [
                'nullable',
                'integer',
                'exists:blog_categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blog_posts', 'slug')
                    ->ignore($blogPost->id),
            ],
            'excerpt' => [
                'nullable',
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'is_published' => [
                'nullable',
                'boolean',
            ],
            'published_at' => [
                'nullable',
                'date',
            ],
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']);

        $slugExists = BlogPost::query()
            ->where('slug', $slug)
            ->where('id', '!=', $blogPost->id)
            ->exists();

        if ($slugExists) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'This slug is already in use.',
                ]);
        }

        $imagePath = $blogPost->featured_image;

        if ($request->hasFile('featured_image')) {

            if (
                $imagePath &&
                !str_starts_with($imagePath, 'http')
            ) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('featured_image')
                ->store('blog/posts', 'public');
        }

        $isPublished = $request->boolean('is_published');

        $publishedAt = $isPublished
            ? ($validated['published_at'] ?? $blogPost->published_at ?? now())
            : null;

        $blogPost->update([
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $imagePath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if (
            $blogPost->featured_image &&
            !str_starts_with($blogPost->featured_image, 'http')
        ) {
            Storage::disk('public')->delete(
                $blogPost->featured_image
            );
        }

        $blogPost->delete();

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}