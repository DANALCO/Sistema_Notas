(function () {
<<<<<<< HEAD
	"use strict";// Modo estricto de JavaScript para mejores prácticas

	var treeviewMenu = $('.app-menu');// Selecciona el elemento con clase 'app-menu'
=======
	"use strict";

	var treeviewMenu = $('.app-menu');
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
<<<<<<< HEAD
		$('.app').toggleClass('sidenav-toggled');// Alterna la clase 'sidenav-toggled' en el elemento con clase 'app'
=======
		$('.app').toggleClass('sidenav-toggled');
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

})();
