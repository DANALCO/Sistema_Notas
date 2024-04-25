$('#tablegrados').DataTable();
var tablegrados;

document.addEventListener('DOMContentLoaded',function(){
    tablegrados = $('#tablegrados').DataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": "./models/grados/table_grados.php",
        "dataSrc": ""
    },
    "columns": [
        { "data": "acciones" },
        { "data": "grado_id" },
        { "data": "nombre_grado" },
        { "data": "estado" }
    ],
    "responsive": true,
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]]
    });
    var formGrado = document.querySelector('#formGrado');
    formGrado.onsubmit = function(e) {
        e.preventDefault();
        var idgrado = document.querySelector('#idgrado').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grados/ajax-grados.php';
        var form = new FormData(formGrado);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(request.status) {
                    $('#modalGrado').modal ('hide');
                    formGrado.reset();
                    swal("Grado", data.msg, "success");
                    tablegrados.ajax.reload();
                } else { 
                    swal("Atencion", data.msg, "error");
                }
            }
        }
    }
})
function openModal() {
    document.querySelector('#idgrado').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Grado';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formGrado').reset();
    $('#modalGrado').modal('show');
}
function editarGrado(id){
    var idgrado = id;
    document.querySelector('#tituloModal').innerHTML = 'Editar Grado';
    document.querySelector('#action').innerHTML = 'Actualizar';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/grados/edit-grado.php?idgrado='+idgrado;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if(request.status) {
                document.querySelector('#idgrado').value = data.data.grado_id;
                document.querySelector('#nombre').value= data.data.nombre_grado;
                document.querySelector('#listEstado').value = data.data.estado;

                $('#modalGrado').modal('show');
            } else { 
                swal("Atencion", data.msg, "error");
            }
        }
    }
}
function eliminarGrado(id){
    var idgrado = id;
    swal({
        title: "Eliminar grado",
        text: "¿Esta seguro que desea eliminar el grado",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest: new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/grados/delet-grado.php';
            request.open('POST', url, true);
            var strData = "idgrado="+idgrado; 
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal("Eliminar", data.msg, "success");
                        tablegrados.ajax.reload();
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