// Esta función se ejecuta cuando se carga el contenido del documento HTML
document.addEventListener('DOMContentLoaded', function(){
        // Captura del evento de envío del formulario de contenido
    var formContenido = document.querySelector('#formContenido');
    formContenido.onsubmit = function(e) {
        e.preventDefault();// Evita el comportamiento predeterminado de envío del formulario
        // Obtención de valores del formulario
        var idcontenido = document.querySelector('#idcontenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var material = document.querySelector('#file').value;
        // Validación de campos obligatorios
        if(titulo == '' || descripcion == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/contenido/ajax-contenido.php';
        var form = new FormData (formContenido);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    swal({
                        title: "Contenido Guardado",
                        text: data.msg,
                        icon: "success",
                        button: true,
                      })
                    .then((willCreate) => {
                        if (willCreate) {
                            $('#modalContenido').modal ('hide');
                            formContenido.reset();
                            location.reload();// Recargar la página
                        } 
                    });
                } else { 
                    swal("Atencion", data.msg, "error");
                }
            }
        }
    }
})
function openModalContenido() {
    document.querySelector('#idcontenido').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo contenido';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formContenido').reset();
    $('#modalContenido').modal('show');
}
// Función para editar un contenido existente
function editarContenido(id) {
    var idcontenido = id;
    document.querySelector('#tituloModal').innerHTML = 'Actualizar Contenido';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/contenido/edit-contenido.php?idcontenido='+idcontenido;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if(data.status) {
                document.querySelector('#idcontenido').value = data.data.contenido_id;
                document.querySelector('#titulo').value = data.data.titulo;
                document.querySelector('#descripcion').value = data.data.descripcion;
                //document.querySelector('#file').value = data.data.material;
                $('#modalContenido').modal('show');
            } else {
                swal("Atencion", data.msg, "error");
            }
        }
    }
}
   // Función para eliminar un contenido
function eliminarContenido(id){
    var idcontenido = id;
    swal({
        title: "Eliminar contenido",
        text: "¿Esta seguro que desea eliminar este contenido?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    .then((willDelete) => {
        if (willDelete) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
            var url = './models/contenido/delet-contenido.php';
            request.open('POST', url, true);
            var strData = "idcontenido="+idcontenido;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal({
                            title: "Contenido eliminado",
                            text: data.msg,
                            icon: "success",
                            button: true,
                          })
                        .then((willfin) => {
                            if (willfin) {
                                location.reload();// Recargar la página
                            } 
                        });
                    } else { 
                        swal("Atencion",data.msg,"error");
                    }
                }
            }
        } else {
          swal("Sin cambios");
        }
    });
}