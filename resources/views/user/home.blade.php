@extends('user.app')
@section('content')
<section class="bg-white">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        @if (count($products))
            @foreach ($products as $product)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img class="hover:grow hover:shadow-lg" src="{{ asset($product->image) }}">
                        <div class="pt-3 flex items-center justify-between">
                            <p>{{ $product->title }}</p>
                            <p>{{ "$" . $product->price }}</p>
                        </div>
                        <p class="pt-1 text-gray-900">
                            @if ($product->type === '0')
                                {{ __('B2B') }}
                            @else
                                {{ __('B2C') }}
                            @endif
                        </p>
                    </a>
                    <a class="text-lg text-left inline-block no-underline leading-relaxed hover:text-black hover:border-black"
                        href="{{ route('product.show', $product->id) }}">Buy</a>

                </div>
            @endforeach
        @else
            <p class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
                No Products Found
            </p>
        @endif
    </div>

</section>
@endsection

