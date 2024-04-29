(function () {
	"use strict";
	// Selecciona el elemento con la clase 'app-menu' y lo asigna a la variable treeviewMenu
	var treeviewMenu = $('.app-menu');

	// Agrega un evento 'click' a los elementos con el atributo '[data-toggle="sidebar"]'
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault(); // Previene el comportamiento predeterminado del evento de clic
		$('.app').toggleClass('sidenav-toggled');// Alterna la clase 'sidenav-toggled' en el elemento con la clase 'app'
	});

	// Agrega un evento 'click' a los elementos con el atributo '[data-toggle="treeview"]'
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault(); // Previene el comportamiento predeterminado del evento de clic
		// Verifica si el elemento padre del elemento clickeado no tiene la clase 'is-expanded'
		if(!$(this).parent().hasClass('is-expanded')) {
			// Si es así, remueve la clase 'is-expanded' de todos los elementos con '[data-toggle="treeview"]'
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		// Alterna la clase 'is-expanded' en el elemento padre del elemento clickeado
		$(this).parent().toggleClass('is-expanded');
	});

})();
