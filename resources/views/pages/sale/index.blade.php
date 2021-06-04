<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kasir') }}
            </h2>

            {{-- <x-button>Tambah Produk</x-button> --}}
        </div>
    </x-slot>

    <x-alert :type="__('success')"></x-alert>

    <div class="py-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex gap-5 overflow-hidden shadow-sm">
                <div class="grid w-2/3 grid-cols-3 gap-2 p-6 bg-white">
                    @foreach ($products as $product)
                        <div class="w-full p-6 text-center border border-gray-200 shadow-xl rounded-3xl">
                            <div class="flex justify-center">
                                <img class="w-1/2" src="{{ $product->image }}" alt="{{ $product->name }}">
                            </div>
                            <div class="px-6 py-4">
                                <div class="mb-2 text-xl font-bold">{{ $product->name }}</div>
                                <p class="text-base text-gray-700">
                                    Rp. {{ number_format($product->sell, 0, ',', '.') }}
                                </p>
                            </div>

                            <form method="POST" action="{{ route('cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <x-button onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Add to Cart') }}
                                </x-button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="w-1/3 px-6 bg-white border-b border-gray-200">
                    <div class="w-full pt-6 pb-3 font-bold">
                        Cart
                    </div>

                    @php
                        $cartTotal = 0;
                    @endphp
                    <div class="w-full py-3">
                        @forelse ($carts as $cart)
                            <div class="flex justify-between w-full">
                                <span class="w-1/2">{{ $cart->product->name }}</span>
                                <span class="w-1/12">x</span>
                                <span class="w-1/12">{{ $cart->quantity }}</span>
                                <span class="flex justify-between w-1/3 text-right">
                                    <span>Rp.</span>
                                    <span>{{ number_format($cart->product->sell * $cart->quantity, 0, ',', '.') }}</span>
                                </span>
                            </div>
                            @php
                                $cartTotal += $cart->product->sell * $cart->quantity;
                            @endphp
                        @empty
                            <div class="w-full text-center">
                                Belum ada data
                            </div>
                        @endforelse
                    </div>

                    <div class="flex justify-between w-full py-3 font-bold border-t-2">
                        <span class="w-1/2">Total</span>
                        <span class="flex justify-between w-1/3 text-right">
                            <span>Rp.</span>
                            <span>{{ number_format($cartTotal, 0, ',', '.') }}</span>
                        </span>
                    </div>

                    <div class="flex justify-between w-full pt-6 pb-3 font-bold">
                        <form method="POST" action="{{ route('cart') }}">
                            @csrf
                            @method('delete')
                            <x-button onclick="event.preventDefault(); this.closest('form').submit();" class="bg-red-500">
                                Remove
                            </x-button>
                        </form>

                        <form method="POST" action="{{ route('cart') }}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="total" value="{{ $cartTotal }}">
                            <x-button onclick="event.preventDefault(); this.closest('form').submit();">
                                Checkout
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
