<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        return $settings[$key] ?? $default;
    }
}