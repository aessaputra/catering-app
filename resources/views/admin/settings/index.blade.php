@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulir Pengaturan Website</h3>
        </div>
        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                {{-- Nama Website --}}
                <div class="form-group">
                    <label for="app_name">Nama Website</label>
                    {{-- Gunakan $settings['app_name'] ?? '' untuk mengisi value jika ada, atau string kosong jika tidak ada --}}
                    <input type="text" name="app_name" class="form-control" id="app_name"
                        value="{{ $settings['app_name'] ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="whatsapp_number">Nomor WhatsApp Admin</label>
                    <input type="text" name="whatsapp_number" class="form-control" id="whatsapp_number"
                        value="{{ $settings['whatsapp_number'] ?? '' }}" required>
                    <small class="form-text text-muted">Gunakan format internasional tanpa tanda '+' atau '0' di
                        depan.</small>
                </div>

                {{-- Tentang Kami --}}
                <div class="form-group">
                    <label for="about_us_text">Teks "Tentang Kami"</label>
                    <textarea name="about_us_text" id="about_us_text" class="form-control" rows="6" required>{{ $settings['about_us_text'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="about_us_image">Gambar "Tentang Kami"</label>
                    <input type="file" name="about_us_image" class="form-control-file" id="about_us_image">
                    <small class="form-text text-muted">
                        <strong>Rekomendasi:</strong> Ukuran gambar sekitar <strong>1200x800 pixels</strong>. Optimalkan
                        ukuran file (di bawah <strong>200 KB</strong>) sebelum di-upload menggunakan tools seperti <a
                            href="https://tinypng.com/" target="_blank">TinyPNG</a> atau <a href="https://squoosh.app/"
                            target="_blank">Squoosh.app</a> untuk menjaga kecepatan website.
                    </small>
                    @if (isset($settings['about_us_image']))
                        <div class="mt-2">
                            <p>Gambar Saat Ini:</p>
                            <img src="{{ Storage::url($settings['about_us_image']) }}" alt="Tentang Kami Saat Ini"
                                style="max-width: 300px; border-radius: 5px;">
                        </div>
                    @endif
                </div>

                <hr>

                {{-- Logo Website --}}
                <div class="form-group">
                    <label for="app_logo">Logo Website (Disarankan format .png transparan)</label>
                    <input type="file" name="app_logo" class="form-control-file" id="app_logo">
                    @if (isset($settings['app_logo']))
                        <div class="mt-2">
                            <p>Logo Saat Ini:</p>
                            <img src="{{ Storage::url($settings['app_logo']) }}" alt="Logo Saat Ini"
                                style="max-height: 80px; background: #f0f0f0; padding: 5px; border-radius: 5px;">
                        </div>
                    @endif
                </div>

                <hr>

                {{-- Gambar Hero Section --}}
                <div class="form-group">
                    <label for="hero_image">Gambar Hero Section (Halaman Depan)</label>
                    <input type="file" name="hero_image" class="form-control-file" id="hero_image">
                    @if (isset($settings['hero_image']))
                        <div class="mt-2">
                            <p>Gambar Saat Ini:</p>
                            <img src="{{ Storage::url($settings['hero_image']) }}" alt="Hero Saat Ini"
                                style="max-width: 300px; border-radius: 5px;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
