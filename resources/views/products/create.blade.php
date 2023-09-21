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
                    {{-- Start product form --}}
                    <div>
                        <div class="bg-white rounded p-4 px-4 md:p-8 mb-6">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-800">
                                    <p class="font-medium text-lg">Enter Product Details</p>
                                    <p>Please fill out all the fields.</p>
                                </div>

                                <div class="lg:col-span-2">
                                    <form action="{{ Route('products.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                            <div class="col-span-full">
                                                <label for="product_name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">
                                                    Product Name
                                                </label>
                                                <input type="text" name="product_name" id="product_name"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                                                    placeholder="Enter Product Name" required />
                                                @error('product_name')
                                                    <p class="text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="lg:col-span-3">
                                                <label for="product_price"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Product
                                                    Price</label>
                                                <input type="text" name="product_price" id="product_price"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                                                    placeholder="Enter product Price" required />
                                                @error('product_price')
                                                    <p class="text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="lg:col-span-2">
                                                <label for="product_type"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Product
                                                    type</label>
                                                <div>
                                                    <select id="product_type" name="product_type"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600" required>
                                                        <option class="text-gray-500" selected disabled>
                                                            Select product type
                                                        </option>
                                                        <option value="0">B2B</option>
                                                        <option value="1">B2C</option>
                                                    </select>
                                                </div>
                                                @error('product_type')
                                                    <p class="text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-span-full">
                                                <label for="product_name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">
                                                    Product Description
                                                </label>
                                                <textarea name="product_description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600" id="product_description" placeholder="Your message"></textarea>

                                                @error('product_type')
                                                    <p class="text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-span-full">
                                                <label for="cover-photo"
                                                    class="block text-sm font-medium leading-6 text-gray-900">
                                                    Upload Product Image
                                                </label>
                                                <div
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600" >
                                                    <div class="text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="mt-4index text-sm leading-6 text-gray-600">
                                                            <label for="image"
                                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                                <span>Upload a file</span>
                                                                <input id="image" name="image" type="file"
                                                                    class="sr-only" required>
                                                            </label>
                                                        </div>
                                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to
                                                            10MB
                                                        </p>
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <p class="text-red-400">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="inline-flex items-end pt-3">
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End product form --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
