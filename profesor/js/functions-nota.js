document.addEventListener('DOMContentLoaded',function(){
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

function modalNota() {
    $('#modalNota').modal('show');
}