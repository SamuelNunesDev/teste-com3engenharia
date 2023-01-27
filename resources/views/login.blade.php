@extends('layout.base', ['titulo' => 'Entrar - Tires'])

@section('css')
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
@endsection

@section('corpo')
    <div class="container-fluid">
        <div class="row">
            <div id="bg-login" class="col-lg-7 d-sm-none d-lg-block px-0"></div>
            <div class="col px-5">
                <form class="px-5" action="{{ route('autenticar') }}" method="post">
                    <div class="row justify-content-center mb-3">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="aperam" id="img-logo"/>
                    </div>
                    <div class="row mb-4">
                        <label class="text-center">Preencha os campos abaixo e entre em sua conta</label>
                    </div>
                    @csrf
                    @if(Session::has('erro'))
                        <div class="alert alert-danger text-center"><i class="bi bi-exclamation-triangle"></i> {{ Session::get('erro') }}</div>
                    @endif
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
                        </div>
                        @error('email')
                            <div class="form-text text-danger">
                                <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="senha" class="form-label">Senha</label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" placeholder="********" name="senha" required>
                            <span class="input-group-text bg-white btn border" id="btn-visualizar-senha"><i id="icone-olho-senha" class="bi bi-eye"></i></span>
                        </div>
                        @error('senha')
                            <div class="form-text text-danger">
                                <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" id="btn-login" class="btn btn-primary w-100 py-2 mt-3">Entrar</button>
                </form>
            </div>
        <div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#btn-visualizar-senha').on('click', function() {
                $iconeOlho = $('#icone-olho-senha')
                $inputSenha = $('[name="senha"').get(0)
                if($iconeOlho.hasClass('bi-eye')) {
                    $iconeOlho.removeClass('bi-eye')
                    $iconeOlho.addClass('bi-eye-slash')
                    $inputSenha.type = 'text'
                } else {
                    $iconeOlho.removeClass('bi-eye-slash')
                    $iconeOlho.addClass('bi-eye')
                    $inputSenha.type = 'password'
                }
            })
        })
    </script>
@endsection