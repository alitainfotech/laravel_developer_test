<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-4 flex justify-between">
                        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('All Products') }}
                        </h4>
                        <a href="{{ Route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add New</a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($products) )
                                    @foreach ( $products as $product )
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $product->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @if ( $product->type === '0' )
                                                {{ __('B2C') }}
                                            @else
                                                {{ __('B2B') }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ "$" . $product->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ Route('products.show', $product->id) }}" class="font-medium text-green-600 pr-2 hover:underline">View</a>
                                            <a href="{{ Route('products.edit', $product->id) }}" class="font-medium text-blue-600 pr-2 hover:underline">Edit</a>
                                            <form action="{{ Route('products.destroy', $product->id) }}" method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 pr-2 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr class="bg-white border-b">
                                    <th colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap">
                                        {{ __('No Products Found')}}
                                    </th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
