<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="cadastro-foto" tabindex="-1" aria-labelledby="cadastro-foto-titulo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadastro-foto-titulo">Cadastrar Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert" role="alert" id="feedback-upload"></div>
        <div id="drop-area">
            <form class="my-form">
                <p>Arraste arquivos para dentro da área pontilhada para fazer o upload.</p>
                <input type="file" id="fileElem" multiple accept="image/png, image/jpeg, image/jpg" onchange="handleFiles(this.files)">
                <label class="button" for="fileElem">Selecionar Arquivos</label>
                <div id="gallery"></div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-return-left"></i>&nbsp; Voltar</button>
        <button type="button" class="btn btn-success" id="btn-upload-foto"><i class="bi bi-cloud-arrow-up"></i>&nbsp; Salvar</button>
      </div>
    </div>
  </div>
</div>