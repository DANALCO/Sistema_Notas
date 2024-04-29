$('#tablealumnos').DataTable();
var tablealumnos;

document.addEventListener('DOMContentLoaded',function(){
    tablealumnos = $('#tablealumnos').DataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": "./models/alumnos/table_alumnos.php",
        "dataSrc": ""
    },
    "columns": [
        { "data": "acciones" },
        { "data": "alumno_id" },
        { "data": "nombre_alumno" },
        { "data": "edad" },
        { "data": "direccion" },
        { "data": "cedula" },
        { "data": "telefono" },
        { "data": "correo" },
        { "data": "fecha_nac" },
        { "data": "fecha_registro" },
        { "data": "estado" }
    ],
    "responsive": true,
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]]
    });
    var formAlumno = document.querySelector('#formAlumno');
    formAlumno.onsubmit = function(e) {
        e.preventDefault();
        var idalumno = document.querySelector('#idalumno').value;
        var nombre = document.querySelector('#nombre').value;
        var edad = document.querySelector('#edad').value;
        var direccion = document.querySelector('#direccion').value;
        var cedula = document.querySelector('#cedula').value;
        var clave = document.querySelector('#clave').value;
        var telefono = document.querySelector('#telefono').value;
        var correo = document.querySelector('#correo').value;
        var fecha_nac = document.querySelector('#fecha_nac').value;
        var fecha_reg = document.querySelector('#fecha_reg').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '' || direccion == '' || cedula == '' || telefono == '' || correo == '' || fecha_nac == '' || fecha_reg == '' || edad == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        if(edad < 1) {
            swal("Atencion", "La edad no es valida", "warning");
            return false;
        }
        if(cedula < 1) {
            swal("Atencion", "La cedula no es valida", "warning");
            return false;
        }
        if(telefono < 1) {
            swal("Atencion", "El telefono no es valida", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/ajax-alumnos.php';
        var form = new FormData(formAlumno);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(request.status) {
                    $('#modalAlumno').modal ('hide');
                    formAlumno.reset();
                    swal("Alumno", data.msg, "success");
                    tablealumnos.ajax.reload();
                } else { 
                    swal("Alumno", data.msg, "error");
                }
            }
        }
    }
})
function openModalAlumno() {
    document.querySelector('#idalumno').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');
}
function editarAlumno(id){
    var idalumno = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/alumnos/edit-alumno.php? idalumno='+idalumno;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if(request.status) {
                document.querySelector('#idalumno').value = data.data.alumno_id;
                document.querySelector('#nombre').value= data.data.nombre_alumno;
                document.querySelector('#edad').value= data.data.edad;
                document.querySelector('#direccion').value= data.data.direccion;
                document.querySelector('#cedula').value = data.data.cedula;
                document.querySelector('#telefono').value = data.data.telefono;
                document.querySelector('#correo').value = data.data.correo;
                document.querySelector('#fecha_nac').value = data.data.fecha_nac;
                document.querySelector('#fecha_reg').value = data.data.fecha_registro;
                document.querySelector('#listEstado').value = data.data.estado;

                $('#modalAlumno').modal('show');
            } else { 
                swal("Alumno", data.msg, "error");
            }
        }
    }
}
function eliminarAlumno(id){
    var idalumno = id;
    swal({
        title: "Eliminar alumno",
        text: "¿Esta seguro que desea eliminar este alumno?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/alumnos/delet-alumnos.php';
            request.open('POST', url, true);
            var strData = "idalumno="+idalumno; 
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal("Eliminar", data.msg, "success");
                        tablealumnos.ajax.reload();
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