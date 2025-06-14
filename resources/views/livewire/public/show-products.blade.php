<div>
    {{-- Bagian Tombol Filter --}}
    <div class="mb-8 text-center">
        <button wire:click="filterByCategory(null)"
            class="px-4 py-2 mr-2 mb-2 text-sm font-medium rounded-lg
               {{ !$selectedCategoryId ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-700' }}
               hover:bg-amber-600 hover:text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
            Semua Kategori
        </button>

        @foreach ($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})"
                class="px-4 py-2 mr-2 mb-2 text-sm font-medium rounded-lg
               {{ $selectedCategoryId == $category->id ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-700' }}
               hover:bg-amber-600 hover:text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500">

                {{ $category->name }}
            </button>
        @endforeach
    </div>

    {{-- Bagian Grid Produk --}}
    {{-- Saat loading, grid akan sedikit transparan untuk feedback --}}
    <div wire:loading.class.delay="opacity-50"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse ($products as $product)
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <div class="p-4">
                    <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                    <h3 class="text-lg font-bold mt-1 text-gray-800">{{ $product->name }}</h3>
                    <p class="text-amber-600 font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="mt-4">
                        <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                            wire:target="addToCart({{ $product->id }})"
                            class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors flex items-center justify-center disabled:opacity-75">

                            {{-- Tampilkan spinner hanya saat tombol ini diklik --}}
                            <svg wire:loading wire:target="addToCart({{ $product->id }})"
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                            {{-- Tampilkan ikon jika tidak loading --}}
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})"><i
                                    class="fas fa-cart-plus"></i></span>
                            <span class="ml-2">Tambah ke Keranjang</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-xl">Produk tidak ditemukan dalam kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>
