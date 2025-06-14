<footer class="bg-gray-100 py-12 border-t border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Bagian Logo dan Nama Website --}}
            <div>
                <a href="{{ route('home') }}" class="flex items-center text-xl font-bold text-amber-600">
                    @if (setting('app_logo'))
                        <img class="block h-8 w-auto mr-2" src="{{ Storage::url(setting('app_logo')) }}"
                            alt="{{ setting('app_name') }}">
                    @endif
                    {{ setting('app_name', 'CateringApp') }}
                </a>
                <p class="mt-2 text-gray-500 text-sm">
                    Menyajikan kelezatan untuk setiap acara Anda.
                </p>
                <div class="flex space-x-4 mt-4">
                    @if (setting('social_facebook'))
                        <a href="{{ setting('social_facebook') }}" target="_blank"
                            class="text-gray-500 hover:text-amber-500">
                            <i class="fab fa-facebook-square fa-lg"></i>
                        </a>
                    @endif
                    @if (setting('social_instagram'))
                        <a href="{{ setting('social_instagram') }}" target="_blank"
                            class="text-gray-500 hover:text-amber-500">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    @endif
                    @if (setting('social_tiktok'))
                        <a href="{{ setting('social_tiktok') }}" target="_blank"
                            class="text-gray-500 hover:text-amber-500">
                            <i class="fab fa-tiktok fa-lg"></i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Bagian Alamat --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Alamat Kami</h3>
                <address class="text-gray-600 text-sm not-italic">
                    {{-- nl2br(e(...)) untuk menjaga format baris baru dan keamanan --}}
                    {!! nl2br(e(setting('address', 'Alamat belum diatur.'))) !!}
                </address>
            </div>

            {{-- Bagian Kontak --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Hubungi Kami</h3>
                <p class="text-gray-600 text-sm">
                    <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                    <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank"
                        class="hover:text-amber-500">{{ setting('whatsapp_number', 'Nomor belum diatur') }}</a>
                </p>
            </div>

            {{-- Bagian Link Cepat --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Link Cepat</h3>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-500">Beranda</a></li>
                    <li><a href="{{ route('menu') }}" class="hover:text-amber-500">Menu</a></li>
                    <li><a href="{{ route('cart') }}" class="hover:text-amber-500">Keranjang</a></li>
                </ul>
            </div>
        </div>

        {{-- Google Maps Dinamis --}}
        @if (setting('maps_embed_url'))
            <div class="mt-8 border rounded-lg overflow-hidden shadow-md">
                <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade" src="{{ setting('maps_embed_url') }}">
                </iframe>
            </div>
        @endif

        {{-- Copyright --}}
        <div class="mt-8 pt-8 border-t text-center text-gray-500 text-sm">
            © {{ date('Y') }} {{ setting('app_name', 'CateringApp') }}. All rights reserved.
        </div>
    </div>
</footer>
