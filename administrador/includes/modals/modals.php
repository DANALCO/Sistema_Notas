<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario">
          <input type="hidden" name="idusuario" id="idusuario" value="">
          <div class="form-group">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="control-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
          </div>
          <div class="form-group">
            <label for="control-label">Clave:</label>
            <input type="password" class="form-control" id="clave" name="clave">
          </div>
          <div class="form-group">
            <label for="listRol">Rol</label>
            <select class="form-control" name="listRol" id="listRol">
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
            </select>
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