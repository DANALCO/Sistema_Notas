document.addEventListener('DOMContentLoaded',function(){

    // Selecciona el formulario con id 'formEntrega' dentro del documento
    var formEntrega = document.querySelector('#formEntrega');
    // Cuando se envía el formulario, se ejecuta esta función
    formEntrega.onsubmit= function(e) {
        e.preventDefault(); // Previene el comportamiento predeterminado del formulario (enviar y recargar la página)
    
        // Obtiene el valor del campo de observación y del campo de archivo
        var observacion = document.querySelector('#observacion').value;
        var file = document.querySelector('#file').value;

        // Verifica si alguno de los campos está vacío o solo contiene espacios en blanco
        if(observacion.trim() == '' || file == '') {
            // Muestra una alerta de advertencia si hay campos vacíos
            swal('Atencion','Todos los campos son necesarios','error');
            return false; // Detiene el proceso de envío del formulario
        }
        
        // Crea un objeto XMLHttpRequest para enviar una solicitud HTTP asíncrona
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        // Especifica la URL a la que se enviará la solicitud POST
        var url = './models/entrega/ajax-entrega.php';
        // Crea un objeto FormData que representa el formulario 'formEntrega'
        var form = new FormData(formEntrega);
        // Abre la conexión HTTP con el método POST hacia la URL especificada de forma asíncrona
        request.open('POST',url,true);
        // Envía la solicitud HTTP con los datos del formulario
        request.send(form);
        // Se activa cuando cambia el estado de la solicitud HTTP
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                // Si la solicitud se completa y el estado es 200 (OK)
                // convierte el texto JSON en un objeto JavaScript
                //request.responseText: Es la respuesta devuelta por el servidor como texto
                var data = JSON.parse(request.responseText);
                // Verifica el estado devuelto en los datos recibidos
                if(data.status) {
                    // Si el estado es verdadero, muestra una alerta de éxito
                    swal({
                        title: "Evaluacion Entregada",
                        text: data.msg,
                        icon: "success",
                        button: true,
                      })
                    .then((willCreate) => {
                        // Si se hace clic en el botón de la alerta
                        if (willCreate) {
                            // Resetea el formulario
                            formEntrega.reset();
                            // Recarga la página
                            location.reload();
                        } 
                    });
                } else {
                    // Si el estado es falso, muestra una alerta de error
                    swal('Atencion',data.msg,"error");
                }
            }
        }
    }
});    