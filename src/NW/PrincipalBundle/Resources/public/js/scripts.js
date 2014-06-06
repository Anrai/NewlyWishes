// As the page loads, call these scripts
jQuery(document).ready(function($) {
    
    /* Iniciar carrouseles */
    $('#bannersCarousel').carousel();

	// Link en una fila de una tabla
	$(".clickableRow").click(function() {
	    window.document.location = $(this).attr("href");
	});

	// Script que habilita/deshabilita edición de texto para la iglesia
	$(".boton-editar").click(function(){
		$(".form-form").removeClass("invisible");
		$(".text-form").addClass("invisible");
	});

	// Script que muestra descripción en modal de tareas del calendario de novios
	$(".tarea_link").click(function(){
		
		var mostrar = true;
		if(!$("#tarea_selected_"+$(this).attr("id")).hasClass("invisible"))
		{
			mostrar = false;
		}

		// Ocultar todo
		$(".desaparecible").addClass("invisible");

		if(mostrar)
		{
			$("#tarea_selected_"+$(this).attr("id")).removeClass("invisible");
			$("#tarea_descripcion_"+$(this).attr("id")).removeClass("invisible");
		}
	});

}); /* end of as page load scripts */