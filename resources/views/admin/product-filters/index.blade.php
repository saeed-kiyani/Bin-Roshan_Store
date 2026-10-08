@extends('layouts.admin')

@section('content')

<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    {{-- ============================================================
         PAGE HEADER
    ============================================================ --}}
    <div class="mb-7">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

            <div>
                <p class="text-[11px] uppercase tracking-[0.28em] text-amber-600 font-medium mb-2">
                    Store Management
                </p>

                <h1 class="text-2xl sm:text-3xl font-light tracking-tight text-slate-900">
                    Product Filters
                </h1>

                <p class="mt-2 text-sm text-slate-500 max-w-2xl">
                    Manage dynamic product filters and their options by category.
                </p>
            </div>

            <div class="flex items-center gap-2">

                <span class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                             bg-white border border-slate-200 text-xs text-slate-500 shadow-sm">

                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                    Dynamic Filters
                </span>

            </div>

        </div>

    </div>


    {{-- ============================================================
         SUCCESS MESSAGE
    ============================================================ --}}
    @if(session('success'))

        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50
                    px-4 py-3 text-sm text-emerald-700">

            <div class="flex items-start gap-3">

                <svg class="w-5 h-5 mt-0.5 shrink-0"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                <div>
                    {{ session('success') }}
                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
         ERROR MESSAGE
    ============================================================ --}}
    @if(session('error'))

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50
                    px-4 py-3 text-sm text-red-700">

            <div class="flex items-start gap-3">

                <svg class="w-5 h-5 mt-0.5 shrink-0"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>

                </svg>

                <div>
                    {{ session('error') }}
                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
         VALIDATION ERRORS
    ============================================================ --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50
                    px-4 py-4 text-sm text-red-700">

            <div class="flex items-start gap-3">

                <svg class="w-5 h-5 mt-0.5 shrink-0"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v3.5M12 16h.01"/>

                </svg>

                <div>

                    <p class="font-medium mb-1">
                        Please fix the following:
                    </p>

                    <ul class="list-disc list-inside space-y-1 text-red-600">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
         ADD NEW FILTER
    ============================================================ --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">

        {{-- Card Header --}}
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/70">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-lg bg-amber-50 border border-amber-100
                            flex items-center justify-center text-amber-600">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M3 4h18M6 8h12M9 12h6M10 16h4M11 20h2"/>

                    </svg>

                </div>

                <div>
                    <h2 class="text-base font-medium text-slate-900">
                        Add New Filter
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Create a filter for any product category.
                    </p>
                </div>

            </div>

        </div>


        {{-- Form --}}
        <div class="p-5 sm:p-6">

            <form method="POST"
                  action="{{ route('admin.product-filters.store') }}">

                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-5">

                    {{-- Category --}}
                    <div class="lg:col-span-3">

                        <label for="new_filter_category"
                               class="block text-xs font-medium text-slate-700 mb-2">

                            Category

                        </label>

                        <select id="new_filter_category"
                                name="category_id"
                                required
                                class="w-full h-11 rounded-lg border border-slate-200
                                       bg-white px-3 text-sm text-slate-700
                                       outline-none transition
                                       focus:border-amber-500 focus:ring-2
                                       focus:ring-amber-100">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Filter Name --}}
                    <div class="lg:col-span-3">

                        <label for="new_filter_name"
                               class="block text-xs font-medium text-slate-700 mb-2">

                            Filter Name

                        </label>

                        <input type="text"
                               id="new_filter_name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Gender"
                               required
                               class="w-full h-11 rounded-lg border border-slate-200
                                      bg-white px-3 text-sm text-slate-700
                                      placeholder:text-slate-400
                                      outline-none transition
                                      focus:border-amber-500 focus:ring-2
                                      focus:ring-amber-100">

                    </div>


                    {{-- Selection Type --}}
                    <div class="sm:col-span-2 lg:col-span-2">

                        <label for="new_filter_type"
                               class="block text-xs font-medium text-slate-700 mb-2">

                            Selection Type

                        </label>

                        <select id="new_filter_type"
                                name="type"
                                required
                                class="w-full h-11 rounded-lg border border-slate-200
                                       bg-white px-3 text-sm text-slate-700
                                       outline-none transition
                                       focus:border-amber-500 focus:ring-2
                                       focus:ring-amber-100">

                            <option value="single"
                                @selected(old('type', 'single') === 'single')>

                                Single

                            </option>

                            <option value="multiple"
                                @selected(old('type') === 'multiple')>

                                Multiple

                            </option>

                        </select>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Single or multiple choices
                        </p>

                    </div>


                    {{-- Sort Order --}}
                    <div class="lg:col-span-2">

                        <label for="new_filter_sort"
                               class="block text-xs font-medium text-slate-700 mb-2">

                            Sort Order

                        </label>

                        <input type="number"
                               id="new_filter_sort"
                               name="sort_order"
                               value="{{ old('sort_order', 0) }}"
                               min="0"
                               class="w-full h-11 rounded-lg border border-slate-200
                                      bg-white px-3 text-sm text-slate-700
                                      outline-none transition
                                      focus:border-amber-500 focus:ring-2
                                      focus:ring-amber-100">

                    </div>


                    {{-- Active --}}
                    <div class="lg:col-span-1">

                        <label class="block text-xs font-medium text-slate-700 mb-2">
                            Status
                        </label>

                        <input type="hidden"
                               name="is_active"
                               value="0">

                        <label class="inline-flex items-center gap-2 h-11 cursor-pointer">

                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   class="w-4 h-4 rounded border-slate-300
                                          text-amber-600 focus:ring-amber-500"
                                   checked>

                            <span class="text-sm text-slate-600">
                                Active
                            </span>

                        </label>

                    </div>


                    {{-- Add Button --}}
                    <div class="sm:col-span-2 lg:col-span-1 flex items-end">

                        <button type="submit"
                                class="w-full h-11 inline-flex items-center
                                       justify-center gap-2 rounded-lg
                                       bg-slate-900 px-4 text-sm font-medium
                                       text-white transition
                                       hover:bg-amber-600
                                       focus:outline-none focus:ring-2
                                       focus:ring-amber-200">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4v16M4 12h16"/>

                            </svg>

                            Add

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ============================================================
         CATEGORY FILTERS
    ============================================================ --}}
    <div class="space-y-6">

        @foreach($categories as $category)

            @php
                $categoryFilters = $filters->get($category->id, collect());
            @endphp


            {{-- Category Card --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- Category Header --}}
                <div class="px-5 sm:px-6 py-4 bg-slate-50/70 border-b border-slate-100">

                    <div class="flex flex-col sm:flex-row sm:items-center
                                sm:justify-between gap-3">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200
                                        flex items-center justify-center text-amber-600">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M4 6h16M4 12h16M4 18h16"/>

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-lg font-medium text-slate-900">
                                    {{ $category->name }}
                                </h2>

                                <p class="text-xs text-slate-500 mt-0.5">
                                    Category filters
                                </p>

                            </div>

                        </div>


                        {{-- Filter Count --}}
                        <span class="inline-flex self-start sm:self-auto items-center
                                     rounded-full bg-white border border-slate-200
                                     px-3 py-1.5 text-xs font-medium text-slate-600">

                            {{ $categoryFilters->count() }}

                            {{ $categoryFilters->count() === 1 ? 'Filter' : 'Filters' }}

                        </span>

                    </div>

                </div>


                {{-- Category Body --}}
                <div class="p-5 sm:p-6">

                    @if($categoryFilters->isEmpty())

                        {{-- Empty State --}}
                        <div class="py-10 text-center">

                            <div class="mx-auto w-12 h-12 rounded-full bg-slate-50
                                        border border-slate-200 flex items-center
                                        justify-center text-slate-400 mb-3">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M3 5h18M6 10h12M9 15h6M11 20h2"/>

                                </svg>

                            </div>

                            <p class="text-sm font-medium text-slate-600">
                                No filters yet
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Add a filter above for this category.
                            </p>

                        </div>

                    @else

                        <div class="space-y-5">

                            @foreach($categoryFilters as $filter)

                                {{-- ====================================================
                                     FILTER CARD
                                ==================================================== --}}
                                <div class="border border-slate-200 rounded-xl overflow-hidden">


                                    {{-- Filter Header --}}
                                    <div class="p-4 sm:p-5 bg-white">

                                        <div class="flex flex-col xl:flex-row
                                                    xl:items-center gap-4">

                                            {{-- Filter Information --}}
                                            <div class="flex-1 min-w-0">

                                                <div class="flex flex-wrap items-center gap-2">

                                                    <h3 class="text-base font-medium text-slate-900">

                                                        {{ $filter->name }}

                                                    </h3>


                                                    {{-- Type Badge --}}
                                                    @if($filter->type === 'single')

                                                        <span class="inline-flex items-center
                                                                     rounded-full bg-blue-50
                                                                     border border-blue-100
                                                                     px-2.5 py-1
                                                                     text-[11px] font-medium
                                                                     text-blue-600">

                                                            Single

                                                        </span>

                                                    @else

                                                        <span class="inline-flex items-center
                                                                     rounded-full bg-purple-50
                                                                     border border-purple-100
                                                                     px-2.5 py-1
                                                                     text-[11px] font-medium
                                                                     text-purple-600">

                                                            Multiple

                                                        </span>

                                                    @endif


                                                    {{-- Active Badge --}}
                                                    @if($filter->is_active)

                                                        <span class="inline-flex items-center gap-1.5
                                                                     rounded-full bg-emerald-50
                                                                     border border-emerald-100
                                                                     px-2.5 py-1
                                                                     text-[11px] font-medium
                                                                     text-emerald-600">

                                                            <span class="w-1.5 h-1.5 rounded-full
                                                                         bg-emerald-500"></span>

                                                            Active

                                                        </span>

                                                    @else

                                                        <span class="inline-flex items-center gap-1.5
                                                                     rounded-full bg-slate-100
                                                                     border border-slate-200
                                                                     px-2.5 py-1
                                                                     text-[11px] font-medium
                                                                     text-slate-500">

                                                            <span class="w-1.5 h-1.5 rounded-full
                                                                         bg-slate-400"></span>

                                                            Inactive

                                                        </span>

                                                    @endif

                                                </div>


                                                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1
                                                            text-xs text-slate-400">

                                                    <span>
                                                        Slug:
                                                        <code class="text-slate-500">
                                                            {{ $filter->slug }}
                                                        </code>
                                                    </span>

                                                    <span>
                                                        Sort:
                                                        <strong class="font-medium text-slate-500">
                                                            {{ $filter->sort_order }}
                                                        </strong>
                                                    </span>

                                                    <span>
                                                        {{ $filter->options->count() }}
                                                        {{ $filter->options->count() === 1 ? 'Option' : 'Options' }}
                                                    </span>

                                                </div>

                                            </div>


                                            {{-- Update Filter --}}
                                            <div class="w-full xl:w-auto">

                                                <form method="POST"
                                                      action="{{ route('admin.product-filters.update', $filter) }}">

                                                    @csrf

                                                    @method('PUT')

                                                    <input type="hidden"
                                                           name="category_id"
                                                           value="{{ $filter->category_id }}">


                                                    <div class="grid grid-cols-1 sm:grid-cols-2
                                                                xl:flex items-end gap-2">

                                                        {{-- Name --}}
                                                        <div class="sm:col-span-2 xl:w-44">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1">

                                                                Name

                                                            </label>

                                                            <input type="text"
                                                                   name="name"
                                                                   value="{{ $filter->name }}"
                                                                   required
                                                                   class="w-full h-9 rounded-lg
                                                                          border border-slate-200
                                                                          bg-white px-3 text-xs
                                                                          text-slate-700
                                                                          outline-none
                                                                          focus:border-amber-500
                                                                          focus:ring-2
                                                                          focus:ring-amber-100">

                                                        </div>


                                                        {{-- Type --}}
                                                        <div class="xl:w-28">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1">

                                                                Type

                                                            </label>

                                                            <select name="type"
                                                                    class="w-full h-9 rounded-lg
                                                                           border border-slate-200
                                                                           bg-white px-2 text-xs
                                                                           text-slate-700
                                                                           outline-none
                                                                           focus:border-amber-500
                                                                           focus:ring-2
                                                                           focus:ring-amber-100">

                                                                <option value="single"
                                                                    @selected($filter->type === 'single')>

                                                                    Single

                                                                </option>

                                                                <option value="multiple"
                                                                    @selected($filter->type === 'multiple')>

                                                                    Multiple

                                                                </option>

                                                            </select>

                                                        </div>


                                                        {{-- Sort --}}
                                                        <div class="xl:w-20">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1">

                                                                Sort

                                                            </label>

                                                            <input type="number"
                                                                   name="sort_order"
                                                                   value="{{ $filter->sort_order }}"
                                                                   min="0"
                                                                   class="w-full h-9 rounded-lg
                                                                          border border-slate-200
                                                                          bg-white px-3 text-xs
                                                                          text-slate-700
                                                                          outline-none
                                                                          focus:border-amber-500
                                                                          focus:ring-2
                                                                          focus:ring-amber-100">

                                                        </div>


                                                        {{-- Active --}}
                                                        <div class="flex items-center h-9">

                                                            <input type="hidden"
                                                                   name="is_active"
                                                                   value="0">

                                                            <label class="inline-flex items-center gap-2
                                                                          cursor-pointer whitespace-nowrap">

                                                                <input type="checkbox"
                                                                       name="is_active"
                                                                       value="1"
                                                                       @checked($filter->is_active)
                                                                       class="w-4 h-4 rounded border-slate-300
                                                                              text-amber-600
                                                                              focus:ring-amber-500">

                                                                <span class="text-xs text-slate-600">
                                                                    Active
                                                                </span>

                                                            </label>

                                                        </div>


                                                        {{-- Save --}}
                                                        <button type="submit"
                                                                class="h-9 inline-flex items-center
                                                                       justify-center gap-1.5
                                                                       rounded-lg bg-slate-900
                                                                       px-4 text-xs font-medium
                                                                       text-white transition
                                                                       hover:bg-amber-600
                                                                       focus:outline-none
                                                                       focus:ring-2
                                                                       focus:ring-amber-200">

                                                            <svg class="w-3.5 h-3.5"
                                                                 fill="none"
                                                                 stroke="currentColor"
                                                                 viewBox="0 0 24 24">

                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M5 13l4 4L19 7"/>

                                                            </svg>

                                                            Save

                                                        </button>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>


                                        {{-- Delete Filter --}}
                                        <div class="mt-4 pt-4 border-t border-slate-100
                                                    flex justify-end">

                                            <form method="POST"
                                                  action="{{ route('admin.product-filters.destroy', $filter) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this filter?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5
                                                               text-xs font-medium text-red-500
                                                               hover:text-red-700 transition">

                                                    <svg class="w-3.5 h-3.5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h10"/>

                                                    </svg>

                                                    Delete Filter

                                                </button>

                                            </form>

                                        </div>

                                    </div>


                                    {{-- ====================================================
                                         OPTIONS SECTION
                                    ==================================================== --}}
                                    <div class="border-t border-slate-200 bg-slate-50/50">

                                        <div class="px-4 sm:px-5 py-4">

                                            {{-- Options Header --}}
                                            <div class="flex flex-col sm:flex-row
                                                        sm:items-center sm:justify-between
                                                        gap-3 mb-4">

                                                <div>

                                                    <div class="flex items-center gap-2">

                                                        <h4 class="text-sm font-medium text-slate-800">
                                                            Options
                                                        </h4>

                                                        <span class="inline-flex items-center
                                                                     rounded-full bg-white
                                                                     border border-slate-200
                                                                     px-2 py-0.5
                                                                     text-[10px] font-medium
                                                                     text-slate-500">

                                                            {{ $filter->options->count() }}

                                                        </span>

                                                    </div>

                                                    <p class="text-xs text-slate-400 mt-1">
                                                        Manage values available for this filter.
                                                    </p>

                                                </div>

                                            </div>


                                            {{-- Options List --}}
                                            @if($filter->options->isEmpty())

                                                <div class="rounded-xl border border-dashed
                                                            border-slate-300 bg-white
                                                            px-4 py-8 text-center mb-4">

                                                    <p class="text-sm text-slate-500">
                                                        No options added yet.
                                                    </p>

                                                    <p class="text-xs text-slate-400 mt-1">
                                                        Add the first option below.
                                                    </p>

                                                </div>

                                            @else

                                                <div class="space-y-3 mb-5">

                                                    @foreach($filter->options as $option)

                                                        <div class="bg-white border border-slate-200
                                                                    rounded-xl p-3 sm:p-4">

                                                            <form method="POST"
                                                                  action="{{ route('admin.product-filters.options.update', $option) }}">

                                                                @csrf

                                                                @method('PUT')


                                                                <div class="grid grid-cols-1 sm:grid-cols-2
                                                                            lg:grid-cols-12 gap-3
                                                                            items-end">

                                                                    {{-- Value --}}
                                                                    <div class="lg:col-span-4">

                                                                        <label class="block text-[10px]
                                                                                      uppercase tracking-wide
                                                                                      text-slate-400 mb-1.5">

                                                                            Value

                                                                        </label>

                                                                        <input type="text"
                                                                               name="value"
                                                                               value="{{ $option->value }}"
                                                                               required
                                                                               class="w-full h-9 rounded-lg
                                                                                      border border-slate-200
                                                                                      px-3 text-xs
                                                                                      text-slate-700
                                                                                      outline-none
                                                                                      focus:border-amber-500
                                                                                      focus:ring-2
                                                                                      focus:ring-amber-100">

                                                                    </div>


                                                                    {{-- Label --}}
                                                                    <div class="lg:col-span-4">

                                                                        <label class="block text-[10px]
                                                                                      uppercase tracking-wide
                                                                                      text-slate-400 mb-1.5">

                                                                            Label

                                                                        </label>

                                                                        <input type="text"
                                                                               name="label"
                                                                               value="{{ $option->label }}"
                                                                               class="w-full h-9 rounded-lg
                                                                                      border border-slate-200
                                                                                      px-3 text-xs
                                                                                      text-slate-700
                                                                                      outline-none
                                                                                      focus:border-amber-500
                                                                                      focus:ring-2
                                                                                      focus:ring-amber-100">

                                                                    </div>


                                                                    {{-- Sort --}}
                                                                    <div class="sm:w-full lg:col-span-1">

                                                                        <label class="block text-[10px]
                                                                                      uppercase tracking-wide
                                                                                      text-slate-400 mb-1.5">

                                                                            Sort

                                                                        </label>

                                                                        <input type="number"
                                                                               name="sort_order"
                                                                               value="{{ $option->sort_order }}"
                                                                               min="0"
                                                                               class="w-full h-9 rounded-lg
                                                                                      border border-slate-200
                                                                                      px-3 text-xs
                                                                                      text-slate-700
                                                                                      outline-none
                                                                                      focus:border-amber-500
                                                                                      focus:ring-2
                                                                                      focus:ring-amber-100">

                                                                    </div>


                                                                    {{-- Active --}}
                                                                    <div class="lg:col-span-2">

                                                                        <label class="block text-[10px]
                                                                                      uppercase tracking-wide
                                                                                      text-slate-400 mb-1.5">

                                                                            Status

                                                                        </label>

                                                                        <input type="hidden"
                                                                               name="is_active"
                                                                               value="0">

                                                                        <label class="inline-flex items-center
                                                                                      gap-2 h-9 cursor-pointer">

                                                                            <input type="checkbox"
                                                                                   name="is_active"
                                                                                   value="1"
                                                                                   @checked($option->is_active)
                                                                                   class="w-4 h-4 rounded
                                                                                          border-slate-300
                                                                                          text-amber-600
                                                                                          focus:ring-amber-500">

                                                                            <span class="text-xs text-slate-600">
                                                                                Active
                                                                            </span>

                                                                        </label>

                                                                    </div>


                                                                    {{-- Save --}}
                                                                    <div class="lg:col-span-1">

                                                                        <button type="submit"
                                                                                class="w-full h-9 inline-flex
                                                                                       items-center
                                                                                       justify-center
                                                                                       gap-1.5 rounded-lg
                                                                                       bg-slate-900
                                                                                       px-3 text-xs
                                                                                       font-medium
                                                                                       text-white
                                                                                       transition
                                                                                       hover:bg-amber-600
                                                                                       focus:outline-none
                                                                                       focus:ring-2
                                                                                       focus:ring-amber-200">

                                                                            <svg class="w-3.5 h-3.5"
                                                                                 fill="none"
                                                                                 stroke="currentColor"
                                                                                 viewBox="0 0 24 24">

                                                                                <path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      stroke-width="2"
                                                                                      d="M5 13l4 4L19 7"/>

                                                                            </svg>

                                                                            Save

                                                                        </button>

                                                                    </div>

                                                                </div>

                                                            </form>


                                                            {{-- Delete Option --}}
                                                            <div class="mt-3 pt-3 border-t
                                                                        border-slate-100
                                                                        flex justify-end">

                                                                <form method="POST"
                                                                      action="{{ route('admin.product-filters.options.destroy', $option) }}"
                                                                      onsubmit="return confirm('Are you sure you want to delete this option?');">

                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                            class="inline-flex items-center
                                                                                   gap-1.5 text-[11px]
                                                                                   font-medium text-red-500
                                                                                   hover:text-red-700
                                                                                   transition">

                                                                        <svg class="w-3.5 h-3.5"
                                                                             fill="none"
                                                                             stroke="currentColor"
                                                                             viewBox="0 0 24 24">

                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h10"/>

                                                                        </svg>

                                                                        Delete Option

                                                                    </button>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                            @endif


                                            {{-- ====================================================
                                                 ADD OPTION
                                            ==================================================== --}}
                                            <div class="rounded-xl border border-slate-200
                                                        bg-white p-4">

                                                <div class="flex items-center gap-2 mb-4">

                                                    <div class="w-7 h-7 rounded-lg bg-amber-50
                                                                flex items-center justify-center
                                                                text-amber-600">

                                                        <svg class="w-4 h-4"
                                                             fill="none"
                                                             stroke="currentColor"
                                                             viewBox="0 0 24 24">

                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 4v16M4 12h16"/>

                                                        </svg>

                                                    </div>

                                                    <div>

                                                        <h5 class="text-sm font-medium text-slate-800">
                                                            Add New Option
                                                        </h5>

                                                        <p class="text-[11px] text-slate-400">
                                                            New options are active by default.
                                                        </p>

                                                    </div>

                                                </div>


                                                <form method="POST"
                                                      action="{{ route('admin.product-filters.options.store', $filter) }}">

                                                    @csrf

                                                    <div class="grid grid-cols-1 sm:grid-cols-2
                                                                lg:grid-cols-12 gap-3">

                                                        {{-- Value --}}
                                                        <div class="lg:col-span-4">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1.5">

                                                                Value

                                                            </label>

                                                            <input type="text"
                                                                   name="value"
                                                                   placeholder="e.g. XL"
                                                                   required
                                                                   class="w-full h-10 rounded-lg
                                                                          border border-slate-200
                                                                          px-3 text-sm text-slate-700
                                                                          placeholder:text-slate-400
                                                                          outline-none
                                                                          focus:border-amber-500
                                                                          focus:ring-2
                                                                          focus:ring-amber-100">

                                                        </div>


                                                        {{-- Label --}}
                                                        <div class="lg:col-span-4">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1.5">

                                                                Label

                                                            </label>

                                                            <input type="text"
                                                                   name="label"
                                                                   placeholder="e.g. Extra Large"
                                                                   class="w-full h-10 rounded-lg
                                                                          border border-slate-200
                                                                          px-3 text-sm text-slate-700
                                                                          placeholder:text-slate-400
                                                                          outline-none
                                                                          focus:border-amber-500
                                                                          focus:ring-2
                                                                          focus:ring-amber-100">

                                                        </div>


                                                        {{-- Sort --}}
                                                        <div class="lg:col-span-2">

                                                            <label class="block text-[10px]
                                                                          uppercase tracking-wide
                                                                          text-slate-400 mb-1.5">

                                                                Sort Order

                                                            </label>

                                                            <input type="number"
                                                                   name="sort_order"
                                                                   value="0"
                                                                   min="0"
                                                                   class="w-full h-10 rounded-lg
                                                                          border border-slate-200
                                                                          px-3 text-sm text-slate-700
                                                                          outline-none
                                                                          focus:border-amber-500
                                                                          focus:ring-2
                                                                          focus:ring-amber-100">

                                                        </div>


                                                        {{-- Add Option --}}
                                                        <div class="sm:col-span-2 lg:col-span-2
                                                                    flex items-end">

                                                            <button type="submit"
                                                                    class="w-full h-10 inline-flex
                                                                           items-center
                                                                           justify-center gap-2
                                                                           rounded-lg
                                                                           bg-amber-600
                                                                           px-4 text-sm
                                                                           font-medium
                                                                           text-white
                                                                           transition
                                                                           hover:bg-amber-700
                                                                           focus:outline-none
                                                                           focus:ring-2
                                                                           focus:ring-amber-200">

                                                                <svg class="w-4 h-4"
                                                                     fill="none"
                                                                     stroke="currentColor"
                                                                     viewBox="0 0 24 24">

                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M12 4v16M4 12h16"/>

                                                                </svg>

                                                                Add Option

                                                            </button>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        @endforeach

    </div>


    {{-- ============================================================
         BOTTOM NOTE
    ============================================================ --}}
    <div class="mt-8 flex items-start gap-3 rounded-xl
                border border-amber-100 bg-amber-50/60 px-4 py-4">

        <svg class="w-5 h-5 text-amber-600 mt-0.5 shrink-0"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.8"
                  d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>

        </svg>

        <div>

            <p class="text-xs font-medium text-amber-800">
                Filter management
            </p>

            <p class="text-xs text-amber-700/80 mt-1 leading-relaxed">
                Filters and options that are already assigned to products should be
                deactivated instead of deleted.
            </p>

        </div>

    </div>

</div>

@endsection