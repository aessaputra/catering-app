<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="text-center py-16 bg-white rounded-lg shadow-lg">
            <h1 class="text-5xl font-bold text-gray-800">Selamat Datang di CateringApp</h1>
            <p class="text-xl text-gray-600 mt-4">Solusi katering terbaik untuk setiap acara Anda.</p>
            <a href="{{ route('menu') }}" class="mt-8 inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-blue-700 transition-colors">
                Lihat Menu Kami
            </a>
        </div>
        {{-- Di sini Anda bisa menambahkan bagian "Tentang Kami", "Produk Unggulan", dll. --}}
    </div>
</x-app-layout>