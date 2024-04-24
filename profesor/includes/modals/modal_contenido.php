<div class="modal fade" id="modalContenido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Contenido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formContenido" name="formContenido" enctype="multipart/form-data">
          <input type="hidden" name="idcontenido" id="idcontenido" value="">
          <input type="hidden" name="idcurso" id="idcurso" value="<?= $curso; ?>">
          <div class="form-group">
            <label for="control-label">Titulo Del Contenido:</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
          </div>
          <div class="form-group">
            <label for="control-label">Descripcion Del Contenido:</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="control-label">Adjuntar Material:</label>
            <input type="file" class="form-control" id="file" name="file">
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="action">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>