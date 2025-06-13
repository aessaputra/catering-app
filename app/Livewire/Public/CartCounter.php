<?php

namespace App\Livewire\Public;

use Gloudemans\Shoppingcart\Facades\Cart; // ✅ GANTI IMPORT INI
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function render()
    {
        // ✅ GUNAKAN Cart::count() UNTUK MENGHITUNG JUMLAH ITEM
        $cartTotal = Cart::count();
        
        return view('livewire.public.cart-counter', [
            'cartTotal' => $cartTotal
        ]);
    }
}