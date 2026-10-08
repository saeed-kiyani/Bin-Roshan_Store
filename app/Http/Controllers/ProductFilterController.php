<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductFilter;
use App\Models\ProductFilterOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductFilterController extends Controller
{
    /**
     * Display all product filters grouped by category.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $filters = ProductFilter::with([
            'category',
            'options' => function ($query) {
                $query->orderBy('sort_order')
                    ->orderBy('label');
            },
        ])
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get()
        ->groupBy('category_id');

        return view('admin.product-filters.index', compact(
            'categories',
            'filters'
        ));
    }


    /**
     * Store a new filter.
     */
    public function storeFilter(Request $request)
    {
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

            'type' => [
                'required',
                Rule::in(['single', 'multiple']),
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
         * Generate slug from filter name.
         */
        $slug = Str::slug($validated['name']);

        /*
         * Make sure the slug is unique inside this category.
         */
        $exists = ProductFilter::where('category_id', $validated['category_id'])
            ->where('slug', $slug)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => 'A filter with this name already exists in the selected category.',
                ]);
        }

        ProductFilter::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'type' => $validated['type'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter created successfully.');
    }


    /**
     * Update an existing filter.
     */
    public function updateFilter(Request $request, ProductFilter $filter)
    {
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

            'type' => [
                'required',
                Rule::in(['single', 'multiple']),
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $slug = Str::slug($validated['name']);

        /*
         * Check duplicate filter slug inside the selected category.
         * Ignore the current filter.
         */
        $exists = ProductFilter::where('category_id', $validated['category_id'])
            ->where('slug', $slug)
            ->where('id', '!=', $filter->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => 'A filter with this name already exists in the selected category.',
                ]);
        }

        $filter->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'type' => $validated['type'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter updated successfully.');
    }


    /**
     * Delete a filter.
     */
    public function destroyFilter(ProductFilter $filter)
    {
        /*
         * Do not delete a filter if products are already using it.
         */
        if ($filter->values()->exists()) {
            return redirect()
                ->route('admin.product-filters.index')
                ->with(
                    'error',
                    'This filter is already being used by products. Please deactivate it instead of deleting it.'
                );
        }

        /*
         * No product is using this filter,
         * so its options can safely be removed.
         */
        $filter->options()->delete();

        $filter->delete();

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter deleted successfully.');
    }


    /**
     * Store a new option inside a filter.
     */
    public function storeOption(Request $request, ProductFilter $filter)
    {
        $validated = $request->validate([
            'value' => [
                'required',
                'string',
                'max:255',
            ],

            'label' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
         * Prevent duplicate option values inside the same filter.
         */
        $exists = $filter->options()
            ->where('value', $validated['value'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'value' => 'This option already exists in this filter.',
                ]);
        }

        $filter->options()->create([
            'value' => $validated['value'],
            'label' => $validated['label'] ?: $validated['value'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter option added successfully.');
    }


    /**
     * Update an existing option.
     */
    public function updateOption(Request $request, ProductFilterOption $option)
    {
        $validated = $request->validate([
            'value' => [
                'required',
                'string',
                'max:255',
            ],

            'label' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
         * Prevent duplicate option values inside the same filter.
         */
        $exists = ProductFilterOption::where(
                'product_filter_id',
                $option->product_filter_id
            )
            ->where('value', $validated['value'])
            ->where('id', '!=', $option->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'value' => 'This option already exists in this filter.',
                ]);
        }

        $option->update([
            'value' => $validated['value'],
            'label' => $validated['label'] ?: $validated['value'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter option updated successfully.');
    }


    /**
     * Delete an option.
     */
    public function destroyOption(ProductFilterOption $option)
    {
        /*
         * Do not delete an option already assigned to products.
         */
        if ($option->values()->exists()) {
            return redirect()
                ->route('admin.product-filters.index')
                ->with(
                    'error',
                    'This option is already being used by products. Please deactivate it instead of deleting it.'
                );
        }

        $option->delete();

        return redirect()
            ->route('admin.product-filters.index')
            ->with('success', 'Filter option deleted successfully.');
    }
}