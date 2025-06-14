@extends('layouts.admin')

@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
    <div class="row">
        {{-- Kolom Kiri: Detail & Update Status --}}
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Pesanan</h3>
                </div>
                <div class="card-body">
                    <strong>Nomor Pesanan:</strong>
                    <p class="text-muted">{{ $order->order_number }}</p>
                    <hr>
                    <strong>Total Harga:</strong>
                    <p class="text-muted">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <hr>
                    <strong>Tanggal Pesan:</strong>
                    <p class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    <hr>
                    <strong>Status Saat Ini:</strong>
                    <p>
                        @php
                            $statusClass =
                                [
                                    'pending' => 'badge-warning',
                                    'confirmed' => 'badge-info',
                                    'processing' => 'badge-primary',
                                    'completed' => 'badge-success',
                                    'cancelled' => 'badge-danger',
                                ][$order->status] ?? 'badge-secondary';
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                    </p>
                </div>
            </div>
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Update Status Pesanan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                                </option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Perbarui Status</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Rincian Item & Pesan WA --}}
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Rincian Item yang Dipesan</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kuantitas</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartDetails as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Format Pesan WhatsApp</h3>
                </div>
                <div class="card-body">
                    {{-- Gunakan <pre> untuk menjaga format teks termasuk line break --}}
                    <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;">{{ $order->whatsapp_message }}</pre>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke
        Daftar Pesanan</a>
@endsection
