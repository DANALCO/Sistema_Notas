document.addEventListener('DOMContentLoaded',function(){

    var formEntrega = document.querySelector('#formEntrega');
    formEntrega.onsubmit= function(e) {
        e.preventDefault();
    
        var observacion = document.querySelector('#observacion').value;
        var file = document.querySelector('#file').value;

        if(observacion.trim() == '' || file == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }
    
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/entrega/ajax-entrega.php';
        var form = new FormData(formEntrega);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    swal({
                        title: "Evaluacion Entregada",
                        text: data.msg,
                        icon: "success",
                        button: true,
                      })
                    .then((willCreate) => {
                        if (willCreate) {
                            formEntrega.reset();
                            location.reload();
                        } 
                    });
                } else {
                    swal('Atencion',data.msg,"error");
                }
            }
        }
    }
});    