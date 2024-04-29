<div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Profesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProfesor" name="formProfesor">
          <input type="hidden" name="idprofesor" id="idprofesor" value="">
          <div class="form-group">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="control-label">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
          </div>
          <div class="form-group">
            <label for="control-label">Cedula:</label>
            <input type="text" class="form-control" id="cedula" name="cedula">
          </div>
          <div class="form-group">
            <label for="control-label">Clave:</label>
            <input type="password" class="form-control" id="clave" name="clave">
          </div>
          <div class="form-group">
            <label for="control-label">Telefono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
          </div>
          <div class="form-group">
            <label for="control-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo">
          </div>
          <div class="form-group">
            <label for="control-label">Nivel de estudio:</label>
            <input type="text" class="form-control" id="nivel_est" name="nivel_est">
          </div>
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
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