@extends('layouts.dashboard')

@section('style')
@endsection

@section('contents')
    <div class="container-fluid h-100 d-flex flex-column" id="home">
        <div class="row py-3 justify-content-center">
            <div class="col-12 col-sm-4 mb-2 mb-sm-2">
                <div class="d-flex shadow rounded">
                    <span class="material-symbols-outlined fs-1 text-bg-dark col-3 d-flex align-items-center justify-content-center rounded-start">groups</span>
                    <div class="col-9 rounded-end bg-light">
                        <div class="col ps-2 fs-i5 text-secondary text-nowrap text-truncate">Siswa</div>
                        <div class="d-flex ps-2 align-items-center">
                            {{-- <span class="material-symbols-outlined my-1 fs-i1 fw-bold text-success bg-success-subtle d-flex align-items-center rounded">trending_up</span> --}}
                            <span class="fs-i2 ps-1 text-truncate">{{ $data['siswa'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-2 mb-sm-2">
                <div class="d-flex shadow rounded">
                    <span class="material-symbols-outlined fs-1 text-bg-dark col-3 d-flex align-items-center justify-content-center rounded-start">person</span>
                    <div class="col-9 rounded-end bg-light">
                        <div class="col ps-2 fs-i5 text-secondary text-nowrap text-truncate">Guru</div>
                        <div class="d-flex ps-2 align-items-center">
                            {{-- <span class="material-symbols-outlined my-1 fs-i1 fw-bold text-danger bg-danger-subtle d-flex align-items-center rounded">trending_down</span> --}}
                            <span class="fs-i2 ps-1 text-truncate">{{ $data['guru'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                <div class="d-flex shadow rounded">
                    <span class="material-symbols-outlined fs-1 text-bg-dark col-3 d-flex align-items-center justify-content-center rounded-start">meeting_room</span>
                    <div class="col-9 rounded-end bg-light">
                        <div class="col ps-2 fs-i5 text-secondary text-nowrap text-truncate">Ruangan</div>
                        <div class="d-flex ps-2 align-items-center">
                            {{-- <span class="material-symbols-outlined my-1 fs-i1 fw-bold text-success bg-success-subtle d-flex align-items-center rounded">trending_up</span> --}}
                            <span class="fs-i2 ps-1 text-truncate">{{ $data['kelas'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row flex-fill position-relative z-0">
            <div class="col-12 col-lg-8">
                <canvas class="bg-dark p-2 rounded" id="yearlyPerformance"></canvas>
            </div>
            <div class="col-lg-4 d-none d-lg-flex flex-column">
                <div class="container h-100 overflow-y-auto">
                    <div id="target" class="container position-sticky text-bg-dark sticky-top overflow-y-auto">
                        <span>Akses Cepat</span>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link link-primary" href="#">Evaluasi ABC</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link link-primary" href="#">Evaluasi ABC</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/assets/js/script.js"></script>
    <script>
        const ctx = document.getElementById('yearlyPerformance');
        Chart.defaults.color = '#fff';
        Chart.defaults.borderColor = '#5e5e5e';

        new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023'],
            datasets: [{
            label: ['Performa'],
            data: [37.8, 78.8, 79.2, 82.1, 76.7],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
        });
    </script>
@endsection