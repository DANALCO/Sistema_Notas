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
        <!-- Formulario -->
        <form id="formUsuario" name="formUsuario">
          <!-- Campo oculto para el ID del usuario -->
          <!-- Es necesario tener este campo a la hora de hacer submit para que resiva esta info el js-->
          <input type="hidden" name="idusuario" id="idusuario" value="">
          <!-- Campo de entrada para el nombre del usuario -->
          <div class="form-group">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <!-- Campo de entrada para el nombre de usuario -->
          <div class="form-group">
            <label for="control-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
          </div>
          <!-- Campo de entrada para la clave del usuario -->
          <div class="form-group">
            <label for="control-label">Clave:</label>
            <input type="password" class="form-control" id="clave" name="clave">
          </div>
          <!-- Selección de rol del usuario -->
          <div class="form-group">
            <label for="listRol">Rol</label>
            <select class="form-control" name="listRol" id="listRol">
              <option value="1">Administrador</option>
              <option value="2">Asistente</option>
            </select>
          </div>
          <!-- Selección de estado del usuario -->
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
              <option value="1">Activo</option>
              <option value="2">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <!-- Botón para cerrar el modal sin guardar cambios -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- Botón para enviar el formulario y guardar los cambios -->
            <button type="submit" class="btn btn-primary" id="action">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>