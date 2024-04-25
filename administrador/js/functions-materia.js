$('#tablematerias').DataTable();
var tablematerias;

document.addEventListener('DOMContentLoaded',function(){
    tablematerias = $('#tablematerias').DataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": "./models/materias/table_materias.php",
        "dataSrc": ""
    },
    "columns": [
        { "data": "acciones" },
        { "data": "materia_id" },
        { "data": "nombre_materia" },
        { "data": "estado" }
    ],
    "responsive": true,
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]]
    });
    var formMateria = document.querySelector('#formMateria');
    formMateria.onsubmit = function(e) {
        e.preventDefault();
        var idmateria = document.querySelector('#idmateria').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/materias/ajax-materias.php';
        var form = new FormData(formMateria);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(request.status) {
                    $('#modalMateria').modal ('hide');
                    formMateria.reset();
                    swal("Materia", data.msg, "success");
                    tablematerias.ajax.reload();
                } else { 
                    swal("Atencion", data.msg, "error");
                }
            }
        }
    }
})
function openModal() {
    document.querySelector('#idmateria').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Materia';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formMateria').reset();
    $('#modalMateria').modal('show');
}
function editarMateria(id){
    var idmateria = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Materia';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/materias/edit-materia.php?idmateria='+idmateria;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if(request.status) {
                document.querySelector('#idmateria').value = data.data.materia_id;
                document.querySelector('#nombre').value= data.data.nombre_materia;
                document.querySelector('#listEstado').value = data.data.estado;

                $('#modalMateria').modal('show');
            } else { 
                swal("Atencion", data.msg, "error");
            }
        }
    }
}
function eliminarMateria(id){
    var idmateria = id;
    swal({
        title: "Eliminar Materia",
        text: "¿Esta seguro que desea eliminar la materia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/materias/delet-materia.php';
            request.open('POST', url, true);
            var strData = "idmateria="+idmateria; 
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal("Eliminar", data.msg, "success");
                        tablematerias.ajax.reload();
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