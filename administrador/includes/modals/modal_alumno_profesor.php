<div class="modal fade" id="modalAlumnoProfesor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Proceso Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAlumnoProfesor" name="formAlumnoProfesor">
          <!-- Campo oculto para almacenar el ID del alumno o profesor -->
          <input type="hidden" name="idalumnoprofesor" id="idalumnoprofesor" value="">
          <!-- Selección del alumno -->
          <div class="form-group">
            <!-- Lista desplegable para seleccionar el alumno (se llenará mediante AJAX) -->
            <!-- Esto se hace por medio del js -->
            <label for="listEstado">Seleccione el Alumno</label>
            <select class="form-control" name="listAlumno" id="listAlumno">
              <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <!-- Lista desplegable para seleccionar el profesor (se llenará mediante AJAX) -->
          <!-- Esto se hace por medio del js -->
          <div class="form-group">
            <label for="listGrado">Seleccione el Profesor</label>
            <select class="form-control" name="listProfesor" id="listProfesor">
              <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <!-- Selección del estado -->
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
              <option value="1">Activo</option>
              <option value="2">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <!-- Botón para cerrar el modal -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- Botón para guardar los datos del formulario -->
            <button type="submit" class="btn btn-primary" id="action">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>