<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if (!empty($cartItems))
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Daftar Item --}}
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6">Detail Keranjang</h2>
                @foreach ($cartItems as $item)
                    {{-- Ganti semua -> menjadi ['...'] untuk mengakses data array --}}
                    <div class="flex items-center border-b py-4" wire:key="{{ $item['rowId'] }}">
                        <img src="{{ Storage::url($item['options']['image']) }}" alt="{{ $item['name'] }}"
                            class="w-20 h-20 object-cover rounded-md mr-4">
                        <div class="flex-grow">
                            <p class="font-bold text-lg">{{ $item['name'] }}</p>
                            <p class="text-gray-600">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center">
                            <input type="number" min="1"
                                wire:change="updateCart('{{ $item['rowId'] }}', $event.target.value)"
                                value="{{ $item['qty'] }}"
                                class="w-16 text-center border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <button wire:click="removeFromCart('{{ $item['rowId'] }}')"
                                class="ml-4 text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Kolom Kanan: Ringkasan & Checkout --}}
            <div class="bg-white rounded-lg shadow-md p-6 h-fit">
                <h2 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h2>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-bold">Rp {{ $subtotal }}</span>
                </div>
                <div class="border-t pt-4 flex justify-between font-bold text-xl">
                    <span>Total</span>
                    <span>Rp {{ $total }}</span>
                </div>
                <div class="mt-8">
                    <button wire:click="processOrder" wire:loading.attr="disabled" wire:target="processOrder"
                        class="w-full bg-green-500 text-white font-bold py-3 rounded-lg hover:bg-green-600 transition-colors text-lg flex items-center justify-center disabled:opacity-75">
                        <i class="fab fa-whatsapp"></i> Pesan Sekarang via WhatsApp
                    </button>
                </div>
            </div>

        </div>
    @else
        <div class="text-center py-20 bg-white rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-gray-700">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 mt-2">Sepertinya Anda belum menambahkan menu apa pun.</p>
            <a href="{{ route('menu') }}"
                class="mt-6 inline-block bg-amber-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-amber-600 transition-colors">
                Kembali ke Menu
            </a>
        </div>
    @endif
</div>
