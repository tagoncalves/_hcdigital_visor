$('document').ready(function(){
	$("#antecedentes-table").tablesorter({
		sortList : [[0,0]],
		widgets: ["filter"],
		widgetOptions : {
			filter_childRows : false,
			filter_childByColumn : false,
			filter_childWithSibs : true,
			filter_columnFilters : true,
			filter_columnAnyMatch: true,
			filter_cellFilter : '',
			filter_cssFilter : '', // or []
			filter_defaultFilter : {},
			filter_excludeFilter : {},
			filter_external : '',
			filter_filteredRow : 'filtered',
			filter_formatter : null,
			filter_functions : null,
			filter_hideEmpty : true,
			/*filter_hideFilters : true,*/
			filter_ignoreCase : true,
			filter_liveSearch : true,
			filter_matchType : { 'input': 'exact', 'select': 'exact' },
			filter_onlyAvail : 'filter-onlyAvail',
			filter_placeholder : { search : '', select : '' },
			filter_resetOnEsc : true,
			filter_saveFilters : true,
			filter_searchDelay : 300,
			filter_searchFiltered: true,
			filter_selectSource  : null,
			filter_serversideFiltering : false,
			filter_startsWith : false,
			filter_useParsedData : false,
			filter_defaultAttrib : 'data-value',
			filter_selectSourceSeparator : '|'
		}
	});
	
	$('body').on('click','#btn-buscar',function(event){		
		event.preventDefault();
		var hc = $("#paciente-hc").val();	
		var nombre = $("#paciente-nombre").val().toUpperCase();	
		var dni = $("#paciente-dni").val();	
		
		$.ajax({
			type : 'POST',
			dataType : 'json',
			url : 'buscarPaciente',
			data :{
				'hc' : hc,
				'nombre' : nombre,
				'dni' : dni
			},
			cache :  false		
		}).done(function(data) {	
			$('#resPaciente tbody').empty();
			$('#antecedentes-table tbody').empty();
			if(data["pacientes"] != null){
				var html = "";
				$.each(data["pacientes"] , function(i, item) { 
					html = '<tr data-hc="' + item[2] + '"><td>' + item[2] + '</td><td>' + item[0] + '</td><td>' + item[1] + '</td></tr>';
					$('#resPaciente tbody').append(html);
				}); 				
			}				
		});
	});
	
	$('body').on('click','#resPaciente tbody tr',function(){		
		$("#resPaciente tbody tr").css( "font-weight", "" );
		$(this).css( "font-weight", "bold" );
		var hc = $(this).data('hc');
		$("#paciente-hc").val(hc);
		cargarAntecedentes(hc);
	});
	
	$('body').on('click','#btn-cerrar-antecedente',function(){		
		$('#visorAnt .widget-header h3').html("");
		$('#visorAnt .widget-content').html("");
		$('#visorAnt').hide();
	});
});

function solicitudesEstudios(hc) {
	$(".abrirResultado").unbind("click");
	$(".openPDF").unbind("click");
	$(".abrirInforme").unbind("click");
	$(".abrirArchivo").unbind("click");
	$(".abrirAntecedente").unbind("click");
  
	//hc = "218617";
	$.ajax({
	  url: "estudios/getEstudiosPaciente/" + hc,
	  method: "POST",
	  dataType: "html",
	}).done(function (data) {
	  $("#estudiosTab").html(data);
	  $(".abrirResultado").bind("click", verResultadoEstudio);
	  $(".openPDF").bind("click", openPDF);
	  $(".abrirInforme").bind("click", abrirInforme);
	  $(".abrirArchivo").bind("click", abrirArchivo);
	  $(".abrirAntecedente").bind("click", abrirAntecedente);
  
	  $("#solicitudes").tablesorter();
	  $("#solicitudes").trigger("update");
	  $("#solicitudes").trigger("filterReset");
	});
  }

