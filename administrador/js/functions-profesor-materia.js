$('#tableprofesormateria').DataTable();
var tableprofesormateria;

document.addEventListener('DOMContentLoaded',function(){
    tableprofesormateria = $('#tableprofesormateria').DataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": "./models/profesor-materia/table_profesor_materia.php",
        "dataSrc": ""
    },
    "columns": [
        { "data": "acciones" },
        { "data": "pm_id" },
        { "data": "nombre" },
        { "data": "nombre_grado" },
        { "data": "nombre_aula" },
        { "data": "nombre_materia" },
        { "data": "estadopm" }
    ],
    "responsive": true,
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]]
    });
    var formProfesorMateria = document.querySelector('#formProfesorMateria');
    formProfesorMateria.onsubmit = function(e) {
        e.preventDefault();
        var idprofesormateria = document.querySelector('#idprofesormateria').value;
        var nombre = document.querySelector('#listProfesor').value;
        var grado = document.querySelector('#listGrado').value;
        var aula = document.querySelector('#listAula').value;
        var materia = document.querySelector('#listMateria').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '' || grado == '' || aula == '' || materia == '' || estado == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');
        var url ='./models/profesor-materia/ajax-profesor-materia.php';
        var form = new FormData(formProfesorMateria);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(request.status) {
                    $('#modalProfesorMateria').modal ('hide');
                    formProfesorMateria.reset();
                    swal("Crear Profesor Materia", data.msg, "success");
                    tableprofesormateria.ajax.reload();
                } else { 
                    swal("Profesor", data.msg, "error");
                }
            }
        }
    }
})
function openModalProfesorMateria() {
    document.querySelector('#idprofesormateria').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Profesor Materia';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formProfesorMateria').reset();
    $('#modalProfesorMateria').modal('show');
}

window.addEventListener('load', function(){
    showProfesor();
    showGrado();
    showAula();
    showMateria();
},false);

function showProfesor() {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url ='./models/options/options-profesor.php';
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                data.forEach(function(valor) {
                    data += '<option value="'+valor.profesor_id+'">'+valor.nombre+'</option>'; 
                });
                document.querySelector('#listProfesor').innerHTML = data;
            }
        }
    }

    function showGrado() {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url ='./models/options/options-grado.php';
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                data.forEach(function(valor) {
                    data += '<option value="'+valor.grado_id+'">'+valor.nombre_grado+'</option>'; 
                });
                document.querySelector('#listGrado').innerHTML = data;
            }
        }
    }

    function showAula() {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url ='./models/options/options-aula.php';
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                data.forEach(function(valor) {
                    data += '<option value="'+valor.aula_id+'">'+valor.nombre_aula+'</option>'; 
                });
                document.querySelector('#listAula').innerHTML = data;
            }
        }
    }

    function showMateria() {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url ='./models/options/options-materia.php';
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                data.forEach(function(valor) {
                    data += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>'; 
                });
                document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }

function editarProfesorMateria(id){
    var idprofesormateria = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Profesor Materia';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');
    var url ='./models/profesor-materia/edit-profesor-materia.php?id='+idprofesormateria;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if(request.status) {
                document.querySelector('#idprofesormateria').value = data.data.pm_id;
                document.querySelector('#listProfesor').value= data.data.profesor_id;
                document.querySelector('#listGrado').value= data.data.grado_id;
                document.querySelector('#listAula').value= data.data.aula_id;
                document.querySelector('#listMateria').value= data.data.materia_id;
                document.querySelector('#listEstado').value = data.data.estadopm;

                $('#modalProfesorMateria').modal('show');
            } else { 
                swal("Profesor", data.msg, "error");
            }
        }
    }
}
function eliminarProfesorMateria(id){
    var idprofesormateria = id;
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
            var url ='./models/profesor-materia/delet-profesor-materia.php';
            request.open('POST', url, true);
            var strData = "id="+idprofesormateria;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal("Eliminar", data.msg, "success");
                        tableprofesormateria.ajax.reload();
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