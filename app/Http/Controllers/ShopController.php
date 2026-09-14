<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SELECTED CATEGORY
        |--------------------------------------------------------------------------
        */
        $selectedCategory = null;

        if ($request->filled('category')) {
            $selectedCategory = $categories->firstWhere(
                'slug',
                $request->input('category')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY TYPE
        |--------------------------------------------------------------------------
        |
        | This keeps Clothing and Ladies Suit Laces filters separate.
        | The check uses both category name and slug, so it does not depend on
        | one exact slug such as "laces".
        |--------------------------------------------------------------------------
        */
        $categoryType = 'other';

        if ($selectedCategory) {
            $categoryText = strtolower(
                $selectedCategory->name . ' ' . $selectedCategory->slug
            );

            if (str_contains($categoryText, 'lace')) {
                $categoryType = 'lace';
            } elseif (
                str_contains($categoryText, 'clothing') ||
                str_contains($categoryText, 'apparel')
            ) {
                $categoryType = 'clothing';
            } elseif (str_contains($categoryText, 'cosmetic')) {
                $categoryType = 'cosmetics';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | BASE PRODUCTS QUERY
        |--------------------------------------------------------------------------
        */
        $products = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true);

        if ($selectedCategory) {
            $products->where('category_id', $selectedCategory->id);
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $products->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | PRICE FILTER
        |--------------------------------------------------------------------------
        |
        | The shop price is the sale price when available, otherwise regular price.
        |--------------------------------------------------------------------------
        */
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice !== null && $minPrice !== '' && is_numeric($minPrice)) {
            $products->whereRaw(
                'COALESCE(sale_price, price) >= ?',
                [(float) $minPrice]
            );
        }

        if ($maxPrice !== null && $maxPrice !== '' && is_numeric($maxPrice)) {
            $products->whereRaw(
                'COALESCE(sale_price, price) <= ?',
                [(float) $maxPrice]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CLOTHING FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'clothing') {
            $genders = $this->arrayInput($request->input('gender', []));
            $brands = $this->arrayInput($request->input('brand', []));
            $sizes = $this->arrayInput($request->input('sizes', []));

            if (!empty($genders)) {
                $products->whereIn('gender', $genders);
            }

            if (!empty($brands)) {
                $products->whereIn('brand', $brands);
            }

            if (!empty($sizes)) {
                $products->where(function ($query) use ($sizes) {
                    foreach ($sizes as $size) {
                        $query->orWhereJsonContains('sizes', $size);
                    }
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LACE FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'lace') {
            $laceCategory = $request->input('lace_category');

            $laceSubcategories = $this->arrayInput(
                $request->input('lace_subcategories', [])
            );

            $widths = $this->arrayInput(
                $request->input('width', [])
            );

            $heights = $this->arrayInput(
                $request->input('height', [])
            );

            $lengths = $this->arrayInput(
                $request->input('length', [])
            );

            if (!empty($laceCategory)) {
                $products->where('lace_category', $laceCategory);
            }

            if (!empty($laceSubcategories)) {
                $products->where(function ($query) use ($laceSubcategories) {
                    foreach ($laceSubcategories as $subcategory) {
                        $query->orWhereJsonContains(
                            'lace_subcategories',
                            $subcategory
                        );
                    }
                });
            }

            if (!empty($widths)) {
                $products->where(function ($query) use ($widths) {
                    foreach ($widths as $width) {
                        $query->orWhereJsonContains('width', $width);
                    }
                });
            }

            if (!empty($heights)) {
                $products->where(function ($query) use ($heights) {
                    foreach ($heights as $height) {
                        $query->orWhereJsonContains('height', $height);
                    }
                });
            }

            if (!empty($lengths)) {
                $products->where(function ($query) use ($lengths) {
                    foreach ($lengths as $length) {
                        $query->orWhereJsonContains('length', $length);
                    }
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | COSMETICS FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'cosmetics') {
            $cosmeticProductType = $request->input('cosmetic_product_type');
            $brands = $this->arrayInput($request->input('brand', []));
            $skinTypes = $this->arrayInput($request->input('skin_types', []));
            $concerns = $this->arrayInput($request->input('concerns', []));
            $productForms = $this->arrayInput($request->input('product_forms', []));

            if (!empty($cosmeticProductType)) {
                $products->where('cosmetic_product_type', $cosmeticProductType);
            }

            if (!empty($brands)) {
                $products->whereIn('brand', $brands);
            }

            if (!empty($skinTypes)) {
                $products->where(function ($query) use ($skinTypes) {
                    foreach ($skinTypes as $skinType) {
                        $query->orWhereJsonContains('skin_types', $skinType);
                    }
                });
            }

            if (!empty($concerns)) {
                $products->where(function ($query) use ($concerns) {
                    foreach ($concerns as $concern) {
                        $query->orWhereJsonContains('concerns', $concern);
                    }
                });
            }

            if (!empty($productForms)) {
                $products->where(function ($query) use ($productForms) {
                    foreach ($productForms as $productForm) {
                        $query->orWhereJsonContains('product_forms', $productForm);
                    }
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER OPTIONS
        |--------------------------------------------------------------------------
        |
        | These are collected from the selected category BEFORE the active
        | filters are applied, so options do not disappear after filtering.
        |--------------------------------------------------------------------------
        */
        $filterProducts = Product::query()
            ->where('is_active', true);

        if ($selectedCategory) {
            $filterProducts->where('category_id', $selectedCategory->id);
        }

        $filterProducts = $filterProducts->get([
            'gender',
            'brand',
            'sizes',
            'cosmetic_product_type',
            'skin_types',
            'concerns',
            'product_forms',
            'lace_subcategories',
            'width',
            'height',
            'length',
            'price',
            'sale_price',
        ]);

        $clothingBrands = collect();
        $cosmeticBrands = collect();
        $laceSubcategories = collect();
        $laceWidths = collect();
        $laceHeights = collect();
        $laceLengths = collect();

        if ($categoryType === 'clothing') {
            $clothingBrands = $filterProducts
                ->pluck('brand')
                ->filter(fn ($brand) => filled($brand))
                ->map(fn ($brand) => trim($brand))
                ->filter()
                ->unique()
                ->sort()
                ->values();
        }

        if ($categoryType === 'cosmetics') {
            $cosmeticBrands = $filterProducts
                ->pluck('brand')
                ->filter(fn ($brand) => filled($brand))
                ->map(fn ($brand) => trim($brand))
                ->filter()
                ->unique()
                ->sort()
                ->values();
        }

        if ($categoryType === 'lace') {
            $laceSubcategories = $filterProducts
                ->pluck('lace_subcategories')
                ->flatten()
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->sort()
                ->values();

            $laceWidths = $filterProducts
                ->pluck('width')
                ->flatten()
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->sortBy(fn ($value) => $this->dimensionSortValue($value))
                ->values();

            $laceHeights = $filterProducts
                ->pluck('height')
                ->flatten()
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->sortBy(fn ($value) => $this->dimensionSortValue($value))
                ->values();

            $laceLengths = $filterProducts
                ->pluck('length')
                ->flatten()
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->sortBy(fn ($value) => $this->dimensionSortValue($value))
                ->values();
        }

        /*
        |--------------------------------------------------------------------------
        | PRICE SLIDER RANGE
        |--------------------------------------------------------------------------
        |
        | Use the selected category's active products. This range is independent
        | of the currently selected filters so the slider remains stable.
        |--------------------------------------------------------------------------
        */
        $allPrices = $filterProducts
            ->map(fn ($product) => (float) (
                $product->sale_price ?? $product->price
            ))
            ->filter(fn ($price) => $price >= 0)
            ->values();

        if ($allPrices->isNotEmpty()) {
            $priceMin = (int) floor($allPrices->min());
            $priceMax = (int) ceil($allPrices->max());
        } else {
            $priceMin = 0;
            $priceMax = 100000;
        }

        // A range input needs a real range even if every product has the same price.
        if ($priceMax <= $priceMin) {
            $priceMax = $priceMin + 1;
        }

        $selectedMinPrice = is_numeric($minPrice)
            ? max($priceMin, min((float) $minPrice, $priceMax))
            : $priceMin;

        $selectedMaxPrice = is_numeric($maxPrice)
            ? max($priceMin, min((float) $maxPrice, $priceMax))
            : $priceMax;

        if ($selectedMinPrice > $selectedMaxPrice) {
            [$selectedMinPrice, $selectedMaxPrice] = [
                $selectedMaxPrice,
                $selectedMinPrice,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */
        switch ($request->input('sort')) {
            case 'featured':
                $products
                    ->orderByDesc('is_featured')
                    ->latest();
                break;

            case 'price_low':
                $products
                    ->orderByRaw('COALESCE(sale_price, price) ASC')
                    ->latest('id');
                break;

            case 'price_high':
                $products
                    ->orderByRaw('COALESCE(sale_price, price) DESC')
                    ->latest('id');
                break;

            case 'name':
                $products->orderBy('name', 'asc');
                break;

            default:
                $products->latest();
                break;
        }

        $products = $products->get();

        // AJAX filter requests return only the product results.
        // This prevents a full browser/page reload when filters change.
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.shop-product-results', [
                    'products' => $products,
                    'selectedCategory' => $selectedCategory,
                ])->render(),
                'count' => $products->count(),
            ]);
        }

        return view('shop', compact(
            'products',
            'categories',
            'selectedCategory',
            'categoryType',
            'clothingBrands',
            'cosmeticBrands',
            'laceSubcategories',
            'laceWidths',
            'laceHeights',
            'laceLengths',
            'priceMin',
            'priceMax',
            'selectedMinPrice',
            'selectedMaxPrice'
        ));
    }

    /**
     * Always return a clean array for checkbox query-string inputs.
     */
    private function arrayInput($value): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        return is_array($value)
            ? array_values(array_filter($value, fn ($item) => $item !== ''))
            : [$value];
    }

    /**
     * Natural-ish sorting for values such as 1 inch, 1.5 inch, 2 yards, etc.
     */
    private function dimensionSortValue(string $value): float
    {
        if (preg_match('/([0-9]+(?:\.[0-9]+)?)/', $value, $matches)) {
            return (float) $matches[1];
        }

        return PHP_FLOAT_MAX;
    }
}