function cargarAntecedentes(hc){
	$('.abrirAntecedente').unbind('click');
	$('.abrirAdjunto').unbind('click');
	$('.abrirInforme').unbind('click');
	
	$.ajax({
		type : 'POST',
		dataType : 'json',
		url : 'cargarAntecedentesPac',
		data :{'hc' : hc},
		cache :  false		
	}).done( function(data) {	
		/*$('#antecedentes-table tbody').empty();
		$('.abrirAntecedente').unbind('click',abrirAntecedente);
		$('.abrirAdjunto').unbind('click',abrirAdjunto);
		
		if(data["antecedentes"] != null){
			var html = "";
			$.each(data["antecedentes"] , function(i, item) { 
				html = '<tr class="abrirAntecedente" data-ingreso="' + item[5] + '" data-titulo="' + item[0] + ' - ' + item[4] + ' - ' + item[3] + '" ><td>' + item[0] + '</td><td>' + item[4] + '</td><td>' + item[2] + ' - ' + item[3] + '</td></tr>';
				$('#antecedentes-table tbody').append(html);
			}); 
		}
		if(data["archivos"] != null){
			var html = "";
			$.each(data["archivos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					html = '<tr class="abrirAntecedente" data-archivo="' + item["archivo"] + '" data-hc="' + hc + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Estudios Complementarios</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}
		if(data["adjuntos"] != null){
			var html = "";
			$.each(data["adjuntos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					html = '<tr class="abrirAdjunto" data-archivo="/' + hc + "/" + item["archivo"] + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Documentos Adjuntos</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}
		
		if(data["antecedentes"] != null){
			var html = "";
			$.each(data["antecedentes"] , function(i, item) { 
				//console.log(item);
				fecha = item[0];
				fecha = fecha.substring(0,4) + "-" + fecha.substring(4,6) + "-" + fecha.substring(6,8);
				html = '<tr class="abrirAntecedente" data-sede="' + item[4] + '" data-servicio="' + item[1] + '" data-sector="' + item[5] + '" data-ingreso="' + item[3] + '" data-titulo="' + fecha + ' | ' + item[1] + ' | ' + item[2] + '" ><td>' + fecha + '</td><td>' + item[2] + '</td><td>' + item[1] + '</td></tr>';
				$('#antecedentes-table tbody').append(html);
			}); 
		}
		
		if(data["archivos"] != null){			
			var html = "";
			$.each(data["archivos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					html = '<tr class="abrirAntecedente" data-archivo="' + item["archivo"] + '" data-hc="' + hc + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Estudios Complementarios</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}
		
		if(data["adjuntos"] != null){
			var html = "";
			$.each(data["adjuntos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					html = '<tr class="abrirAdjunto" data-archivo="/' + hc + "/" + item["archivo"] + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Documentos Adjuntos</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}

		if(data["antecedentes_mamo"] != null){
			var html = "";
			$.each(data["antecedentes_mamo"], function(i, item) {
				if(item != ""){
					var arr = item.split("^");
					var prof = arr[2].split("-");
					html = '<tr class="abrirMamoHC" data-hc="' + hc + '" data-registro="' + arr[0] + '" data-matricula="' + prof[0].trim() + '"><td>' + arr[1] + '</td><td>' + arr[2] + '</td><td>' + arr[3] + '</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}
		
		$.ajax({
			type : 'POST',
			dataType : 'json',
			url : 'getInformesPac',
			data :{'hc' : hc},
			cache :  false		
		}).done( function(data) {
			
			if(data["ESTUDIOS"] != null){
				var html = "";
				$.each(data["ESTUDIOS"], function(i, item) {
					var fec = item[0].split("/");
					html = '<tr class="abrirInforme" data-id=' + item[3] + ' data-sec=' + item[4] + ' ><td>' + fec[2]+"-"+fec[1]+"-"+fec[0] + '</td><td>' + item[5] + '</td><td>' + item[1] + '</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}); 
			}
			
			
			$('.abrirAntecedente').bind('click',abrirAntecedente);
			$('.abrirAdjunto').bind('click',abrirAdjunto);
			$('.abrirInforme').bind('click',abrirInforme);
			$('#antecedentes-table').trigger('update');
			$('#antecedentes-table').trigger('filterReset');
			$('#frameAntecedentes').show();
		});	*/

		$('#antecedentes-table tbody').empty();
		$('.abrirAntecedente').unbind('click', abrirAntecedente);
		$('.abrirAdjunto').unbind('click', abrirAdjunto);
		$('.abrirMamoHC').unbind('click', abrirMamoHC);
		$('.abrirArchivo').unbind('click', abrirArchivo);
		
		console.log(data);
		
		if(data["antecedentes"] != null){
			var html = "";
			$.each(data["antecedentes"] , function(i, item) { 
				fecha = item[0];
				fecha = fecha.substring(0,4) + "-" + fecha.substring(4,6) + "-" + fecha.substring(6,8);
				html = '<tr class="abrirAntecedente" data-sede="' + item[4] + '" data-servicio="' + item[1] + '" data-sector="' + item[5] + '" data-ingreso="' + item[3] + '" data-titulo="' + fecha + ' | ' + item[1] + ' | ' + item[2] + '" ><td>' + fecha + '</td><td>' + item[2] + '</td><td>' + item[1] + '</td></tr>';
				$('#antecedentes-table tbody').append(html);
			}); 
		}
		
		if(data["archivos"] != null){			
			var html = "";
			$.each(data["archivos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					html = '<tr class="abrirAntecedente" data-archivo="' + item["archivo"] + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Estudios Complementarios</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}
		
		if(data["adjuntos"] != null){
			var html = "";
			$.each(data["adjuntos"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					// /' + hc + "/" + item["archivo"] + '
					html = '<tr class="abrirAdjunto" data-hc="' + hc + '" data-archivo="' + item["path"] + '" data-nombre="' + item["archivo"] + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Documentos Adjuntos</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}

		if(data["estudios"] != null){
			var html = "";
			$.each(data["estudios"], function(i, item) {
				if(item["archivo"] != "Thumbs.db"){
					// /' + hc + "/" + item["archivo"] + '
					html = '<tr class="abrirEstudio" data-hc="' + hc + '" data-archivo="' + item["path"] + '" data-nombre="' + item["archivo"] + '"><td>' + item["fecha"] + '</td><td>' + item["archivo"] + '</td><td>Documentos Adjuntos</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}

		if(data["antecedentes_mamo"] != null){
			var html = "";
			$.each(data["antecedentes_mamo"], function(i, item) {
				if(item != ""){
					var arr = item.split("^");
					var prof = arr[2].split("-");
					html = '<tr class="abrirMamoHC" data-hc="' + hc + '" data-registro="' + arr[0] + '" data-matricula="' + prof[0].trim() + '"><td>' + arr[1] + '</td><td>' + arr[2] + '</td><td>' + arr[3] + '</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}

		if(data["informes"] != null){
			var html = "";
			$.each(data["informes"], function(i, item) {
				html = '<tr class="abrirAdjunto" data-informe="' + item[3] + '" data-setor="' + item[4] + '"><td>' + item[0] + '</td><td>' + item[2] + '</td><td>' + item[1] + '</td></tr>';
				$('#antecedentes-table tbody').append(html);
			});
		}

		if(data["archivosant"] != null){
			var html = "";
			$.each(data["archivosant"], function(i, item) {
				html = '<tr class="abrirArchivo" data-filename="' + item[2].split("\\").slice(-1) + '" data-archivo="' + item[2] + '"><td>' + item[0] + '</td><td>' + item[1] + '</td><td>'+ item[2].split("\\").slice(-1) +'</td></tr>';
				$('#antecedentes-table tbody').append(html);
			}); 
		}
		
		$('.abrirAntecedente').bind('click', abrirAntecedente);
		$('.abrirAdjunto').bind('click', abrirAdjunto);
		$('.abrirMamoHC').bind('click', abrirMamoHC);
		$('.abrirArchivo').bind('click', abrirArchivo);
		$('#antecedentes-table').trigger('update');
		$('#antecedentes-table').trigger('filterReset');
		$('#frameAntecedentes').show();
	});
}

function abrirArchivo()
{
	var filename = $(this).data("filename");
	if (filename.substr(filename.length - 3).toUpperCase() == "PDF")
	{
		$.ajax({
			type : 'POST',
			dataType : 'html',
			url : 'PDFwithpath/',
			data: {
				'archivo' 	: $(this).data("archivo")
			},
			cache :  false
		}).done(function(html){	
			$('#visorAnt .widget-content').html(html);
			$('#visorAnt .widget-content').css('height', $(window).height() * 0.65);
			$('#visorAnt .widget-content').css('max-height', $(window).height() * 0.65);
			$('#volver-agenda').animate({left:0},"slow");
			$('#columna-agenda').hide("slow");
			$('#columna-paciente').attr("style",'margin-left:0;');
		
			$('#visorAnt').show("slow");
			
			$('#antecedentes-table').unblock();
		});
	}
	else
	{
		window.open("agenda/descargarArchivo/"+ $(this).data("hc") +"/"+ $(this).data("nombre"), '_blank');
	}
}

function abrirMamoHC(){
	var ingreso = $(this).data("registro");
	var hc = $(this).data("hc");
	var mat = $(this).data("matricula");

	$('#btnCloseModalMamo').unbind('click');

	$.ajax({
		type : 'POST',
		dataType : 'json',
		url : 'agenda/getAntecedenteMamo',
		data: {
			"hc" : hc,
			"registro" : ingreso,
			'matricula': mat,
			'visor' : "1"
		},
		cache :  false		
	}).done(function(data) {
		$('#myModalMamo').css('width', "650px");
		$('#myModalMamo').css('left', ($(window).width() / 2));
		$('#myModalMamo .modal-body').css('height', $(window).height() * 0.60);
		$('#myModalMamo .modal-body').css('max-height', $(window).height() * 0.60);		
		$('#myModalLabelMamo').html('<span style="color:black;">Paciente:</span> ' + data["paciente"][0] + ' - ' + data["paciente"][9]);
		$("#myModalMamo .modal-content .modal-body").html(data["body"]);
		$("#myModalMamo .modal-content .modal-footer").html(data["footer"]);		
		$('#myModalMamo').modal();

		$('#btnCloseModalMamo').bind('click', cerrarModalMamo);
	});
}

function abrirInforme(){
	var id = $(this).data('id');
	var sector = $(this).data('sec');
	
	$('#antecedentes-table').block({ message: 'Cargando...' });
	$("#myModal .modal-content .modal-body").html('');
	
	$.ajax({
		url: "/_hcdigital_desarrollo/estudios/getInforme/",
		method: "POST",
		dataType: "html",
		data: {
			'id' : id,
			'sector' : sector
		}
	}).done(function(html){
		$('#visorAnt').hide("slow");
		$('#visorAnt .widget-content').html(html);

		$('#visorAnt').show("slow");
		$('#antecedentes-table').unblock();
	});
}


function abrirAntecedente(){
	$('#antecedentes-table').block({ message: 'Cargando...' });
	
	//var hc = $(this).data('hc');
	var hc = $("#paciente-hc").val();
	var ingreso = $(this).data('ingreso');
	var archivo = $(this).data('archivo');
	//var informe = $(this).data('informe');
	var titulo = $(this).data('titulo');
	
	var sede = $(this).data('sede');
	var sector = $(this).data('sector');
	
	if(typeof $(this).data('servicio') === "undefined"){
		$.ajax({
			type : 'POST',
			dataType : 'html',
			url : 'PDF/',
			data: {
				'hc' 		: hc,
				'archivo' 	: archivo
			},
			cache :  false
		}).done(function(html){	
			$('#visorAnt .widget-header h3').html(titulo);
			$('#visorAnt .widget-content').html(html);
			$('#visorAnt .widget-content').css('height', $(window).height() * 0.65);
			$('#visorAnt .widget-content').css('max-height', $(window).height() * 0.65);
			$('#visorAnt').show("slow");
			$('#antecedentes-table').unblock();
		});
	}else{
		var servicio = $(this).data('servicio');
		servicio = servicio.split(" - ");
	
		if(servicio[0] != "35")
		{	
			$("#myModal .modal-content .modal-body").html('');
			
			
			if(ingreso != null){
				$.ajax({
					type : 'POST',
					dataType : 'html',
					url : 'cargarDiagnostico/' + ingreso,
					cache :  false,		
					data : {
						'sede' : sede,
						'sector' : sector
						
					}
				}).done(function(html){		
					$('#visorAnt .widget-header h3').html(titulo);
					$('#visorAnt .widget-content').html(html);
					$('#visorAnt .widget-content').css('height', '');
					$('#visorAnt .widget-content').css('max-height', $(window).height() * 0.65);
					$('#visorAnt').show("slow");
					$('#antecedentes-table').unblock();
				});

			}else{
				$.ajax({
					type : 'POST',
					dataType : 'html',
					url : 'PDF/',
					data: {
						'hc' 		: hc,
						'archivo' 	: archivo
					},
					cache :  false
				}).done(function(html){	
					$('#visorAnt .widget-header h3').html(titulo);
					$('#visorAnt .widget-content').html(html);
					$('#visorAnt .widget-content').css('height', $(window).height() * 0.65);
					$('#visorAnt .widget-content').css('max-height', $(window).height() * 0.65);
					$('#visorAnt').show("slow");
					$('#antecedentes-table').unblock();
				});
			}
		}
		else
		{
			abrirAntecedenteMamografia(ingreso);
		}
	}
}
function abrirEstudio() {
	//window.open("uploads" + $(this).data("archivo"), '_blank');
	if (
	  $(this)
		.data("nombre")
		.substr($(this).data("nombre").length - 3)
		.toUpperCase() == "PDF"
	) {
	  $.ajax({
		type: "POST",
		dataType: "html",
		url: "agenda/PDFestudio/",
		data: {
		  hc: $(this).data("hc"),
		  archivo: $(this).data("nombre"),
		},
		cache: false,
	  }).done(function (html) {
		$("#columna-antecedentes .widget-content").html(html);
		$("#columna-antecedentes .widget-content").css(
		  "height",
		  $(window).height() * 0.65
		);
		$("#columna-antecedentes .widget-content").css(
		  "max-height",
		  $(window).height() * 0.65
		);
		$("#volver-agenda").animate({ left: 0 }, "slow");
		$("#columna-agenda").hide("slow");
		$("#columna-paciente").attr("style", "margin-left:0;");
  
		$("#columna-antecedentes").show("slow");
  
		$("#antecedentes-table").unblock();
	  });
	} else {
	  window.open(
		"agenda/descargarArchivo/" +
		  $(this).data("hc") +
		  "/" +
		  $(this).data("nombre"),
		"_blank"
	  );
	}
  }

/*
function abrirAntecedente(){
	$('#antecedentes-table').block({ message: 'Cargando...' });
	
	$(".abrirAntecedente").css( "font-weight", "" );
	$(this).css( "font-weight", "bold" );
	
	var ingreso = $(this).data('ingreso');
	var archivo = $(this).data('archivo');
	var hc = $(this).data('hc');
	var titulo = $(this).data('titulo');
	 
	$("#myModal .modal-content .modal-body").html('');
	
	if(ingreso != null){
		$.ajax({
			type : 'POST',
			dataType : 'html',
			url : 'cargarDiagnostico/' + ingreso,
			cache :  false			
		}).done(function(html){
			$('#visorAnt .widget-header h3').html(titulo);
			$('#visorAnt .widget-content').html(html);			
			$('#antecedentes-table').unblock();
			$('#visorAnt').show();
		});
	}else{		
		$.ajax({
			type : 'POST',
			dataType : 'html',
			url : 'PDF/',
			data: {
				'hc' 		: hc,
				'archivo' 	: archivo
			},
			cache :  false			
		}).done(function(html){	
			$('#visorAnt .widget-header h3').html(titulo);
			$('#visorAnt .widget-content').html(html);			
			$('#antecedentes-table').unblock();
			$('#visorAnt').show();
		});
	}
}*/

function abrirAdjunto(){
    window.open("uploads" + $(this).data("archivo"), '_blank');
}