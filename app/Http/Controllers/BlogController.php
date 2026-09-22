<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
{
    $selectedCategory = request('category');

    $posts = BlogPost::query()
        ->with('category')
        ->where('is_published', true)
        ->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        })
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            $query->whereHas('category', function ($categoryQuery) use ($selectedCategory) {
                $categoryQuery
                    ->where('slug', $selectedCategory)
                    ->where('is_active', true);
            });
        })
        ->latest('published_at')
        ->latest()
        ->get();

    $categories = BlogCategory::query()
        ->where('is_active', true)
        ->whereHas('posts', function ($query) {
            $query->where('is_published', true)
                ->where(function ($query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                });
        })
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    $currentCategory = null;

    if ($selectedCategory) {
        $currentCategory = $categories->firstWhere('slug', $selectedCategory);
    }

    return view('blog.index', compact(
        'posts',
        'categories',
        'currentCategory'
    ));
}

    public function show(string $slug)
{
    $post = BlogPost::query()
        ->with('category')
        ->where('slug', $slug)
        ->where('is_published', true)
        ->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        })
        ->firstOrFail();

    $relatedPosts = BlogPost::query()
        ->with('category')
        ->where('is_published', true)
        ->where('id', '!=', $post->id)
        ->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        })
        ->when($post->blog_category_id, function ($query) use ($post) {
            $query->where('blog_category_id', $post->blog_category_id);
        })
        ->latest('published_at')
        ->latest()
        ->take(3)
        ->get();

    return view('blog.show', compact(
        'post',
        'relatedPosts'
    ));
}
}