@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- 1. Baris untuk Info Box Statistik --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pendingOrdersCount }}</h3>
                    <p>Pesanan Baru (Pending)</p>
                </div>
                <div class="icon"><i class="ion ion-bag"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Lihat Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    {{-- Format sebagai mata uang --}}
                    <h3><sup style="font-size: 20px">Rp</sup>{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <p>Total Pendapatan (Completed)</p>
                </div>
                <div class="icon"><i class="ion ion-stats-bars"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Lihat Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>
                    <p>Jumlah Pengguna</p>
                </div>
                <div class="icon"><i class="ion ion-person-add"></i></div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $productCount }}</h3>
                    <p>Jumlah Produk</p>
                </div>
                <div class="icon"><i class="ion ion-pie-graph"></i></div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">Lihat Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- 2. Baris untuk Grafik dan Tabel Pesanan --}}
    <div class="row">
        {{-- Kolom Kiri: Grafik Penjualan --}}
        <section class="col-lg-7 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Penjualan (7 Hari Terakhir)
                    </h3>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                            <canvas id="salesChart" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Kolom Kanan: Pesanan Terbaru --}}
        <section class="col-lg-5 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        Pesanan Terbaru
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td><a
                                            href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a>
                                    </td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada pesanan terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection


{{-- 3. Push script Chart.js ke stack di layout utama --}}
@push('scripts')
    {{-- CDN untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line', // Tipe grafik: line, bar, pie, dll.
                data: {
                    labels: {!! json_encode($chartLabels) !!}, // Label dari controller
                    datasets: [{
                        label: 'Pendapatan',
                        data: {!! json_encode($chartData) !!}, // Data dari controller
                        backgroundColor: 'rgba(60,141,188,0.2)',
                        borderColor: 'rgba(60,141,188,1)',
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
