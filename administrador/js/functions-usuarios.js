// Inicialización de DataTable para la tabla con ID 'tableusuarios'
$('#tableusuarios').DataTable();
// Declaración de la variable 'tableusuarios' para almacenar la instancia de DataTable
var tableusuarios;

// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded',function(){
    // Inicialización de DataTable con configuraciones específicas
    tableusuarios = $('#tableusuarios').DataTable({
    "aProcessing": true, // Activar el indicador de procesamiento
    "aServerSide": true, // Activar el procesamiento del lado del servidor
    "language": { // Configuración del idioma del DataTable
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": { // Configuración de la fuente de datos AJAX para la tabla
        "url": "./models/usuarios/table_usuarios.php", // URL del script que proporciona los datos
        "dataSrc": "" // Nombre del campo que contiene los datos en la respuesta JSON
    },
    "columns": [ // Definición de las columnas de la tabla
        { "data": "acciones" }, // Columna para acciones (botones de editar/eliminar)
        { "data": "usuario_id" }, // Columna para el ID del usuario
        { "data": "nombre" }, // Columna para el nombre del usuario
        { "data": "usuario" }, // Columna para el nombre de usuario
        { "data": "nombre_rol" }, // Columna para el nombre del rol
        { "data": "estado" } // Columna para el estado del usuario
    ],
    "responsive": true, // Activar la funcionalidad de diseño responsivo
    "bDestroy": true, // Destruir la tabla antes de volver a crearla
    "iDisplayLength": 10, // Número de registros por página
    "order": [[0, "asc"]] // Orden inicial de la tabla por la primera columna (acciones)
    });
     // Captura del evento de envío del formulario 'formUsuario'
    var formUsuario = document.querySelector('#formUsuario');
    formUsuario.onsubmit = function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario
        var idusuario = document.querySelector('#idusuario').value;
        var nombre = document.querySelector('#nombre').value;
        var usuario = document.querySelector('#usuario').value;
        var clave = document.querySelector('#clave').value;
        var rol = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;
                // Validación de campos obligatorios
        if(nombre == '' || usuario == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        // Creación de una instancia de XMLHttpRequest para enviar datos mediante AJAX
        /*verifica la disponibilidad de XMLHttpRequest y, en función de eso, crea una instancia específica (XMLHttpRequest o ActiveXObject('Microsoft.XMLHTTP')) 
        se debe a la necesidad de compatibilidad con diferentes navegadores, especialmente versiones más antiguas de Internet Explorer*/
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/ajax-usuarios.php';
         /* se está preparando la solicitud AJAX, 
        el true ndica que la solicitud será asíncrona, 
        esto significa que JavaScript continuará ejecutando el código después de enviar la solicitud, sin esperar la respuesta del servidor.*/
        var form = new FormData(formUsuario);
        // se utiliza para enviar un formulario (form) al servidor en formato de datos de formulario (FormData)
        request.open('POST', url, true);
        // se utiliza para enviar un formulario (form) al servidor en formato de datos de formulario (FormData)
        request.send(form);
        // Manejador para la respuesta de la petición AJAX
        request.onreadystatechange = function() {
            // Verifica si la solicitud AJAX ha completado todas las etapas (4) y el estado de la respuesta esta bien (200)
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
                if(request.status) {
                    $('#modalUsuario').modal ('hide'); // Oculta el modal
                    formUsuario.reset(); // Reinicia el formulario
                    swal("Usuario", data.msg, "success"); //carteles de notificacion como por ejemplo se guardo el proceso alumno
                    tableusuarios.ajax.reload(); // Recarga los datos del DataTable
                } else { 
                    swal("Usuario", data.msg, "error");
                }
            }
        }
    }
})
// Función para abrir el modal de creación de un usuario
function openModal() {
    document.querySelector('#idusuario').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Usuario';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formUsuario').reset();
    $('#modalUsuario').modal('show');
}
// Función para editar un usuario
function editarUsuario(id){
    var idusuario = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Usuario';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/usuarios/edit-usuarios.php? idusuario='+idusuario;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        // Verifica si la solicitud AJAX ha completado todas las etapas y el estado de la respuesta esta bien (200)
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
            if(request.status) {
            //data.data se usa para acceder al objeto data dentro de la respuesta JSON devuelta por el servidor.
                document.querySelector('#idusuario').value = data.data.usuario_id;
                document.querySelector('#nombre').value = data.data.nombre;
                document.querySelector('#usuario').value = data.data.usuario;
                document.querySelector('#listRol').value = data.data.rol;
                document.querySelector('#listEstado').value = data.data.estado;

                $('#modalUsuario').modal('show'); // Mostrar el modal de edición
            } else { 
                swal("Usuario", data.msg, "error");
            }
        }
    }
}
// Función para eliminar un usuario
function eliminarUsuario(id){
    var idusuario = id;
    swal({
        title: "Eliminar usuario",
        text: "¿Esta seguro que desea eliminar este usuario?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/usuarios/delet-usuarios.php';
            request.open('POST', url, true);
            var strData = "idusuario="+idusuario; 
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
                    if(data.status) {
                        swal("Eliminar", data.msg, "success");
                        tableusuarios.ajax.reload();// Recargar el DataTable
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