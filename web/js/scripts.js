// as the page loads, call these scripts
jQuery(document).ready(function($) {

	/* Scripts especiales de SoftwareFactory al cargar la página */
    
    /* Iniciar carrouseles */
    $('#bannersCarousel').carousel();
    
	/* Barra de navegación se vuelve semitransparente */
	$(window).scroll(function() {
        if($(window).scrollTop()>0)
		{
			$('.navbar').removeClass('alpha60');
		}
		else
		{
			$('.navbar').addClass('alpha60');
		}
	});

}); /* end of as page load scripts */