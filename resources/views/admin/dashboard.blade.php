@extends('layout.base', ['titulo' => 'Dashboard - Tires'])

@section('corpo')
    <div class="container">
        <h1 class="text-center mt-3"><i class="bi bi-speedometer"></i>&nbsp; Dashboard</h1>
        <div class="border rounded shadow p-3 mt-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ count($arquivos) == 12 ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard.index') }}">Últimos Meses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ count($arquivos) == 12 ? '' : 'active' }}" href="{{ route('dashboard.semanal') }}">Por Semana</a>
                </li>
            </ul>
            <div class="p-3">
                <canvas id="grafico"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            const ctx = document.getElementById('grafico');
            const labels = {!! json_encode(array_keys($arquivos)) !!};
            const arquivos = {!! json_encode($arquivos) !!}
            if(labels.length == 12) {
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Quantidade de Uploads',
                        data: arquivos,
                        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                        borderColor: ['rgb(255, 99, 132)'],
                        borderWidth: 1
                    }]
                };
                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                new Chart(ctx, config);
            } else {
                const data = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Quantidade de Uploads (Esta Semana)',
                            data: arquivos,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        },
                        {
                            label: 'Quantidade de Uploads (Semana Passada)',
                            data: {!! json_encode($arquivos_semana_anterior ?? []) !!},
                            fill: false,
                            borderColor: '#c45555',
                            tension: 0.1
                        }
                    ]
                };
                const config = {
                    type: 'line',
                    data: data,
                };
                new Chart(ctx, config);
            }
        })
    </script>
@endsection