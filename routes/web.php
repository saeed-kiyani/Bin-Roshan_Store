<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Models\Category;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogController;


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [AdminController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::get('/products', [ProductController::class, 'adminIndex'])
            ->name('products.index');

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');


        /*
        |--------------------------------------------------------------------------
        | Product Images
        |--------------------------------------------------------------------------
        */

        Route::delete('/products/images/{image}', [ProductController::class, 'destroyImage'])
            ->name('products.images.destroy');

        Route::put('/products/images/{image}/primary', [ProductController::class, 'setPrimaryImage'])
            ->name('products.images.primary');


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [CategoryController::class, 'adminIndex'])
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        /*
|--------------------------------------------------------------------------
| Admin Blog Categories
|--------------------------------------------------------------------------
*/

Route::get('/blog/categories', [BlogCategoryController::class, 'index'])
    ->name('blog.categories.index');

Route::get('/blog/categories/create', [BlogCategoryController::class, 'create'])
    ->name('blog.categories.create');

Route::post('/blog/categories', [BlogCategoryController::class, 'store'])
    ->name('blog.categories.store');

Route::get('/blog/categories/{blogCategory}/edit', [BlogCategoryController::class, 'edit'])
    ->name('blog.categories.edit');

Route::put('/blog/categories/{blogCategory}', [BlogCategoryController::class, 'update'])
    ->name('blog.categories.update');

Route::delete('/blog/categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])
    ->name('blog.categories.destroy');

    // Blog Posts
Route::get('/blog/posts', [BlogPostController::class, 'index'])
    ->name('blog.posts.index');

Route::get('/blog/posts/create', [BlogPostController::class, 'create'])
    ->name('blog.posts.create');

Route::post('/blog/posts', [BlogPostController::class, 'store'])
    ->name('blog.posts.store');

Route::get('/blog/posts/{blogPost}/edit', [BlogPostController::class, 'edit'])
    ->name('blog.posts.edit');

Route::put('/blog/posts/{blogPost}', [BlogPostController::class, 'update'])
    ->name('blog.posts.update');

Route::delete('/blog/posts/{blogPost}', [BlogPostController::class, 'destroy'])
    ->name('blog.posts.destroy');

    });


/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'home'])
    ->name('home');


Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');


Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories');


Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');


/*
|--------------------------------------------------------------------------
| About
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {

    $aboutCategories = Category::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    return view('about', compact('aboutCategories'));

})->name('about');



/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Test Route
|--------------------------------------------------------------------------
*/

Route::get('/test-home-route', function () {
    return route('home');
});

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{slug}', [BlogController::class, 'show'])
    ->name('blog.show');