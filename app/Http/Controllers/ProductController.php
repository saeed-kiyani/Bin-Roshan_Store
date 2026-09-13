<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND
    |--------------------------------------------------------------------------
    */

    public function home()
    {
        // Shop by Category
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Featured Collection
        $featuredProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        // New Arrivals
        $newArrivals = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'categories',
            'featuredProducts',
            'newArrivals'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | FRONTEND - PRODUCT DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($slug)
    {
        $product = Product::query()
            ->with([
                'category',
                'images',
                'primaryImage',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('product.show', compact('product'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - PRODUCT LIST
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $products = Product::query()
            ->with([
                'category',
                'primaryImage',
            ])
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY TYPE
    |--------------------------------------------------------------------------
    |
    | This decides which filtration group belongs to the selected category.
    |
    | lace     = Ladies Suit Laces / any category containing "lace"
    | clothing = Clothing / Apparel categories
    | other    = Cosmetics, Jewelry, Watches, Tailor Accessories, etc.
    |
    | Future category filters can be added here.
    |--------------------------------------------------------------------------
    */

    private function getCategoryType(Category $category): string
    {
        $categoryText = Str::lower(
            trim(
                ($category->slug ?? '') . ' ' . ($category->name ?? '')
            )
        );

        /*
        |--------------------------------------------------------------------------
        | LACE CATEGORY
        |--------------------------------------------------------------------------
        */

        if (
            Str::contains($categoryText, 'lace')
        ) {
            return 'lace';
        }


        /*
        |--------------------------------------------------------------------------
        | CLOTHING CATEGORY
        |--------------------------------------------------------------------------
        */

        if (
            Str::contains($categoryText, 'clothing') ||
            Str::contains($categoryText, 'apparel')
        ) {
            return 'clothing';
        }


        /*
        |--------------------------------------------------------------------------
        | OTHER CATEGORIES
        |--------------------------------------------------------------------------
        |
        | Cosmetics
        | Jewelry
        | Watches
        | Tailor Accessories
        | etc.
        |
        | These will be added later.
        |--------------------------------------------------------------------------
        */

        return 'other';
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTO GENERATE SLUG
        |--------------------------------------------------------------------------
        */

        if (!$request->filled('slug')) {
            $request->merge([
                'slug' => Str::slug($request->name),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,slug',
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku',
            ],


            /*
            |--------------------------------------------------------------------------
            | CLOTHING FILTERS
            |--------------------------------------------------------------------------
            */

            'gender' => [
                'nullable',
                'in:men,women,kids',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sizes' => [
                'nullable',
                'array',
            ],

            'sizes.*' => [
                'in:S,M,L',
            ],


            /*
            |--------------------------------------------------------------------------
            | LACE FILTERS
            |--------------------------------------------------------------------------
            */

            'lace_category' => [
                'nullable',
                'string',
                'in:basic_everyday,embroidered,fancy,traditional,suit_specific,premium_bridal',
            ],

            'lace_subcategories' => [
                'nullable',
                'array',
            ],

            'lace_subcategories.*' => [
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | LACE DIMENSIONS
            |--------------------------------------------------------------------------
            */

            'width' => [
                'nullable',
                'array',
            ],

            'width.*' => [
                'string',
                'max:100',
            ],

            'height' => [
                'nullable',
                'array',
            ],

            'height.*' => [
                'string',
                'max:100',
            ],

            'length' => [
                'nullable',
                'array',
            ],

            'length.*' => [
                'string',
                'max:100',
            ],


            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | IMAGES
            |--------------------------------------------------------------------------
            */

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET SELECTED CATEGORY
        |--------------------------------------------------------------------------
        */

        $category = Category::findOrFail(
            $validated['category_id']
        );


        /*
        |--------------------------------------------------------------------------
        | DETERMINE CATEGORY TYPE
        |--------------------------------------------------------------------------
        */

        $categoryType = $this->getCategoryType($category);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $validated['slug'] ?? Str::slug($validated['name']);


        if (Product::where('slug', $slug)->exists()) {

            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'This slug already exists. Please choose another one.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY-SPECIFIC FILTER DATA
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | Only the filtration belonging to the selected category is saved.
        |
        | Clothing:
        |   gender
        |   brand
        |   sizes
        |
        | Lace:
        |   lace_category
        |   lace_subcategories
        |   width
        |   height
        |   length
        |
        | Other:
        |   both groups are cleared
        |
        |--------------------------------------------------------------------------
        */

        $clothingGender = null;
        $clothingBrand = null;
        $clothingSizes = null;

        $laceCategory = null;
        $laceSubcategories = null;
        $laceWidth = null;
        $laceHeight = null;
        $laceLength = null;


        if ($categoryType === 'clothing') {

            $clothingGender = $validated['gender'] ?? null;

            $clothingBrand = $validated['brand'] ?? null;

            $clothingSizes = $validated['sizes'] ?? null;
        }


        if ($categoryType === 'lace') {

            $laceCategory = $validated['lace_category'] ?? null;

            $laceSubcategories = $validated['lace_subcategories'] ?? null;

            $laceWidth = $validated['width'] ?? null;

            $laceHeight = $validated['height'] ?? null;

            $laceLength = $validated['length'] ?? null;
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE PRODUCT
        |--------------------------------------------------------------------------
        */

        $product = Product::create([

            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' => $slug,

            'sku' => $validated['sku'],


            /*
            |--------------------------------------------------------------------------
            | CLOTHING FILTERS
            |--------------------------------------------------------------------------
            */

            'gender' => $clothingGender,

            'brand' => $clothingBrand,

            'sizes' => $clothingSizes,


            /*
            |--------------------------------------------------------------------------
            | LACE FILTERS
            |--------------------------------------------------------------------------
            */

            'lace_category' => $laceCategory,

            'lace_subcategories' => $laceSubcategories,

            'width' => $laceWidth,

            'height' => $laceHeight,

            'length' => $laceLength,


            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS
            |--------------------------------------------------------------------------
            */

            'description' => $validated['description'] ?? null,

            'price' => $validated['price'],

            'sale_price' => $validated['sale_price'] ?? null,

            'stock' => $validated['stock'],


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'is_featured' => $request->boolean('is_featured'),

            'is_active' => $request->boolean('is_active'),

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD IMAGES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                $imagePath = $image->store(
                    'products/' . $product->id,
                    'public'
                );

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $imagePath,

                    'is_primary' => $index === 0,

                    'sort_order' => $index,

                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $product->load([
            'category',
            'images',
            'primaryImage',
        ]);

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,slug,' . $product->id,
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku,' . $product->id,
            ],


            /*
            |--------------------------------------------------------------------------
            | CLOTHING FILTERS
            |--------------------------------------------------------------------------
            */

            'gender' => [
                'nullable',
                'in:men,women,kids',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sizes' => [
                'nullable',
                'array',
            ],

            'sizes.*' => [
                'in:S,M,L',
            ],


            /*
            |--------------------------------------------------------------------------
            | LACE FILTERS
            |--------------------------------------------------------------------------
            */

            'lace_category' => [
                'nullable',
                'string',
                'in:basic_everyday,embroidered,fancy,traditional,suit_specific,premium_bridal',
            ],

            'lace_subcategories' => [
                'nullable',
                'array',
            ],

            'lace_subcategories.*' => [
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | LACE DIMENSIONS
            |--------------------------------------------------------------------------
            */

            'width' => [
                'nullable',
                'array',
            ],

            'width.*' => [
                'string',
                'max:100',
            ],

            'height' => [
                'nullable',
                'array',
            ],

            'height.*' => [
                'string',
                'max:100',
            ],

            'length' => [
                'nullable',
                'array',
            ],

            'length.*' => [
                'string',
                'max:100',
            ],


            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | IMAGES
            |--------------------------------------------------------------------------
            */

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET SELECTED CATEGORY
        |--------------------------------------------------------------------------
        */

        $category = Category::findOrFail(
            $validated['category_id']
        );


        /*
        |--------------------------------------------------------------------------
        | DETERMINE CATEGORY TYPE
        |--------------------------------------------------------------------------
        */

        $categoryType = $this->getCategoryType($category);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $validated['slug'] ?? Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | CATEGORY-SPECIFIC FILTER DATA
        |--------------------------------------------------------------------------
        |
        | This is very important when an existing product changes category.
        |
        | Example:
        |
        | Old category:
        |     Ladies Suit Laces
        |
        | New category:
        |     Clothing
        |
        | Result:
        |     Lace data is cleared.
        |     Clothing data is saved.
        |
        |--------------------------------------------------------------------------
        */

        $clothingGender = null;
        $clothingBrand = null;
        $clothingSizes = null;

        $laceCategory = null;
        $laceSubcategories = null;
        $laceWidth = null;
        $laceHeight = null;
        $laceLength = null;


        if ($categoryType === 'clothing') {

            $clothingGender = $validated['gender'] ?? null;

            $clothingBrand = $validated['brand'] ?? null;

            $clothingSizes = $validated['sizes'] ?? null;
        }


        if ($categoryType === 'lace') {

            $laceCategory = $validated['lace_category'] ?? null;

            $laceSubcategories = $validated['lace_subcategories'] ?? null;

            $laceWidth = $validated['width'] ?? null;

            $laceHeight = $validated['height'] ?? null;

            $laceLength = $validated['length'] ?? null;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT
        |--------------------------------------------------------------------------
        */

        $product->update([

            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' => $slug,

            'sku' => $validated['sku'],


            /*
            |--------------------------------------------------------------------------
            | CLOTHING FILTERS
            |--------------------------------------------------------------------------
            */

            'gender' => $clothingGender,

            'brand' => $clothingBrand,

            'sizes' => $clothingSizes,


            /*
            |--------------------------------------------------------------------------
            | LACE FILTERS
            |--------------------------------------------------------------------------
            */

            'lace_category' => $laceCategory,

            'lace_subcategories' => $laceSubcategories,

            'width' => $laceWidth,

            'height' => $laceHeight,

            'length' => $laceLength,


            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS
            |--------------------------------------------------------------------------
            */

            'description' => $validated['description'] ?? null,

            'price' => $validated['price'],

            'sale_price' => $validated['sale_price'] ?? null,

            'stock' => $validated['stock'],


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'is_featured' => $request->boolean('is_featured'),

            'is_active' => $request->boolean('is_active'),

        ]);


        /*
        |--------------------------------------------------------------------------
        | ADD NEW IMAGES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            $currentImageCount = $product->images()->count();

            $hasPrimaryImage = $product->images()
                ->where('is_primary', true)
                ->exists();


            foreach ($request->file('images') as $index => $image) {

                $imagePath = $image->store(
                    'products/' . $product->id,
                    'public'
                );

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $imagePath,

                    'is_primary' => !$hasPrimaryImage && $index === 0,

                    'sort_order' => $currentImageCount + $index,

                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MAKE SURE A PRIMARY IMAGE EXISTS
        |--------------------------------------------------------------------------
        */

        $hasPrimaryImage = $product->images()
            ->where('is_primary', true)
            ->exists();


        if (!$hasPrimaryImage) {

            $firstImage = $product->images()
                ->orderBy('sort_order')
                ->first();

            if ($firstImage) {

                $firstImage->update([
                    'is_primary' => true,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete all product image files
        |--------------------------------------------------------------------------
        */

        foreach ($product->images as $image) {

            if (
                $image->image &&
                !Str::startsWith(
                    $image->image,
                    ['http://', 'https://']
                )
            ) {
                Storage::disk('public')->delete($image->image);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ProductImage records are deleted automatically
        | because product_images uses cascadeOnDelete()
        |--------------------------------------------------------------------------
        */

        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - SET PRIMARY IMAGE
    |--------------------------------------------------------------------------
    */

    public function setPrimaryImage(ProductImage $image)
    {
        $product = $image->product;


        /*
        |--------------------------------------------------------------------------
        | Remove primary flag from all images
        |--------------------------------------------------------------------------
        */

        $product->images()
            ->update([
                'is_primary' => false,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Set selected image as primary
        |--------------------------------------------------------------------------
        */

        $image->update([
            'is_primary' => true,
        ]);


        return back()
            ->with('success', 'Primary image updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE IMAGE
    |--------------------------------------------------------------------------
    */

    public function destroyImage(ProductImage $image)
    {
        $product = $image->product;

        $wasPrimary = $image->is_primary;


        /*
        |--------------------------------------------------------------------------
        | Delete physical file
        |--------------------------------------------------------------------------
        */

        if (
            $image->image &&
            !Str::startsWith(
                $image->image,
                ['http://', 'https://']
            )
        ) {
            Storage::disk('public')->delete($image->image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete database record
        |--------------------------------------------------------------------------
        */

        $image->delete();


        /*
        |--------------------------------------------------------------------------
        | If deleted image was primary,
        | make the first remaining image primary
        |--------------------------------------------------------------------------
        */

        if ($wasPrimary) {

            $newPrimary = $product->images()
                ->orderBy('sort_order')
                ->first();

            if ($newPrimary) {

                $newPrimary->update([
                    'is_primary' => true,
                ]);
            }
        }


        return back()
            ->with('success', 'Product image deleted successfully.');
    }
}