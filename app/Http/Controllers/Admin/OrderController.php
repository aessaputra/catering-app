<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Terapkan middleware otorisasi ke semua method di controller ini.
     */
    public function __construct()
    {
        $this->middleware('can:is-admin');
    }

    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        // View ini akan kita buat di langkah selanjutnya
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Lakukan konversi manual di sini sebagai solusi pasti.
        $cartDetails = is_string($order->cart_details)
            ? json_decode($order->cart_details, true)
            : $order->cart_details;

        // Pengaman tambahan jika hasil decode null atau bukan array
        if (!is_array($cartDetails)) {
            $cartDetails = []; // Jadikan array kosong agar view tidak error
        }

        // Kirim variabel 'order' dan 'cartDetails' yang sudah diproses ke view
        return view('admin.orders.show', [
            'order' => $order,
            'cartDetails' => $cartDetails
        ]);
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,processing,completed,cancelled',
        ]);

        // Update status pesanan
        $order->update(['status' => $request->status]);

        toast('Status pesanan berhasil diperbarui!', 'success');
        return redirect()->route('admin.orders.show', $order);
    }
}