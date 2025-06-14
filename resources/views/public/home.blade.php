<x-app-layout>
    {{-- ================================================================= --}}
    {{-- Hero Section --}}
    {{-- ================================================================= --}}
    {{-- GANTI URL GAMBAR DENGAN GAMBAR ANDA SENDIRI (misal: dari Unsplash) --}}
    <div class="relative bg-cover bg-center h-[500px]"
        style="background-image: url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-center text-white p-4">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">Nikmati Momen Spesial dengan Hidangan
                    Istimewa</h1>
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
                    <h2 class="text-3xl font-bold text-gray-800">Tentang CateringApp</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        CateringApp lahir dari kecintaan kami terhadap seni kuliner dan keinginan untuk menyajikan
                        kebahagiaan di setiap piring. Selama lebih dari satu dekade, kami telah menjadi bagian dari
                        ribuan momen tak terlupakan, menyajikan hidangan yang tidak hanya lezat tetapi juga dibuat
                        dengan bahan-bahan segar pilihan dan standar kebersihan tertinggi. Tim kami terdiri dari chef
                        profesional dan staf yang berdedikasi untuk memberikan pelayanan terbaik bagi Anda.
                    </p>
                </div>
                <div class="order-1 md:order-2">
                    {{-- GANTI DENGAN URL GAMBAR ANDA --}}
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1981&auto=format&fit=crop"
                        alt="Tentang Kami" class="rounded-lg shadow-xl w-full h-auto">
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
