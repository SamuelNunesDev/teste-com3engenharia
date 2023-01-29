@extends('layout.base', ['titulo' => 'Dashboard - Tires'])

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

@section('corpo')
    <div class="container pb-5">
        <h1 class="text-center mt-1"><i class="bi bi-speedometer"></i>&nbsp; Dashboard</h1>
        <div class="border rounded shadow p-3 mt-3">
            <h2 class="h4 mb-3">&nbsp; Upload de Arquivos</h2>
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
            <hr/>
            <h2 class="h4 mb-3">&nbsp; Arquivos {{ count($arquivos) == 12 ? '' : '(da semana atual)'  }}</h2>
            <div class="border p-3" style="background-color: rgb(245, 245, 245)!important">
                <table id="arquivos" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="2%">Código</th>
                            <th width="30%">Nome</th>
                            <th width="10%">Url Pública</th>
                            <th width="20%">Criado Por</th>
                            <th>Criado Em</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos_arquivos as $arquivo)
                            <tr>
                                <td>{{ $arquivo->id }}</td>
                                <td>{{ $arquivo->nome }}</td>
                                <td><a href="{{ $arquivo->urlPublica }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $arquivo->urlPublica }}">Acessar</a></td>
                                <td>{{ $arquivo->criador->nome }}</td>
                                <td>{{ \Carbon\Carbon::parse($arquivo->criado_em)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Baixar"><i class="bi bi-download"></i></a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
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

            $('#arquivos').DataTable({
                responsive: true,
                language: {
                    emptyTable: "Nenhum arquivo carregado.",
                    info: "Mostrando _START_ de _END_ no total de _TOTAL_ arquivos.",
                    infoEmpty:      "Mostrando 0 de 0 no total 0 arquivos.",
                    infoFiltered:   "(filtrado um total de _MAX_ arquivos).",
                    lengthMenu:     "Mostrando _MENU_ arquivos.",
                    loadingRecords: "Carregando...",
                    search:         "Pesquisar:",
                    zeroRecords:    "Nenhum arquivo encontrado.",
                    paginate: {
                        first:      "Primeiro",
                        last:       "Último",
                        next:       "Próximo",
                        previous:   "Anterior"
                    }
                }
            });
        })
    </script>
@endsection