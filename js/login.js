<<<<<<< HEAD
<<<<<<< HEAD
$(document).ready(function () {
    // Asigna el evento click al botón de login de usuario
    $('#loginUsuario').on('click', function () {
        loginUsuario();// Llama a la función loginUsuario al hacer clic en el botón
    });
    // Asigna el evento click al botón de login de profesor
    $('#loginProfesor').on('click', function () {
        loginProfesor();// Llama a la función loginProfesor al hacer clic en el botón
    });
    // Asigna el evento click al botón de login de alumno
    $('#loginAlumno').on('click', function () {
        loginAlumno();// Llama a la función loginAlumno al hacer clic en el botón
    });
})

// Función para realizar el login de usuario
function loginUsuario() {
    var login = $('#usuario').val();// Obtiene el valor del campo de usuario
    var pass = $('#pass').val();// Obtiene el valor del campo de contraseña
    // Realiza una petición AJAX para enviar los datos al archivo loginUsuario.php
    $.ajax({
        url: './includes/loginUsuario.php',// URL del archivo PHP que maneja el login de usuario
        method: 'POST',// Método HTTP utilizado para la solicitud
        data: {// Datos enviados al servidor
            login: login,// Nombre de usuario
            pass: pass// Contraseña
        },
        success: function (data) {// Función que se ejecuta si la solicitud tiene éxito
            $('#messageUsuario').html(data);// Muestra la respuesta del servidor en un elemento HTML con id messageUsuario
            // Redirecciona a la página de administrador si el servidor devuelve 'Redirecting'
            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'administrador/';// Redirecciona al usuario a la página de administrador
            }
        }
    })
}
// Función para realizar el login de profesor
function loginProfesor() {
    var loginProfesor = $('#usuarioProfesor').val();// Obtiene el valor del campo de usuario de profesor
    var passProfesor = $('#passProfesor').val();// Obtiene el valor del campo de contraseña de profesor
    // Realiza una petición AJAX para enviar los datos al archivo loginProfesor.php
    $.ajax({
        url: './includes/loginProfesor.php',// URL del archivo PHP que maneja el login de profesor
        method: 'POST',// Método HTTP utilizado para la solicitud
        data: {// Datos enviados al servidor
            loginProfesor: loginProfesor,// Nombre de usuario de profesor
            passProfesor: passProfesor// Contraseña de profesor
        },
        success: function (data) {// Función que se ejecuta si la solicitud tiene éxito
            $('#messageProfesor').html(data);// Muestra la respuesta del servidor en un elemento HTML con id messageProfesor
            // Redirecciona a la página de profesor si el servidor devuelve 'Redirecting'
            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'profesor/';// Redirecciona al usuario a la página de profesor
            }
        }
    })
}
// Función para realizar el login de alumno
function loginAlumno() {
    var loginAlumno = $('#usuarioAlumno').val();// Obtiene el valor del campo de usuario de alumno
    var passAlumno = $('#passAlumno').val();// Obtiene el valor del campo de contraseña de alumno
    // Realiza una petición AJAX para enviar los datos al archivo loginAlumno.php
    $.ajax({
        url: './includes/loginAlumno.php',
        method: 'POST',
        data: {
            loginAlumno: loginAlumno,
            passAlumno: passAlumno
        },
        success: function (data) {
            $('#messageAlumno').html(data);

            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'alumno/';
            }
        }
    })
=======
$(document).ready(function () {
    $('#loginUsuario').on('click', function () {
        loginUsuario();
    });
    $('#loginProfesor').on('click', function () {
        loginProfesor();
    });
})


function loginUsuario() {
    var login = $('#usuario').val();
    var pass = $('#pass').val();
    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data: {
            login: login,
            pass: pass
        },
        success: function (data) {
            $('#messageUsuario').html(data);

            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'administrador/';
            }
        }   
    })
}

function loginProfesor() {
    var loginProfesor = $('#usuarioProfesor').val();
    var passProfesor = $('#passProfesor').val();
    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data: {
            loginProfesor:loginProfesor,
            passProfesor:passProfesor
        },
        success: function (data) {
            $('#messageProfesor').html(data);

            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'profesor/';
            }
        }   
    })
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
$(document).ready(function () {
    $('#loginUsuario').on('click', function () {
        loginUsuario();
    });
    $('#loginProfesor').on('click', function () {
        loginProfesor();
    });
})


function loginUsuario() {
    var login = $('#usuario').val();
    var pass = $('#pass').val();
    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data: {
            login: login,
            pass: pass
        },
        success: function (data) {
            $('#messageUsuario').html(data);

            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'administrador/';
            }
        }   
    })
}

function loginProfesor() {
    var loginProfesor = $('#usuarioProfesor').val();
    var passProfesor = $('#passProfesor').val();
    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data: {
            loginProfesor:loginProfesor,
            passProfesor:passProfesor
        },
        success: function (data) {
            $('#messageProfesor').html(data);

            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'profesor/';
            }
        }   
    })
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
}