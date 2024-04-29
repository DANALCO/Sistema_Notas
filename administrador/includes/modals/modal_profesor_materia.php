<div class="modal fade" id="modalProfesorMateria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Profesor Materia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProfesorMateria" name="formProfesorMateria">
          <!-- Campo oculto para almacenar el ID de la relación profesor-materia -->
          <input type="hidden" name="idprofesormateria" id="idprofesormateria" value="">
          <!-- Selección del profesor -->
          <div class="form-group">
            <!-- Lista desplegable para seleccionar el profesor (se llenará mediante AJAX) -->
            <!-- Esto se hace por medio del js -->
            <label for="listEstado">Seleccione el Profesor</label>
            <select class="form-control" name="listProfesor" id="listProfesor">
              <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <!-- Selección del grado -->
          <div class="form-group">
            <!-- Lista desplegable para seleccionar el grado (se llenará mediante AJAX) -->
            <!-- Esto se hace por medio del js -->
            <label for="listGrado">Seleccione el Grado</label>
            <select class="form-control" name="listGrado" id="listGrado">
              <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <!-- Selección del aula -->
          <div class="form-group">
            <!-- Lista desplegable para seleccionar el aula (se llenará mediante AJAX) -->
            <!-- Esto se hace por medio del js -->
            <label for="listEstado">Seleccione el Aula</label>
            <select class="form-control" name="listAula" id="listAula">
              <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <!-- Selección de la materia -->
          <div class="form-group">
            <!-- Lista desplegable para seleccionar la materia (se llenará mediante AJAX) -->
            <!-- Esto se hace por medio del js -->
            <label for="listEstado">Seleccione la Materia</label>
            <select class="form-control" name="listMateria" id="listMateria">
              <!-- CONTENIDO AJAX -->
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