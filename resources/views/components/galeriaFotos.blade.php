 <div class="gamma-container gamma-loading rounded shadow p-3" id="gamma-container">
    <h2>{{ $data }}</h2>
    @if(!count($arquivos))
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-triangle"></i> &nbsp; Nenhuma foto cadastrada neste dia.
        </div>
    @endif
    <ul class="gamma-gallery">
        @foreach ($arquivos as $arquivo)
            <li>
                <div data-alt="imagem" data-description="<h3>{{ $arquivo->nome }}</h3>" data-max-width="1800" data-max-height="1350">
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="1300"></div>
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="1000"></div>
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="700"></div>
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="300"></div>
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="200"></div>
                    <div data-src="{{ $arquivo->urlPublica }}" data-min-width="140"></div>
                    <div data-src="{{ $arquivo->urlPublica }}"></div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="gamma-overlay"></div>
</div>