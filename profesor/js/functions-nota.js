// Esta función se ejecuta cuando se carga el contenido del documento HTML
document.addEventListener('DOMContentLoaded',function(){
    // Captura del evento de envío del formulario de nota
    var formNota = document.querySelector('#formNota');
    formNota.onsubmit= function(e) {
        e.preventDefault();

        var ideventregada = document.querySelector('#ideventregada').value;
        var nota = document.querySelector('#nota').value;
        
        if(nota == '') {
            swal("Atencion", "Todos los campos son necesarios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
        var url = './models/nota/ajax-nota.php';
        var form = new FormData(formNota);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    swal({
                        title: "Nota Guardada",
                        icon: "success",
                        button: true,
                      })
                    .then((willCreate) => {
                        if (willCreate) {
                            $('#modalNota').modal ('hide');
                            formNota.reset();
                            location.reload();
                        } 
                    });
                } else { 
                    swal("Atencion", data.msg, "error");
                }
            }
        }
    }
});
// Esta función se ejecuta cuando se oculta el modal de nota
$('#modalNota').on('hidden.bs.modal', function () {
    // Resetear el formulario
    $('#formNota')[0].reset();
});
// Función para mostrar el modal de nota
function modalNota() {
    $('#modalNota').modal('show');
}