<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            } elseif (
                str_contains($categoryText, 'jewelry') ||
                str_contains($categoryText, 'jewellery')
            ) {
                $categoryType = 'jewelry';
            } elseif (str_contains($categoryText, 'watch')) {
                $categoryType = 'watches';
            } elseif (
                str_contains($categoryText, 'other-accessories') ||
                str_contains($categoryText, 'other accessories')
            ) {
                $categoryType = 'other_accessories';
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
|
| Global product search.
| Searches product information, category information, brands and
| category-specific product fields.
|--------------------------------------------------------------------------
*/
if ($request->filled('search')) {
    $search = trim($request->input('search'));
    $searchTerm = '%' . $search . '%';

    $products->where(function ($query) use ($searchTerm, $search) {

        // Basic product information
        $query
            ->where('name', 'like', $searchTerm)
            ->orWhere('description', 'like', $searchTerm)
            ->orWhere('sku', 'like', $searchTerm)
            ->orWhere('brand', 'like', $searchTerm)
            ->orWhere('gender', 'like', $searchTerm)

            // Category name / slug
            ->orWhereHas('category', function ($categoryQuery) use ($searchTerm) {
                $categoryQuery
                    ->where('name', 'like', $searchTerm)
                    ->orWhere('slug', 'like', $searchTerm);
            })

            // Clothing
            ->orWhereJsonContains('sizes', $search)
            
            // Lace
            ->orWhere('lace_category', 'like', $searchTerm)
            ->orWhereJsonContains('lace_subcategories', $search)
            ->orWhereJsonContains('width', $search)
            ->orWhereJsonContains('height', $search)
            ->orWhereJsonContains('length', $search)

            // Cosmetics
            ->orWhere('cosmetic_product_type', 'like', $searchTerm)
            ->orWhereJsonContains('skin_types', $search)
            ->orWhereJsonContains('concerns', $search)
            ->orWhereJsonContains('product_forms', $search)

            // Jewelry
            ->orWhereJsonContains('jewelry_gender', $search)
            ->orWhere('jewelry_type', 'like', $searchTerm)
            ->orWhereJsonContains('jewelry_subcategories', $search)
            ->orWhereJsonContains('jewelry_quality', $search)
            ->orWhereJsonContains('ring_sizes', $search)
            ->orWhereJsonContains('necklace_lengths', $search)
            ->orWhereJsonContains('bracelet_sizes', $search)

            // Watches
            ->orWhereJsonContains('watch_gender', $search)
            ->orWhere('strap_material', 'like', $searchTerm)
            ->orWhere('watch_type', 'like', $searchTerm)

            // Other accessories
            ->orWhere('buttons', 'like', $searchTerm)
            ->orWhere('piping_clothes', 'like', $searchTerm)
            ->orWhere('accessory_type', 'like', $searchTerm);
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
        | JEWELRY FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'jewelry') {
            $jewelryGenders = $this->arrayInput($request->input('jewelry_gender', []));
            $jewelryType = $request->input('jewelry_type');
            $jewelrySubcategories = $this->arrayInput($request->input('jewelry_subcategories', []));
            $jewelryQuality = $this->arrayInput($request->input('jewelry_quality', []));
            $ringSizes = $this->arrayInput($request->input('ring_sizes', []));
            $necklaceLengths = $this->arrayInput($request->input('necklace_lengths', []));
            $braceletSizes = $this->arrayInput($request->input('bracelet_sizes', []));

            if (!empty($jewelryGenders)) {
                $products->where(function ($query) use ($jewelryGenders) {
                    foreach ($jewelryGenders as $gender) {
                        $query->orWhereJsonContains('jewelry_gender', $gender);
                    }
                });
            }

            if (!empty($jewelryType)) {
                $products->where('jewelry_type', $jewelryType);
            }

            if (!empty($jewelrySubcategories)) {
                $products->where(function ($query) use ($jewelrySubcategories) {
                    foreach ($jewelrySubcategories as $subcategory) {
                        $query->orWhereJsonContains('jewelry_subcategories', $subcategory);
                    }
                });
            }

            if (!empty($jewelryQuality)) {
                $products->where(function ($query) use ($jewelryQuality) {
                    foreach ($jewelryQuality as $quality) {
                        $query->orWhereJsonContains('jewelry_quality', $quality);
                    }
                });
            }

            if (!empty($ringSizes)) {
                $products->where(function ($query) use ($ringSizes) {
                    foreach ($ringSizes as $size) {
                        $query->orWhereJsonContains('ring_sizes', $size);
                    }
                });
            }

            if (!empty($necklaceLengths)) {
                $products->where(function ($query) use ($necklaceLengths) {
                    foreach ($necklaceLengths as $length) {
                        $query->orWhereJsonContains('necklace_lengths', $length);
                    }
                });
            }

            if (!empty($braceletSizes)) {
                $products->where(function ($query) use ($braceletSizes) {
                    foreach ($braceletSizes as $size) {
                        $query->orWhereJsonContains('bracelet_sizes', $size);
                    }
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | WATCH FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'watches') {
            $watchGenders = $this->arrayInput($request->input('watch_gender', []));
            $strapMaterial = $request->input('strap_material');
            $watchType = $request->input('watch_type');

            if (!empty($watchGenders)) {
                $products->where(function ($query) use ($watchGenders) {
                    foreach ($watchGenders as $gender) {
                        $query->orWhereJsonContains('watch_gender', $gender);
                    }
                });
            }

            if (!empty($strapMaterial)) {
                $products->where('strap_material', $strapMaterial);
            }

            if (!empty($watchType)) {
                $products->where('watch_type', $watchType);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OTHER ACCESSORIES FILTERS
        |--------------------------------------------------------------------------
        */
        if ($categoryType === 'other_accessories') {
            $buttons = $request->input('buttons');
            $pipingClothes = $request->input('piping_clothes');
            $accessoryType = $request->input('accessory_type');

            if (!empty($buttons)) {
                $products->where('buttons', $buttons);
            }

            if (!empty($pipingClothes)) {
                $products->where('piping_clothes', $pipingClothes);
            }

            if (!empty($accessoryType)) {
                $products->where('accessory_type', $accessoryType);
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
            'jewelry_gender',
            'jewelry_type',
            'jewelry_subcategories',
            'jewelry_quality',
            'ring_sizes',
            'necklace_lengths',
            'bracelet_sizes',
            'watch_gender',
            'strap_material',
            'watch_type',
            'buttons',
            'piping_clothes',
            'accessory_type',
            'price',
            'sale_price',
        ]);

        $clothingBrands = collect();
        $cosmeticBrands = collect();
        $laceSubcategories = collect();
        $laceWidths = collect();
        $laceHeights = collect();
        $laceLengths = collect();
        $jewelrySubcategories = collect();
        $jewelryQualities = collect();
        $jewelryRingSizes = collect();
        $jewelryNecklaceLengths = collect();
        $jewelryBraceletSizes = collect();
        $watchStrapMaterials = collect([
            'stainless_steel' => 'Stainless Steel',
            'leather' => 'Leather (Patty)',
            'silicone_rubber' => 'Silicone / Rubber',
        ]);
        $watchTypes = collect([
            'analog' => 'Analog',
            'digital' => 'Digital',
            'smartwatch' => 'Smartwatch',
            'chronograph' => 'Chronograph',
        ]);

        $otherAccessoryButtons = collect([
            'fancy_buttons' => 'Fancy Buttons',
            'simple_buttons' => 'Simple Buttons',
            'pearls_buttons' => 'Pearls Buttons',
            'pearls_clothes_buttons' => 'Pearls Clothes Buttons',
            'button_patti' => 'Button Patti',
        ]);

        $otherAccessoryPipingClothes = collect([
            'aparna_shamooz_silk_piping' => 'Aparna / Shamooz Silk Piping',
            'katan_silk_dori_piping' => 'Katan Silk / Dori Piping',
            'cotton_lawn_piping' => 'Cotton / Lawn Piping',
            'velvet_piping' => 'Velvet Piping',
            'metallic_zari_piping' => 'Metallic / Zari Piping',
        ]);

        $otherAccessoryTypes = collect([
            'tailor_accessories' => 'Tailor Accessories',
            'other_accessories' => 'Other Accessories',
        ]);

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

        if ($categoryType === 'jewelry') {
            $jewelrySubcategories = $filterProducts
                ->pluck('jewelry_subcategories')->flatten()
                ->filter(fn ($value) => filled($value))->map(fn ($value) => trim($value))
                ->filter()->unique()->sort()->values();

            $jewelryQualities = collect([
                'fine' => 'Fine Jewelry (Real Gold / Diamonds)',
                'demi_fine' => 'Demi-Fine (Gold-plated / Silver)',
                'fashion' => 'Fashion / Artificial Jewelry',
            ]);

            $jewelryRingSizes = $filterProducts
                ->pluck('ring_sizes')->flatten()
                ->filter(fn ($value) => filled($value))->map(fn ($value) => trim((string) $value))
                ->filter()->unique()->sortBy(fn ($value) => $this->dimensionSortValue($value))->values();

            $jewelryNecklaceLengths = $filterProducts
                ->pluck('necklace_lengths')->flatten()
                ->filter(fn ($value) => filled($value))->map(fn ($value) => trim($value))
                ->filter()->unique()->sortBy(fn ($value) => $this->dimensionSortValue($value))->values();

            $jewelryBraceletSizes = $filterProducts
                ->pluck('bracelet_sizes')->flatten()
                ->filter(fn ($value) => filled($value))->map(fn ($value) => trim($value))
                ->filter()->unique()->sortBy(fn ($value) => $this->dimensionSortValue($value))->values();
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

        $viewData = compact(
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
            'jewelrySubcategories',
            'jewelryQualities',
            'jewelryRingSizes',
            'jewelryNecklaceLengths',
            'jewelryBraceletSizes',
            'watchStrapMaterials',
            'watchTypes',
            'otherAccessoryButtons',
            'otherAccessoryPipingClothes',
            'otherAccessoryTypes',
            'priceMin',
            'priceMax',
            'selectedMinPrice',
            'selectedMaxPrice'
        );

        /*
        |--------------------------------------------------------------------------
        | AJAX FILTER RESPONSE
        |--------------------------------------------------------------------------
        |
        | Normal shop visits still return the complete page exactly as before.
        | AJAX filter requests return the rendered shop HTML as JSON so the
        | browser can replace only the product area without a full page reload.
        |--------------------------------------------------------------------------
        */
        if ($request->ajax()) {
            return response()->json([
                'html' => view('shop', $viewData)->render(),
                'count' => $products->count(),
            ]);
        }

        return view('shop', $viewData);
    }

    public function searchSuggestions(Request $request)
{
    $search = trim($request->input('search', ''));

    if ($search === '') {
        return response()->json([
            'products' => [],
        ]);
    }

    $searchTerm = '%' . $search . '%';

    $products = Product::query()
        ->with(['category', 'primaryImage'])
        ->where('is_active', true)

        ->where(function ($query) use ($searchTerm, $search) {

            $query
                // Product basic information
                ->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->orWhere('sku', 'like', $searchTerm)
                ->orWhere('brand', 'like', $searchTerm)
                ->orWhere('gender', 'like', $searchTerm)

                // Category
                ->orWhereHas('category', function ($categoryQuery) use ($searchTerm) {
                    $categoryQuery
                        ->where('name', 'like', $searchTerm)
                        ->orWhere('slug', 'like', $searchTerm);
                })

                // Clothing
                ->orWhereJsonContains('sizes', $search)

                // Lace
                ->orWhere('lace_category', 'like', $searchTerm)
                ->orWhereJsonContains('lace_subcategories', $search)
                ->orWhereJsonContains('width', $search)
                ->orWhereJsonContains('height', $search)
                ->orWhereJsonContains('length', $search)

                // Cosmetics
                ->orWhere('cosmetic_product_type', 'like', $searchTerm)
                ->orWhereJsonContains('skin_types', $search)
                ->orWhereJsonContains('concerns', $search)
                ->orWhereJsonContains('product_forms', $search)

                // Jewelry
                ->orWhereJsonContains('jewelry_gender', $search)
                ->orWhere('jewelry_type', 'like', $searchTerm)
                ->orWhereJsonContains('jewelry_subcategories', $search)
                ->orWhereJsonContains('jewelry_quality', $search)
                ->orWhereJsonContains('ring_sizes', $search)
                ->orWhereJsonContains('necklace_lengths', $search)
                ->orWhereJsonContains('bracelet_sizes', $search)

                // Watches
                ->orWhereJsonContains('watch_gender', $search)
                ->orWhere('strap_material', 'like', $searchTerm)
                ->orWhere('watch_type', 'like', $searchTerm)

                // Other accessories
                ->orWhere('buttons', 'like', $searchTerm)
                ->orWhere('piping_clothes', 'like', $searchTerm)
                ->orWhere('accessory_type', 'like', $searchTerm);
        })

        /*
        |--------------------------------------------------------------------------
        | SEARCH RELEVANCE
        |--------------------------------------------------------------------------
        |
        | Lower number = higher priority.
        |
        */

        // 1. Exact product name
        ->orderByRaw(
            'CASE WHEN LOWER(name) = LOWER(?) THEN 1 ELSE 9 END',
            [$search]
        )

        // 2. Product name starts with search
        ->orderByRaw(
            'CASE WHEN LOWER(name) LIKE LOWER(?) THEN 2 ELSE 9 END',
            [$search . '%']
        )

        // 3. Product name contains search
        ->orderByRaw(
            'CASE WHEN LOWER(name) LIKE LOWER(?) THEN 3 ELSE 9 END',
            [$searchTerm]
        )

        // 4. Category matches search
        ->orderByRaw(
            'CASE
                WHEN EXISTS (
                    SELECT 1
                    FROM categories
                    WHERE categories.id = products.category_id
                    AND (
                        LOWER(categories.name) LIKE LOWER(?)
                        OR LOWER(categories.slug) LIKE LOWER(?)
                    )
                )
                THEN 4
                ELSE 9
            END',
            [$searchTerm, $searchTerm]
        )

        // 5. Watch / Lace / Cosmetic / Jewelry / other attributes
        ->orderByRaw(
            'CASE
                WHEN LOWER(COALESCE(lace_category, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(cosmetic_product_type, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(jewelry_type, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(strap_material, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(watch_type, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(buttons, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(piping_clothes, \'\')) LIKE LOWER(?) THEN 5
                WHEN LOWER(COALESCE(accessory_type, \'\')) LIKE LOWER(?) THEN 5
                ELSE 9
            END',
            [
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
            ]
        )

        ->orderBy('name')
        ->limit(6)
        ->get();

    return response()->json([
        'products' => $products->map(function ($product) {

            $image = null;

            if (
                $product->primaryImage &&
                $product->primaryImage->image
            ) {
                $image = Storage::url(
                    $product->primaryImage->image
                );
            }

            $price = $product->sale_price ?? $product->price;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'image' => $image,
                'url' => route(
                    'product.show',
                    $product->slug
                ),
            ];

        })->values(),
    ]);
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
