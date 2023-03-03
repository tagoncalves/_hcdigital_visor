$(function () {
	$(document).ready(function(){
		$(".subnavbar").sticky({
			/* Calendar */
			topSpacing : 0,
			zIndex: 1000
		});
		
		$("#datos-paciente").sticky({
			/* Calendar */
			topSpacing : ($(window).height() <= 768 ? -93 : 93),
			bottomSpacing : 100,
			responsiveWidth: true,
			/*getWidthFrom: '#agenda',*/
			zIndex: 998
			
		});
		$("#datos-ficha").sticky({
			/* Calendar */
			topSpacing : ($(window).height() <= 768 ? -93 : 93),
			bottomSpacing : 100,
			responsiveWidth: true,
			/*getWidthFrom: '#agenda',*/
			zIndex: 998
			
		});
		//$("#datos-visor").sticky({
		//	/* Calendar */
		//	topSpacing : ($(window).height() <= 768 ? -93 : 93),
		//	bottomSpacing : 100,
		//	responsiveWidth: true,
		//	/*getWidthFrom: '#agenda',*/
		//	zIndex: 998
		//	
		//});*/
		
		$("#visorAnt").sticky({
			/* Calendar */
			topSpacing : 70,
			bottomSpacing : 100,
			responsiveWidth: true,
			zIndex: 998
			
		});
	});
	
	$('.subnavbar').find ('li').each (function (i) {
	
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
		
	});

	
	
	
});