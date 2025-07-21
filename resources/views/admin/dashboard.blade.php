@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Statistik -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-indigo shadow-sm">
                <div class="inner">
                    <h3>{{ $totalPengguna }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.pengguna.index') }}" class="small-box-footer">
                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success shadow-sm">
                <div class="inner">
                    <h3>{{ $totalSantri }}</h3>
                    <p>Total Santri</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{ route('admin.santri.index') }}" class="small-box-footer">
                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning shadow-sm">
                <div class="inner">
                    <h3>{{ $totalWali }}</h3>
                    <p>Total Wali</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="{{ route('admin.wali.index') }}" class="small-box-footer">
                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger shadow-sm">
                <div class="inner">
                    <h3>{{ $totalAlumni }}</h3>
                    <p>Total Alumni</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="{{ route('admin.alumni.index') }}" class="small-box-footer">
                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Grafik -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Statistik Pendaftaran Santri</h3>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Aktivitas Terbaru -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Aktivitas Terbaru</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li class="item border-bottom py-3">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Santri Baru
                                    <span class="badge badge-success float-right">Baru</span></a>
                                <span class="product-description">
                                    Ahmad Fauzi telah terdaftar sebagai santri baru
                                </span>
                            </div>
                        </li>
                        <li class="item border-bottom py-3">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Pembayaran
                                    <span class="badge badge-primary float-right">Lunas</span></a>
                                <span class="product-description">
                                    SPP bulan Juni telah dibayar oleh Muhammad Ali
                                </span>
                            </div>
                        </li>
                        <li class="item py-3">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Hafalan
                                    <span class="badge badge-info float-right">Update</span></a>
                                <span class="product-description">
                                    Fahmi telah menyelesaikan juz 30
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('registrationChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Santri Baru',
                    data: [12, 19, 5, 22, 18, 25],
                    backgroundColor: 'rgba(30, 58, 138, 0.1)',
                    borderColor: 'rgba(30, 58, 138, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection