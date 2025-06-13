<x-app-layout>
    <div class="container mx-auto p-4 sm:p-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Menu Pilihan Kami</h1>
            <p class="text-lg text-gray-500 mt-2">Pilih menu favorit Anda dari berbagai kategori.</p>
        </div>

        {{-- Di sinilah keajaiban terjadi! Kita menyematkan komponen Livewire --}}
        @livewire('public.show-products')

    </div>
</x-app-layout>