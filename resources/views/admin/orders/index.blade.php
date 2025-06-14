@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Semua Pesanan Masuk</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tgl. Pesan</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'badge-warning',
                                        'confirmed' => 'badge-info',
                                        'processing' => 'badge-primary',
                                        'completed' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                    ][$order->status] ?? 'badge-secondary';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $orders->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection