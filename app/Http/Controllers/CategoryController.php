<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('categories', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = $category->products()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('category', compact(
            'category',
            'products'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $categories = Category::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $validated['slug'] ?? Str::slug($validated['name']);

        if (Category::where('slug', $slug)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'This slug already exists. Please choose another one.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('categories', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE CATEGORY
        |--------------------------------------------------------------------------
        */

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $validated['slug'] ?? Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        $imagePath = $category->image;

        if ($request->hasFile('image')) {

            /*
            | Delete old local image
            */

            if (
                $category->image &&
                !Str::startsWith($category->image, ['http://', 'https://'])
            ) {
                Storage::disk('public')->delete($category->image);
            }


            /*
            | Store new image
            */

            $imagePath = $request->file('image')
                ->store('categories', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        /*
        |--------------------------------------------------------------------------
        | DELETE IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            $category->image &&
            !Str::startsWith($category->image, ['http://', 'https://'])
        ) {
            Storage::disk('public')->delete($category->image);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE CATEGORY
        |--------------------------------------------------------------------------
        */

        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}