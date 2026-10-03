@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="mb-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Subscribers
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage your newsletter subscribers.
            </p>
        </div>

        <div class="rounded-lg bg-gray-100 px-4 py-2">
            <span class="text-sm text-gray-500">
                Total:
            </span>

            <span class="font-semibold text-gray-900">
                {{ $subscribers->total() }}
            </span>
        </div>

    </div>


    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif


    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Subscribed
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($subscribers as $subscriber)

                        <tr class="hover:bg-gray-50">

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $subscriber->id }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $subscriber->email }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $subscriber->subscribed_at?->format('M d, Y h:i A') }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <form
                                    action="{{ route('admin.subscribers.destroy', $subscriber) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this subscriber?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-800"
                                    >
                                        Remove
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="4"
                                class="px-6 py-12 text-center text-sm text-gray-500"
                            >
                                No subscribers yet.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if ($subscribers->hasPages())

            <div class="border-t border-gray-200 px-6 py-4">
                {{ $subscribers->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
