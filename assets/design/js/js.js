$(document).ready(function($) {

	$('a#icon_for_menu').on('click', function(event) {
		event.preventDefault();
		
		$('#side_nav').animate({width:'toggle'},250);
		$('#backdrop').fadeIn();
	});

	$('#side_nav #close').on('click', function(event) {
		event.preventDefault();
		
		// $('#side_nav').animate({width:'toggle'},250);
		$('#side_nav').animate({width:'toggle'},250);
		$('#backdrop').fadeOut();
	});
	

	/// clicking panel title change plus to minus
	$('.panel-title a').each(function() {
		if ($(this).hasClass('collapsed')) 
			$(this).children('span').text('+');
		else $(this).children('span').text('-');
	});

	$('.panel-title a').on('click', function(event) {
		event.preventDefault();
		if ($(this).hasClass('collapsed')) 
			$(this).children('span').text('-');
		else $(this).children('span').text('+');
	});
});