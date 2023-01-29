<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editar-foto" tabindex="-1" aria-labelledby="editar-foto-titulo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editar-foto-titulo">Editar Nome do Arquivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action={{ route('fotos.update') }} id="formulario-editar-foto" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="id-arquivo"/>
            <div class="input-group mb-3">
                <span class="input-group-text">Nome: </span>
                <input type="text" class="form-control" id="nome-arquivo" name="nome">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-return-left"></i>&nbsp; Voltar</button>
        <button type="button" class="btn btn-success" id="btn-editar-foto"><i class="bi bi-cloud-arrow-up"></i>&nbsp; Atualizar</button>
      </div>
    </div>
  </div>
</div>