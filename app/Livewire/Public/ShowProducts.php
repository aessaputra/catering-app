<?php

namespace App\Livewire\Public;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart; // ✅ GANTI IMPORT INI
use Livewire\Component;

class ShowProducts extends Component
{
    public $categories;
    public $selectedCategoryId = null;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
    }
    
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        // ✅ GUNAKAN SINTAKS BARU DARI PACKAGE INI
        Cart::add(
            $product->id, 
            $product->name, 
            1, // quantity
            $product->price, 
            ['image' => $product->image] // options
        );

        $this->dispatch('cart-updated');
        toast('Produk ditambahkan ke keranjang!', 'success');
    }

    public function render()
    {
        $productsQuery = Product::query();
        if ($this->selectedCategoryId) {
            $productsQuery->where('category_id', $this->selectedCategoryId);
        }
        $products = $productsQuery->latest()->get();
        
        return view('livewire.public.show-products', [
            'products' => $products
        ]);
    }
}