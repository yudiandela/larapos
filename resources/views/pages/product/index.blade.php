<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Produk') }}
            </h2>

            <x-button>Tambah Produk</x-button>
        </div>
    </x-slot>

    <x-alert :type="__('success')"></x-alert>

    <div class="py-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm">
                <div class="px-6 bg-white border-b border-gray-200">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="uppercase border-b-2 border-gray-200">
                                <th class="w-1/12 py-6 text-xs font-semibold tracking-wider">#</th>
                                <td class="w-2/12 py-6 text-xs font-semibold tracking-wider">Nama Produk</td>
                                <td class="w-4/12 py-6 text-xs font-semibold tracking-wider">Description</td>
                                <td class="w-2/12 py-6 text-xs font-semibold tracking-wider">Beli</td>
                                <td class="w-1/12 py-6 text-xs font-semibold tracking-wider">Jual</td>
                                <td class="w-2/12 py-6 text-xs font-semibold tracking-wider"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-sm bg-white border-b border-gray-200">
                                        <p class="text-center text-gray-900 whitespace-no-wrap">
                                            {{ $loop->iteration }}
                                        </p>
                                    </td>
                                    <td class="text-sm bg-white border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 hidden w-10 h-10 sm:table-cell">
                                                <img class="w-full h-full rounded-full" src="{{ $product->image }}" alt="" />
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $product->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm bg-white border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="mr-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ Str::of($product->description)->limit(50) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm bg-white border-b border-gray-200">
                                        Rp {{ number_format($product->buy, 2, ',', '.') }}
                                    </td>
                                    <td class="text-sm bg-white border-b border-gray-200">
                                        Rp {{ number_format($product->sell, 2, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                        <div class="flex justify-around">
                                            {{-- <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                                @csrf
                                                @method('delete')

                                                <a href="{{ route('product.destroy', $product->id) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                                    class="text-red-500 whitespace-no-wrap">
                                                    {{ __('Hapus') }}
                                                </a>
                                            </form> --}}
                                            <a href="#" class="text-red-500 whitespace-no-wrap">
                                                Hapus
                                            </a>
                                            <a href="#" class="text-green-600 whitespace-no-wrap">
                                                Ubah
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-3 mt-5 bg-white border-b border-gray-200">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
