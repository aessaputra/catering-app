<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        @if (setting('app_logo'))
                            <img class="block h-10 w-auto" src="{{ Storage::url(setting('app_logo')) }}"
                                alt="{{ setting('app_name') }}">
                        @else
                            <span
                                class="text-xl font-bold text-amber-600">{{ setting('app_name', 'CateringApp') }}</span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <a href="{{ route('home') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">Beranda</a>
                <a href="{{ route('menu') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">Menu</a>
                {{-- Nanti di sini kita letakkan counter keranjang dari Livewire --}}
                @livewire('public.cart-counter')
            </div>
        </div>
    </div>
</nav>
