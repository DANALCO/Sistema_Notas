// Esta función se ejecuta cuando se carga el contenido del documento HTML
document.addEventListener('DOMContentLoaded', function () {
    // Captura del evento de envío del formulario de evaluación
    var formEvaluacion = document.querySelector('#formEvaluacion');
    formEvaluacion.onsubmit = function (e) {
        e.preventDefault();
        var idevaluacion = document.querySelector('#idevaluacion').value;
        var idcontenido = document.querySelector('#idcontenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var fecha = document.querySelector('#fecha').value;
        if (titulo == '' || descripcion == '' || fecha == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluacion/ajax-evaluacion.php';
        var form = new FormData(formEvaluacion);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    swal({
                        title: "Evaluacion Guardada",
                        text: data.msg,
                        icon: "success",
                        button: true,
                    })
                        .then((willCreate) => {
                            if (willCreate) {
                                $('#modalEvaluacion').modal('hide');
                                formEvaluacion.reset();
                                location.reload();
                            }
                        });
                } else {
                    swal("Atencion", data.msg, "error");
                }
            }
        }
    }
})

// Función para abrir el modal de creación de nueva evaluación
function openModalEvaluacion() {
    document.querySelector('#idevaluacion').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva evaluacion';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formEvaluacion').reset();
    $('#modalEvaluacion').modal('show');
}
// Función para editar una evaluación existente
function editarEvaluacion(id) {
    var idevaluacion = id;
    document.querySelector('#tituloModal').innerHTML = 'Actualizar Evaluacion';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/evaluacion/edit-evaluacion.php?idevaluacion=' + idevaluacion;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idevaluacion').value = data.data.evaluacion_id;
                document.querySelector('#titulo').value = data.data.titulo;
                document.querySelector('#descripcion').value = data.data.descripcion;
                document.querySelector('#fecha').value = data.data.fecha;
                $('#modalEvaluacion').modal('show');
            } else {
                swal("Atencion", data.msg, "error");
            }
        }
    }
}
// Función para eliminar una evaluación
function eliminarEvaluacion(id) {
    var idevaluacion = id;
    swal({
        title: "Eliminar Evaluacion",
        text: "¿Esta seguro que desea eliminar esta Evaluacion?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var url = './models/evaluacion/delet-evaluacion.php';
                request.open('POST', url, true);
                var strData = "idevaluacion=" + idevaluacion;
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        if (data.status) {
                            swal({
                                title: "Evaluacion eliminada",
                                text: data.msg,
                                icon: "success",
                                button: true,
                            })
                                .then((willfin) => {
                                    if (willfin) {
                                        location.reload();
                                    }
                                });
                        } else {
                            swal("Atencion", data.msg, "error");
                        }
                    }
                }
            } else {
                swal("Sin cambios");
            }
        });
}