<div class="modal fade" id="modalEvaluacion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Evaluacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEvaluacion" name="formEvaluacion">
          <input type="hidden" name="idevaluacion" id="idevaluacion" value="">
          <input type="hidden" name="idcontenido" id="idcontenido" value="<?= $contenido; ?>">
          <div class="form-group">
            <label for="control-label">Titulo Del Contenido:</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
          </div>
          <div class="form-group">
            <label for="control-label">Descripcion Del Contenido:</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="control-label">Fecha Limite:</label>
            <input type="date" class="form-control" id="fecha" name="fecha">
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