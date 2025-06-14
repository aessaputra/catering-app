<x-app-layout>
    {{-- ================================================================= --}}
    {{-- Hero Section --}}
    {{-- ================================================================= --}}
    @php
        // Siapkan style background, gunakan gambar dari setting jika ada, jika tidak, gunakan warna gradien
        $heroStyle = setting('hero_image')
            ? 'background-image: url(' . Storage::url(setting('hero_image')) . ')'
            : 'background: linear-gradient(to right, #fde68a, #f59e0b);';
    @endphp
    <div class="relative bg-cover bg-center h-[500px]" style="{{ $heroStyle }}">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-center text-white p-4">
                {{-- Nama aplikasi dari setting --}}
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">Selamat Datang di
                    {{ setting('app_name', 'CateringApp') }}</h1>
                <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto">Menyediakan aneka hidangan lezat dan berkualitas
                    untuk segala acara Anda, dari rapat kantor hingga pesta pernikahan.</p>
                <a href="{{ route('menu') }}"
                    class="mt-8 inline-block bg-amber-500 text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-amber-600 transition-transform transform hover:scale-105 duration-300">
                    Lihat Menu Kami
                </a>
            </div>
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- Produk Unggulan Section --}}
    {{-- ================================================================= --}}
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Menu Unggulan Kami</h2>
                <p class="text-lg text-gray-500 mt-2">Cicipi hidangan favorit yang paling banyak dipesan oleh pelanggan
                    kami.</p>
            </div>
            @livewire('public.featured-products')
        </div>
    </section>

    {{-- ================================================================= --}}
    {{-- Tentang Kami Section --}}
    {{-- ================================================================= --}}
    <section class="py-16 sm:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    {{-- Judul menggunakan nama aplikasi dari setting --}}
                    <h2 class="text-3xl font-bold text-gray-800">Tentang {{ setting('app_name', 'CateringApp') }}</h2>
                    {{-- Teks diambil dari setting, nl2br untuk menjaga line break, e() untuk keamanan --}}
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        {!! nl2br(e(setting('about_us_text', 'Selamat datang! Kami adalah penyedia jasa katering terpercaya...'))) !!}
                    </p>
                </div>
                <div class="order-1 md:order-2">
                    {{-- Gambar diambil dari setting --}}
                    @if (setting('about_us_image'))
                        <img src="{{ Storage::url(setting('about_us_image')) }}" alt="Tentang Kami"
                            class="rounded-lg shadow-xl w-full h-auto">
                    @else
                        {{-- Placeholder jika gambar belum diupload --}}
                        <div class="w-full h-80 bg-gray-200 rounded-lg shadow-xl flex items-center justify-center">
                            <span class="text-gray-400">Gambar Belum Tersedia</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
