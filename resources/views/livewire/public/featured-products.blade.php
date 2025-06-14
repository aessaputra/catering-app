<div class="grid grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-8">
    @forelse ($products as $product)
        <div
            class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
            <div class="p-4">
                <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                <h3 class="text-lg font-bold mt-1 text-gray-800">{{ $product->name }}</h3>
                <p class="text-blue-600 font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="mt-4">
                    <a href="{{ route('menu') }}"
                        class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-xl">Belum ada produk unggulan.</p>
        </div>
    @endforelse
</div>
