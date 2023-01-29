@extends('layout.base', ['titulo' => 'Dashboard - Tires'])

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

@section('corpo')
    @include('components.editarFoto')
    <div class="container pb-5">
        <h1 class="text-center mt-1"><i class="bi bi-speedometer"></i>&nbsp; Dashboard</h1>
        @if(Session::has('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Sucesso!</strong> {{ Session::get('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('erro'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ Session::get('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                            <th>Criado Por</th>
                            <th width="15%">Criado Em</th>
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
                                        <a href="{{ route('fotos.baixar', ['arquivo' => $arquivo->id]) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Baixar"><i class="bi bi-download"></i></a>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editar-foto" data-nome-arquivo="{{ $arquivo->nome }}" data-id-arquivo="{{ $arquivo->id }}">
                                            <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-excluir-arquivo" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" data-id-arquivo="{{ $arquivo->id }}"><i class="bi bi-trash"></i></button>
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
                    infoEmpty:      "Mostrando 0 de 0 no total 0 arquivo(s).",
                    infoFiltered:   "(filtrado um total de _MAX_ arquivo(s)).",
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

            $(document).on('click', '[data-bs-target="#editar-foto"]', function() {
                $('#nome-arquivo').val($(this).attr('data-nome-arquivo'))
                $('#id-arquivo').val($(this).attr('data-id-arquivo'))
            })

            $('#btn-editar-foto').on('click', function() {
                $('#formulario-editar-foto').submit()
            })

            $(document).on('click', '.btn-excluir-arquivo', function() {
                Swal.fire({
                    title: 'Voce tem certeza?',
                    text: 'Esta ação é irreversível, após a exclusão de um arquivo não é possível recuperá-lo.',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir.',
                    cancelButtonText: `Não, cancelar.`,
                    icon: 'question'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `{{ url('fotos/delete') }}/${$(this).attr('data-id-arquivo')}`
                    }
                })
            })
        })
    </script>
@endsection