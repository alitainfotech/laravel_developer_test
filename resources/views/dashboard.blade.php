<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @role(['b2b-customer', 'b2c-customer'])
                        <div>
                            <div class="px-4 sm:px-0">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">
                                    Purchase Details
                                </h3>
                            </div>
                            <div class="mt-6 border-t border-gray-100">
                                <dl class="divide-y divide-gray-100">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Order Id
                                        </dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $order->order_id }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Status
                                        </dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            @if ($order->status === '0')
                                                <div
                                                    class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full">
                                                    Successfull
                                                </div>
                                            @else
                                                <div
                                                    class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-red-200 text-red-700 rounded-full">
                                                    Cancled
                                                </div>
                                            @endif
                                        </dd>
                                    </div>
                                    @if ($order->status === '0')
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="text-sm font-medium leading-6 text-gray-900">
                                                Action
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                <a href="{{ Route('cancle.order', $order->id) }}"
                                                    class='inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                                                    Cancle
                                                </a>
                                            </dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    @elseif ('user')
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 pb-5">
                                All Users
                            </h3>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            User name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            User Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users))
                                        @foreach ($users as $user)
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $user->name }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    @if ($user->status === '0')
                                                        <div
                                                            class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full">
                                                            Active
                                                        </div>
                                                    @else
                                                        <div
                                                            class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-red-200 text-red-700 rounded-full">
                                                            Inactive
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if ($user->status === '0')
                                                        <a href="{{ Route('user.status', $user->id) }}"
                                                            class="font-medium text-red-600 pr-2 hover:underline">Deactivate</a>
                                                    @else
                                                        <a href="{{ Route('user.status', $user->id) }}"
                                                            class="font-medium text-green-600 pr-2 hover:underline">Activate</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="bg-white border-b">
                                            <th colspan="4" scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap">
                                                {{ __('No Users Found') }}
                                            </th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
