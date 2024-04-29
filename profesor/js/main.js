(function () {
	"use strict";// Modo estricto de JavaScript para mejores prácticas

	var treeviewMenu = $('.app-menu');// Selecciona el elemento con clase 'app-menu'

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');// Alterna la clase 'sidenav-toggled' en el elemento con clase 'app'
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
