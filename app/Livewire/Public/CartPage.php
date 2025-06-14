<?php

namespace App\Livewire\Public;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPage extends Component
{
    public $cartItems;
    public $subtotal;
    public $total;

    protected $listeners = ['cart-updated' => '$refresh'];

    /**
     * Dijalankan saat komponen pertama kali di-load untuk menginisialisasi properti.
     */
    public function mount()
    {
        $this->loadCart();
    }

    /**
     * Helper method untuk memuat/me-refresh data keranjang ke properti public.
     */
    public function loadCart()
    {
        $this->cartItems = Cart::content()->toArray(); 
        
        $this->subtotal = Cart::subtotal(0, ',', '.');
        $this->total = Cart::total(0, ',', '.');
    }

    /**
     * Method untuk memperbarui kuantitas item.
     */
    public function updateCart($rowId, $quantity)
    {
        $qty = max(1, (int) $quantity);

        Cart::update($rowId, $qty);
        $this->loadCart(); // Muat ulang data setelah update
        $this->dispatch('cart-updated');
        toast('Kuantitas diperbarui!', 'info');
    }

    /**
     * Method untuk menghapus item dari keranjang.
     */
    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $this->loadCart(); // Muat ulang data setelah hapus
        $this->dispatch('cart-updated');
        toast('Item dihapus dari keranjang!', 'success');
    }

    /**
     * Method utama untuk memproses pesanan ke WhatsApp.
     */
    public function processOrder()
    {
        if (Cart::count() === 0) {
            toast('Keranjang Anda kosong!', 'error');
            return;
        }

        $message  = "Halo Admin CateringApp, saya ingin memesan:\n\n";
        foreach (Cart::content() as $item) {
            $message .= "*{$item->name}*\n";
            $message .= "Qty: {$item->qty}\n";
            $message .= "Harga: Rp " . number_format($item->price, 0, ',', '.') . "\n\n";
        }
        $message .= "*Total Pesanan: Rp " . Cart::total(0, ',', '.') . "*\n\n";
        $message .= "Mohon konfirmasi ketersediaan dan detail pembayarannya. Terima kasih.";

        Order::create([
            'order_number'      => 'CAT-'.date('Ymd').'-'.strtoupper(uniqid()),
            'cart_details'      => Cart::content()->toJson(),
            'total_price'       => Cart::total(0, '', ''),
            'status'            => 'pending',
            'whatsapp_message'  => $message,
        ]);

        $whatsappNumber = setting('whatsapp_number');
        if (!$whatsappNumber) {
            toast('Nomor WhatsApp admin belum diatur.', 'error');
            return;
        }
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNumber}&text={$encodedMessage}";

        Cart::destroy();
        $this->dispatch('cart-updated');
        $this->loadCart(); // Muat ulang data setelah keranjang dikosongkan

        return redirect()->away($whatsappUrl);
    }

    /**
     * Method untuk merender view.
     */
    public function render()
    {
        return view('livewire.public.cart-page');
    }
}