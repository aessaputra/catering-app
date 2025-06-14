<?php

namespace App\Livewire\Public;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component
{
    public function render()
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('livewire.public.featured-products', [
            'products' => $featuredProducts
        ]);
    }
}