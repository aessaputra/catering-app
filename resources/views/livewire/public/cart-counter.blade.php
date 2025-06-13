<a href="{{ route('cart') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-white bg-green-500 hover:bg-green-600 relative">
    <i class="fas fa-shopping-cart"></i>
    Keranjang
    @if($cartTotal > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
            {{ $cartTotal }}
        </span>
    @endif
</a>