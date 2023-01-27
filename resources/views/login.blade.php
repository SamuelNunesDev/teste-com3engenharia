@extends('layout.base', ['titulo' => 'Entrar - Tires'])

@section('css')
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
@endsection

@section('corpo')
    <div class="container-fluid">
        <div class="row">
            <div id="bg-login" class="col-lg-7 d-sm-none d-lg-block px-0"></div>
            <div class="col px-5">
                @include('components.formularioLogin', ['formulario' => Route::currentRouteName()])
            </div>
        <div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/login.js') }}"></script>
@endsection