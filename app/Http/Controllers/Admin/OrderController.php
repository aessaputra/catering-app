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
        // View ini akan kita buat di langkah selanjutnya
        return view('admin.orders.show', compact('order'));
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