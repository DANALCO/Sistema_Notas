<div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAlumno" name="formAlumno">
          <input type="hidden" name="idalumno" id="idalumno" value="">
          <div class="form-group">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="control-label">Edad:</label>
            <input type="text" class="form-control" id="edad" name="edad">
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
            <label for="control-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac">
          </div>
          <div class="form-group">
            <label for="control-label">Fecha de Registro:</label>
            <input type="date" class="form-control" id="fecha_reg" name="fecha_reg">
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