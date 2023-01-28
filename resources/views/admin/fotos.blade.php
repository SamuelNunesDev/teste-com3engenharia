@extends('layout.base', ['titulo' => 'Fotos - Tires'])

@section('css')
    <link href="{{ asset('assets/css/galeriaFotos.css') }}" rel="stylesheet">
    <link href="{{ asset('GammaGallery/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('GammaGallery/js/modernizr.custom.70736.js') }}"></script>
	<noscript><link rel="stylesheet" type="text/css" href="{{ asset('GammaGallery/css/noJS.css') }}"/></noscript>
@endsection

@section('corpo')
    @include('components.cadastroFoto')
    <h1 id="titulo" class="text-center pt-3"><i class="bi bi-card-image"> </i>Galeria de Fotos</h1>
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col text-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastro-foto"><i class="bi bi-plus-circle-fill"></i> &nbsp;Adicionar Foto</button>
            </div>
        <div>
       @include('components.galeriaFotos', ['data' => $data, 'arquivos' => $arquivos])
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="{{ asset('GammaGallery/js/jquery.masonry.min.js') }}"></script>
    <script src="{{ asset('GammaGallery/js/jquery.history.js') }}"></script>
    <script src="{{ asset('GammaGallery/js/js-url.min.js') }}"></script>
    <script src="{{ asset('GammaGallery/js/jquerypp.custom.js') }}"></script>
    <script src="{{ asset('GammaGallery/js/gamma.js') }}"></script>
    <script src="{{ asset('assets/js/gamma.js') }}"></script>
    <script>
        let arquivos_enviar = []

        function previewFile(file) {
            let reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onloadend = function() {
                let img = document.createElement('img')
                img.src = reader.result
                document.getElementById('gallery').appendChild(img)
            }
        }
        
        function handleFiles(files) {
            files = [...files]
            arquivos_enviar = files
            files.forEach(previewFile)
        }

        function uploadFiles() {
            let formData = new FormData()

            arquivos_enviar.forEach((arquivo, idx) => formData.append(`arquivos[${idx + 1}]`, arquivo))
            formData.append('criado_por', '{{ auth()->user()->id }}')
        
            fetch('{{ route('upload-foto') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': '{{ env("AUTORIZACAO_API_TOKEN") }}',
                    'Accept': 'application/json'
                }
            }).then((resposta) => { 
                return resposta.json()
            }).then(resposta => {
                arquivos_enviar = []
                $('#gallery').html('')
                $('#feedback-upload').addClass('alert-success').html(`<i class="bi bi-check-circle"></i> &nbsp;${resposta.mensagem}`)
                $('[data-bs-dismiss="modal"]').on('click', function(){
                    window.location.reload()
                })
            }).catch(() => { 
                $('#gallery').html('')
                $('#feedback-upload').addClass('alert-danger').html(`<i class="bi bi-bug"></i> &nbsp;${resposta.mensagem}`)
            })
        }

        $(document).ready(function() {
            $('#btn-upload-foto').on('click', function(){
                uploadFiles()
            })
        })
    </script>
@endsection