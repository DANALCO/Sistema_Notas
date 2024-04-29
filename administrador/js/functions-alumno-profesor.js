// Inicialización del DataTable
$('#tablealumnoprofesor').DataTable();
var tablealumnoprofesor;

// Evento que se ejecuta cuando el DOM ha sido completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Configuración y creación del DataTable
    tablealumnoprofesor = $('#tablealumnoprofesor').DataTable({
        "aProcessing": true, // Muestra el indicador de procesamiento
        "aServerSide": true, // Habilita el procesamiento del lado del servidor
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"  // Idioma español para DataTable
        },
        "ajax": {
            "url": "./models/alumno-profesor/table_alumno_profesor.php", // URL para obtener los datos mediante AJAX
            "dataSrc": "" // Nombre del objeto dentro del cual se encuentran los datos
        },
        "columns": [
            { "data": "acciones" }, // Columna para acciones (editar, eliminar)
            { "data": "pm_id" }, // Columna para el ID de la relación profesor-materia
            { "data": "nombre_alumno" }, // Columna para el nombre del alumno
            { "data": "nombre" }, // Columna para el nombre del profesor
            { "data": "nombre_grado" }, // Columna para el nombre del grado
            { "data": "nombre_materia" }, // Columna para el nombre de la materia
            { "data": "estadoap" } // Columna para el estado del proceso alumno-profesor
        ],
        "responsive": true, // Habilita la funcionalidad de diseño responsivo
        "bDestroy": true, // Destruye la instancia DataTable existente antes de crear una nueva
        "iDisplayLength": 10, // Define las opciones de longitud de visualización
        "order": [[0, "asc"]] // Orden inicial de los datos (por la primera columna, ascendente)
    });

    // Manejador para el envío del formulario
    var formAlumnoProfesor = document.querySelector('#formAlumnoProfesor');
    formAlumnoProfesor.onsubmit = function (e) {
        e.preventDefault(); // Evita el comportamiento predeterminado de envío del formulario
        // Obtención de los valores del formulario
        var idalumnoprofesor = document.querySelector('#idalumnoprofesor').value;
        var alumno = document.querySelector('#listAlumno').value;
        var profesor = document.querySelector('#listProfesor').value;
        var estado = document.querySelector('#listEstado').value;

        // Validación de campos requeridos
        if (alumno == '' || profesor == '' || estado == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }

        // Creación de una instancia de XMLHttpRequest para enviar datos mediante AJAX
        /*verifica la disponibilidad de XMLHttpRequest y, en función de eso, crea una instancia específica (XMLHttpRequest o ActiveXObject('Microsoft.XMLHTTP')) 
        se debe a la necesidad de compatibilidad con diferentes navegadores, especialmente versiones más antiguas de Internet Explorer*/
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno-profesor/ajax-alumno-profesor.php';
        // se utiliza para recopilar y enviar datos de formulario de manera fácil y estructurada
        var form = new FormData(formAlumnoProfesor);
        /* se está preparando la solicitud AJAX, 
        el true ndica que la solicitud será asíncrona, 
        esto significa que JavaScript continuará ejecutando el código después de enviar la solicitud, sin esperar la respuesta del servidor.*/
        request.open('POST', url, true);
        // se utiliza para enviar un formulario (form) al servidor en formato de datos de formulario (FormData)
        request.send(form);
        // Manejador para la respuesta de la petición AJAX
        request.onreadystatechange = function () {
            // Verifica si la solicitud AJAX ha completado todas las etapas (4) y el estado de la respuesta esta bien (200)
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
                if (request.status) {
                    $('#modalAlumnoProfesor').modal('hide'); // Oculta el modal
                    formAlumnoProfesor.reset();// Reinicia el formulario
                    swal("Crear Proceso alumno", data.msg, "success");//carteles de notificacion como por ejemplo se guardo el proceso alumno
                    tablealumnoprofesor.ajax.reload(); // Recarga los datos del DataTable
                } else {
                    swal("Profesor", data.msg, "error");
                }
            }
        }
    }
})
// Función para abrir el modal de creación de proceso alumno-profesor
function openModalAlumnoProfesor() {
    document.querySelector('#idalumnoprofesor').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Proceso alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumnoProfesor').reset();
    $('#modalAlumnoProfesor').modal('show');
}
// Evento que se ejecuta cuando la ventana se ha cargado completamente
window.addEventListener('load', function () {
    showProfesor();// Mostrar opciones de profesores
    showAlumno();// Mostrar opciones de alumnos
}, false);

// Función para obtener y mostrar opciones de profesores mediante AJAX
function showProfesor() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-aprofesor.php';
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function (valor) {
                data += '<option value="' + valor.pm_id + '">Profesor: ' + valor.nombre + ', Grado: ' + valor.nombre_grado + ', Aula: ' + valor.nombre_aula + ', Materia: ' + valor.nombre_materia + '</option>';
            });
            //se utiliza para modificar el contenido HTML de un elemento en el documento HTML
            document.querySelector('#listProfesor').innerHTML = data;
        }
    }
}

// Función para obtener y mostrar opciones de alumnos mediante AJAX
function showAlumno() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-alumno.php';
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function (valor) {
                data += '<option value="' + valor.alumno_id + '">' + valor.nombre_alumno + '</option>';
            });
            //se utiliza para modificar el contenido HTML de un elemento en el documento HTML
            document.querySelector('#listAlumno').innerHTML = data;
        }
    }
}

// Función para editar un proceso alumno-profesor
function editarAlumnoProfesor(id) {
    var idalumnoprofesor = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Proceso Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/alumno-profesor/edit-alumno-profesor.php?id=' + idalumnoprofesor;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        // Verifica si la solicitud AJAX ha completado todas las etapas y el estado de la respuesta esta bien (200)
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
            if (request.status) {
                //el data.data se usa para acceder al objeto data dentro de la respuesta JSON devuelta por el servidor.
                document.querySelector('#idalumnoprofesor').value = data.data.ap_id;
                document.querySelector('#listAlumno').value = data.data.alumno_id;
                document.querySelector('#listProfesor').value = data.data.pm_id;
                document.querySelector('#listEstado').value = data.data.estadoap;

                $('#modalAlumnoProfesor').modal('show'); // Mostrar el modal de edición
            } else {
                swal("Atención", data.msg, "error");
            }
        }
    }
}

// Función para eliminar un proceso alumno-profesor
function eliminarAlumnoProfesor(id) {
    var idalumnoprofesor = id;
    swal({
        title: "Eliminar proceso",
        text: "¿Esta seguro que desea eliminar el proceso?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var url = './models/alumno-profesor/delet-alumno-profesor.php';
                request.open('POST', url, true);
                var strData = "id=" + idalumnoprofesor;
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        // Comprueba si el estado de la solicitud es verdadero (esto siempre será verdadero cuando el estado es diferente de 0)
                        if (data.status) {
                            swal("Eliminar", data.msg, "success");
                            tablealumnoprofesor.ajax.reload();// Recargar el DataTable
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