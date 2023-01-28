@extends('layout.base', ['titulo' => 'Página Não Encontrada'])

@section('corpo')
    <main class="container bg-white rounded shadow mt-5">
        <div class="row justify-content-center">
            <article class="col-12 col-md-8 bg-semi-transparent mt-4 text-center py-3" id="erro404">
                <h1>Ops! Algo deu errado...</h1>
                <p class="mt-3 font-size">A página que você está tentando acessar não foi encontrada ou não existe!</p>
                <p class="mt-3 font-size">Tente novamente ou navegue pelo <a href="{{ route('dashboard.index') }}">menu principal.</a></p>
                <img src="{{ asset('assets/img/erro404.png') }}" alt="Erro 404">
            </article>
        </div>
    </main>
@endsection