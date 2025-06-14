<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:is-admin');
    }

    /**
     * Menampilkan halaman form pengaturan.
     */
    public function index()
    {
        // Ambil semua settings dan ubah menjadi format ['key' => 'value'] agar mudah diakses di view
        $settings = Setting::all()->pluck('value', 'key');
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Menyimpan data pengaturan.
     */
    public function store(Request $request)
    {
        // Validasi input teks
        $validatedData = $request->validate([
            'app_name' => 'required|string|max:255',
            'about_us_text' => 'required|string',
            'whatsapp_number' => 'required|string|numeric',
        ]);

        // Simpan data teks menggunakan updateOrCreate
        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle upload file untuk logo
        if ($request->hasFile('app_logo')) {
            $request->validate(['app_logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048']);
            // Hapus logo lama jika ada
            $oldLogo = Setting::where('key', 'app_logo')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete($oldLogo->value);
            }
            $path = $request->file('app_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'app_logo'], ['value' => $path]);
        }

        // Handle upload file untuk gambar hero
        if ($request->hasFile('hero_image')) {
            $request->validate(['hero_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048']);
            // Hapus gambar lama jika ada
            $oldHero = Setting::where('key', 'hero_image')->first();
            if ($oldHero && $oldHero->value) {
                Storage::disk('public')->delete($oldHero->value);
            }
            $path = $request->file('hero_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $path]);
        }

        if ($request->hasFile('about_us_image')) {
            $request->validate(['about_us_image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048']);
            $oldImage = Setting::where('key', 'about_us_image')->first();
            if ($oldImage && $oldImage->value) {
                Storage::disk('public')->delete($oldImage->value);
            }
            $path = $request->file('about_us_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'about_us_image'], ['value' => $path]);
        }
    
        
        toast('Pengaturan berhasil disimpan!', 'success');
        return redirect()->back();
    }
}