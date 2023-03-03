$("document").ready(function () {
  var timer;

  /*
	$.PostItAll.changeConfig('global', {
		randomColor : false,
		addNew : false,
		autoHideToolBar : true,
		askOnDelete : false,
		pasteHtml : false,
		htmlEditor : false,
		toolbar : true,
		removable : false,
		addArrow : 'all',
	});
	*/

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/getPregunta",
    cache: false,
  }).done(function (data) {
    if (data.pregunta != "") {
      swal({
        //title: '',
        text: data.pregunta,
        type: "question",
        width: 400,
        showCancelButton: true,
        confirmButtonColor: "#5cb85c",
        confirmButtonText: "Si",
        cancelButtonColor: "#d9534f",
        cancelButtonText: "No",
        allowOutsideClick: false,
      }).then(
        function () {
          if (data.comentario != "") {
            swal({
              title: "Complete la solicitud",
              text: "<p>" + data.comentario + "</p>",
              input: "text",
              inputAttributes: { autocapitalize: "off" },
              showCancelButton: false,
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#5cb85c",
              showLoaderOnConfirm: true,
              allowOutsideClick: false,
            }).then((result) => {
              if (result.trim() != "") {
                $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "agenda/setRespuesta",
                  cache: false,
                  data: {
                    res: 1,
                    txt: result,
                  },
                }).done(function (data) {
                  if (data.error == 0) {
                    swal({
                      text: "Se guardaron los datos correctamente",
                      type: "success",
                      confirmButtonText: "OK",
                      confirmButtonColor: "#5cb85c",
                      allowOutsideClick: false,
                    }).done();
                  } else {
                    swal({
                      title: "ERROR",
                      text:
                        "Debido a un error interno, no se pudo completar la operacion solicitada.",
                      type: "error",
                      confirmButtonText: "OK",
                      confirmButtonColor: "#d9534f",
                      allowOutsideClick: false,
                    }).done();
                  }
                });
              }
            });
          } else {
            $.ajax({
              type: "POST",
              dataType: "json",
              url: "agenda/setRespuesta",
              cache: false,
              data: {
                res: 1,
                txt: "",
              },
            }).done(function (data) {
              if (data.error == 0) {
                swal({
                  text: "Se guardaron los datos correctamente",
                  type: "success",
                  confirmButtonText: "OK",
                  confirmButtonColor: "#5cb85c",
                  allowOutsideClick: false,
                }).done();
              } else {
                swal({
                  title: "ERROR",
                  text:
                    "Debido a un error interno, no se pudo completar la operacion solicitada.",
                  type: "error",
                  confirmButtonText: "OK",
                  confirmButtonColor: "#d9534f",
                  allowOutsideClick: false,
                }).done();
              }
            });
          }
        },
        function (dismiss) {
          $.ajax({
            type: "POST",
            dataType: "json",
            url: "agenda/setRespuesta",
            cache: false,
            data: {
              res: 0,
              txt: "",
            },
          }).done(function (data) {
            if (data.error == 0) {
              swal({
                text: "Se guardaron los datos correctamente",
                type: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#5cb85c",
                allowOutsideClick: false,
              }).done();
            } else {
              swal({
                title: "ERROR",
                text:
                  "Debido a un error interno, no se pudo completar la operacion solicitada.",
                type: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#d9534f",
                allowOutsideClick: false,
              }).done();
            }
          });
        }
      );
    }
  });

  $(".input-append.date")
    .datepicker({ format: "dd/mm/yyyy" })
    .on("changeDate", function (ev) {
      $(this).blur();
      $(this).datepicker("hide");
    });

  $("#volver-agenda").click(function () {
    cerrarVisor();
  });

  $("#antecedentes-table").tablesorter({
    sortList: [[0, 1]],
    widgets: ["filter"],
    widgetOptions: {
      filter_childRows: false,
      filter_childByColumn: false,
      filter_childWithSibs: true,
      filter_columnFilters: true,
      filter_columnAnyMatch: true,
      filter_cellFilter: "",
      filter_cssFilter: "", // or []
      filter_defaultFilter: {},
      filter_excludeFilter: {},
      filter_external: "",
      filter_filteredRow: "filtered",
      filter_formatter: null,
      filter_functions: null,
      filter_hideEmpty: true,
      //filter_hideFilters : true,
      filter_ignoreCase: true,
      filter_liveSearch: true,
      filter_matchType: { input: "exact", select: "exact" },
      filter_onlyAvail: "filter-onlyAvail",
      filter_placeholder: { search: "", select: "" },
      filter_resetOnEsc: true,
      filter_saveFilters: true,
      filter_searchDelay: 300,
      filter_searchFiltered: true,
      filter_selectSource: null,
      filter_serversideFiltering: false,
      filter_startsWith: false,
      filter_useParsedData: false,
      filter_defaultAttrib: "data-value",
      filter_selectSourceSeparator: "|",
    },

    /*new DG.OnOffSwitch({
			el: '#chk-pendientes',
			height: 20,
			listener: filtroPendientes
		});*/
  });

  $("#problemas-table").tablesorter();
  $("#agenda-table").tablesorter({ sortList: [[3, 0]] });

  $("body").on(
    "click",
    "#agenda-table tbody tr td:not(:last-child)",
    function () {
      dejarDeLlamar();
      var ingreso = $(this).parent("tr").data("ingreso");
      var hc = $(this).parent("tr").data("hc");
      var id = $(this).parent("tr").data("id");
      var turno = $(this).parent("tr").data("turno");
      var registra = $(this).parent("tr").data("registra");
      var telemedicina = $(this).parent("tr").data("telemedicina");

      if (ingreso != "") {
        cargarPaciente(ingreso, hc, id, turno, registra, telemedicina);
      }
    }
  );

  // We can attach the `fileselect` event to all file inputs on the page
  $("body").on("change", ":file", function () {
    var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, "/").replace(/.*\//, "");
    input.trigger("fileselect", [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(":file").on("fileselect", function (event, numFiles, label) {
    var input = $(this).parents(".upload-group").find(":text"),
      log = numFiles > 1 ? numFiles + " files selected" : label;

    if (input.length) {
      input.val(log);
    } else {
      if (log) alert(log);
    }
  });

  $("body").on("click", "#limpiar-adjunto", function (event) {
    $("#js-upload-files,#appendedInputButtons").clearInputs(true);
  });

  $("body").on("click", "#mamoHC-tabs a", function (e) {
    e.preventDefault();
    $(this).tab("show");
  });

  $("body").on("change", ".chk-slide", function (event) {
    var id = $(this).data("id");
    var texto = $(this).data("texto");
    var fecha = $(this).data("fecha");
    var chk = $(this);
    var checked = chk.is(":checked");
    if (!checked) {
      swal({
        title: "<h3>&iquest;Desea desactivar problema?</h3>",
        text:
          "Esta acci&oacute;n dejar&aacute; el problema preexistente inactivo",
        type: "warning",
        width: 400,
        showCancelButton: true,
        confirmButtonColor: "#5cb85c",
        confirmButtonText: "Si",
        cancelButtonColor: "#d9534f",
        cancelButtonText: "No",
        allowOutsideClick: false,
      }).then(
        function () {
          guardarProblema(id, checked ? "1" : 0, false, fecha, texto);
        },
        function (dismiss) {
          // dismiss can be 'cancel', 'overlay', 'close', 'timer'
          if (dismiss === "cancel") {
            chk.prop("checked", true);
          }
        }
      );
    } else {
      swal({
        title: "<h3>&iquest;Desea activar problema?</h3>",
        text:
          "Esta acci&oacute;n dejar&aacute; el problema preexistente activo",
        type: "warning",
        width: 400,
        showCancelButton: true,
        confirmButtonColor: "#5cb85c",
        confirmButtonText: "Si",
        cancelButtonColor: "#d9534f",
        cancelButtonText: "No",
        allowOutsideClick: false,
      }).then(
        function () {
          guardarProblema(id, checked ? "1" : 0, false, fecha, texto);
        },
        function (dismiss) {
          // dismiss can be 'cancel', 'overlay', 'close', 'timer'
          if (dismiss === "cancel") {
            chk.prop("checked", false);
          }
        }
      );
    }
  });

  $("body").on("click", "#btn-buscar-disponibilidad", function (event) {
    event.preventDefault();

    var desde = $("#fecha-desde").val();
    var hasta = $("#fecha-hasta").val();

    buscarDisponibilidad(desde, hasta);
  });

  $("body").on("click", "#btn-guardar-problema", function (event) {
    event.preventDefault();
    guardarProblema("", 1, true, "", "");
  });

  $("body").on("click", "#btn-cerrar-paciente", function (event) {
    event.preventDefault();
    cerrarPaciente();
  });

  $("body").on("click", "#btn-cerrar-visor", function (event) {
    event.preventDefault();
    cerrarVisor();
  });

  $("body").on("click", '#paciente button[name="volver"]', function () {
    cerrarPaciente();
  });

  $("body").on("click", '#diagnostico button[name="cancelar"]', function () {
    cerrarPaciente();
  });

  $("body").on("click", "#chk-pendientes", filtroPendientes);

  $("body").on("click", "#mamo-tratamiento", function () {
    if ($("#mamo-tratamiento").is(":checked")) {
      $("#grupoTratamientoMamo").attr("style", "");
      $("#grupoTratamientoMamo").show("slow");
    } else {
      $("#grupoTratamientoMamo").hide("slow");
    }
  });

  $("body").on("click", "#mamo-operaciones", function () {
    if ($("#mamo-operaciones").is(":checked")) {
      $("#campos-mamo-operacion").attr("style", "");
      $("#campos-mamo-operacion").show("slow");
    } else {
      $("#campos-mamo-operacion").hide("slow");
    }
  });

  $("body").on("click", "#mamo-punciones", function () {
    if ($("#mamo-punciones").is(":checked")) {
      $("#campos-mamo-puncion").attr("style", "");
      $("#campos-mamo-puncion").show("slow");
    } else {
      $("#campos-mamo-puncion").hide("slow");
    }
  });

  $("body").on("submit", "#form-diagnostico", grabarDiagnostico);
  $("body").on("submit", "#form-evolucionenf", grabarEnfermeria);
  $("body").on("submit", "#form-mamografia", grabarDiagnosticoMamografia);

  actualizarAgenda();
  timer = $.timer(25000, actualizarAgenda, true);

  $("body").on("click", "#btn-dar-turnos", function (event) {
    event.preventDefault();

    var ban = false;
    var msg = "";
    var errores = "";
    reg = $("#paciente-registra").val();

    $("#disponibilidad-table tbody tr").each(function () {
      ban = $(this).find("input[type='checkbox']").is(":checked");

      if (ban) {
        fecha = $(this).find("td:nth-child(2)").html();
        fecha = fecha.split("/").reverse().join("");
        hora = $(this).find("td:nth-child(3)").html();

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "turnos/grabarTurno",
          cache: false,
          async: false,
          data: {
            reg: reg,
            fecha: fecha,
            hora: hora,
          },
        }).done(function (data) {
          if (data == null) {
            errores =
              errores +
              "Se produjo un error al procesar la solicitud." +
              "<br />";
          } else {
            if (data.error != null) {
              errores = errores + data.error + "<br />";
            }

            if (data.MSG != null) {
              msg = msg + data.MSG + "<br />";
            }
          }
        });
      }
    });

    if (errores != "") {
      $("#msjTurError").html(errores);
      $("#msjTurError").show();
    }

    if (msg != "") {
      $("#msjTurMsg").html(msg);
      $("#msjTurMsg").show();
    }

    $("#btn-dar-turnos").attr("disabled", "true");
  });

  $("body").on("click", "#notas", function (event) {
    $.PostItAll.new({
      content: "Prueba de nota.",
      position: "fixed",
    });
  });

  $("body").on("click", "#dar-turno", function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "turnos/disponibilidad/",
      cache: false,
    }).done(function (html) {
      $("#myModal .modal-body").css("height", $(window).height() * 0.6);
      $("#myModal .modal-body").css("max-height", $(window).height() * 0.6);
      $("#myModalLabel").html("Turnos disponibles");
      $("#myModal .modal-content .modal-body").html(html);
      $('input[type="date"]')
        .datepicker({ format: "yyyy-mm-dd" })
        .on("changeDate", function (ev) {
          $(this).blur();
          $(this).datepicker("hide");
        });
      $("#myModal").modal();
    });
  });

  $("body").on("click", ".ver-hc", function (event) {
    event.preventDefault();
    cerrarPaciente();
    limpiarTodo();

    var ingreso = $(this).data("ingreso");
    var hc = $(this).data("hc");

    $("#agenda-table").block({ message: "Cargando..." });
    $("#datos-paciente").hide("fast");

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "agenda/cargarAntecedentesPac",
      data: { hc: hc },
      cache: false,
    }).done(function (data) {
      $("#antecedentes-table tbody").empty();
      $(".abrirAntecedente").unbind("click", abrirAntecedente);

      //console.log(data);
      var html = "";
      if (data.antecedentes != null) {
        html = "";
        $.each(data.antecedentes, function (i, item) {
          fecha = item[0];
          fecha =
            fecha.substring(0, 4) +
            "-" +
            fecha.substring(4, 6) +
            "-" +
            fecha.substring(6, 8);
          html =
            '<tr class="abrirAntecedente" data-sede="' +
            item[4] +
            '" data-servicio="' +
            item[1] +
            '" data-sector="' +
            item[5] +
            '" data-ingreso="' +
            item[3] +
            '" data-titulo="' +
            fecha +
            " | " +
            item[1] +
            " | " +
            item[2] +
            '" ><td>' +
            fecha +
            "</td><td>" +
            item[2] +
            "</td><td>" +
            item[1] +
            "</td></tr>";
          $("#antecedentes-table tbody").append(html);
        });
      }

      if (data.archivos != null) {
        html = "";
        $.each(data.archivos, function (i, item) {
          if (item.archivo != "Thumbs.db") {
            html =
              '<tr class="abrirAntecedente" data-archivo="' +
              item.archivo +
              '"><td>' +
              item.fecha +
              "</td><td>" +
              item.archivo +
              "</td><td>Estudios Complementarios</td></tr>";
            $("#antecedentes-table tbody").append(html);
          }
        });
      }

      if (data.adjuntos != null) {
        html = "";
        $.each(data.adjuntos, function (i, item) {
          if (item.archivo != "Thumbs.db") {
            html =
              '<tr class="abrirAdjunto" data-archivo="/' +
              hc +
              "/" +
              item.archivo +
              '"><td>' +
              item.fecha +
              "</td><td>" +
              item.archivo +
              "</td><td>Documentos Adjuntos</td></tr>";
            $("#antecedentes-table tbody").append(html);
          }
        });
      }

      if (data.informes != null) {
        html = "";
        $.each(data.informes, function (i, item) {
          html =
            '<tr class="abrirAdjunto" data-informe="' +
            item[3] +
            '" data-setor="' +
            item[4] +
            '"><td>' +
            item[0] +
            "</td><td>" +
            item[2] +
            "</td><td>" +
            item[1] +
            "</td></tr>";
          $("#antecedentes-table tbody").append(html);
        });
      }

      $("#form-diagnostico input[name='diag-hc']").val(hc);

      $(".abrirAntecedente").bind("click", abrirAntecedente);
      $(".abrirAdjunto").bind("click", abrirAdjunto);
      $("#antecedentes-table").trigger("update");
      $("#antecedentes-table").trigger("filterReset");
      $("#diag-menu li:not(#tab-antecedentes)").hide();
      $('#diag-menu a[href="#antecedentes"]').tab("show");
      $("#datos-paciente .widget-header h3").html("Historia Clinica");

      cargarPacienteLite(ingreso, hc);

      $("#datos-paciente").show("slow");
      $("#agenda-table").unblock();
    });
  });

  $("body").on("click", "#btn-llamar-paciente", function () {
    if ($("#btn-llamar-paciente").data("est") == "0") {
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "agenda/llamarPaciente",
        //data :{'comp' : $("#paciente").data('ingreso')},
        data: { comp: $("#form-diagnostico input[name='diag-ingreso']").val() },
        cache: false,
      }).done(function (data) {
        if (data == "0") {
          $("#btn-llamar-paciente").removeClass("btn-success");
          $("#btn-llamar-paciente").addClass("btn-danger");
          $("#btn-llamar-paciente").html("Dejar de Llamar");
          $("#btn-llamar-paciente").data("est", "1");

          swal({
            title: "LLAMANDO AL PACIENTE POR TURNERO",
            type: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#5cb85c",
            allowOutsideClick: false,
          }).done();
        } else {
          swal({
            title: "SE PRODUJO UN ERROR",
            text:
              "No se pudo llamar al paciente. Intente nuevamente mas tarde.",
            type: "error",
            confirmButtonText: "OK",
            confirmButtonColor: "#d9534f",
            allowOutsideClick: false,
          }).done();
        }
      });
    } else if ($("#btn-llamar-paciente").data("est") == "1") {
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "agenda/noLlamarPaciente",
        //data :{'comp' : $("#paciente").data('ingreso')},
        data: { comp: $("#form-diagnostico input[name='diag-ingreso']").val() },
        cache: false,
      }).done(function (data) {
        if (data == "0") {
          $("#btn-llamar-paciente").removeClass("btn-danger");
          $("#btn-llamar-paciente").addClass("btn-success");
          $("#btn-llamar-paciente").html("Llamar Paciente");
          $("#btn-llamar-paciente").data("est", "0");
          swal({
            title: "SE DEJO DE LLAMAR AL PACIENTE",
            type: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#5cb85c",
            allowOutsideClick: false,
          }).done();
        } else {
          swal({
            title: "SE PRODUJO UN ERROR",
            text:
              "No se pudo completar la accion solicitada. Intente nuevamente mas tarde.",
            type: "error",
            confirmButtonText: "OK",
            confirmButtonColor: "#d9534f",
            allowOutsideClick: false,
          }).done();
        }
      });
    } else {
      swal({
        title: "ERROR",
        text: "Recargue la pagina e intente nuevamente.",
        type: "error",
        confirmButtonText: "OK",
        confirmButtonColor: "#d9534f",
        allowOutsideClick: false,
      }).done();
    }
  });
});

function dejarDeLlamar() {
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "agenda/noLlamarPaciente",
    //data :{'comp' : $("#paciente").data('ingreso')},
    data: { comp: $("#form-diagnostico input[name='diag-ingreso']").val() },
    cache: false,
  }).done(function (data) {
    $("#btn-llamar-paciente").removeClass("btn-danger");
    $("#btn-llamar-paciente").addClass("btn-success");
    $("#btn-llamar-paciente").html("Llamar Paciente");
    $("#btn-llamar-paciente").data("est", "0");
    /*if(data["LLAMADO"] != "1"){
			swal({
				title: "SE PRODUJO UN ERROR",   
				text: "No se pudo completar la accion solicitada. Intente nuevamente mas tarde.",   
				type: "error",
				confirmButtonText: "OK",
				confirmButtonColor: "#d9534f",
				allowOutsideClick: false
			}).done();
		}*/
  });
}

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

function openPDF() {
  var hc = $("#hc").val();
  var archivo = $(this).data("url");

  $("#antecedentes-table").block({ message: "Cargando..." });
  $("#myModal .modal-content .modal-body").html("");

  $.ajax({
    url: "estudios/PDF/",
    method: "POST",
    dataType: "html",
    data: {
      hc: hc,
      archivo: archivo,
    },
  }).done(function (data) {
    /*$('#myModalLabelPDF').html("Archivo");
		//$('#myModalLabelPDF .modal-body').css('height', $(window).height() * 0.90);
		//$('#myModalLabelPDF .modal-body').css('max-height', $(window).height() * 0.90);	
		$("#myModalPDF .modal-content .modal-body").html(data);	
		$('#myModalPDF').modal();*/
    $("#columna-antecedentes .widget-content").html(data);
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
}

function abrirInforme() {
  var id = $(this).data("id");
  var sector = $(this).data("sector");

  $("#antecedentes-table").block({ message: "Cargando..." });
  $("#myModal .modal-content .modal-body").html("");

  $.ajax({
    url: "estudios/getInforme/",
    method: "POST",
    dataType: "html",
    data: {
      id: id,
      sector: sector,
    },
  }).done(function (html) {
    /*$('#myModalLabel').html("Informe");
		$("#myModal .modal-content .modal-body").html(html);	
		$('#myModal').modal();*/
    $("#columna-antecedentes .widget-content").html(html);
    $("#columna-antecedentes .widget-content").css("height", "");
    $("#columna-antecedentes .widget-content").css(
      "max-height",
      $(window).height() * 0.65
    );
    $("#columna-agenda").hide("slow");
    $("#columna-paciente").attr("style", "margin-left:0;");

    $("#columna-antecedentes").show("slow");
    $("#volver-agenda").animate({ left: 0 }, "slow");
    $("#antecedentes-table").unblock();
  });
}

function verResultadoEstudio() {
  var id = $(this).data("id");
  var estado = $(this).data("estado");

  $("#antecedentes-table").block({ message: "Cargando..." });
  $("#myModal .modal-content .modal-body").html("");

  if (estado !== "Pendiente") {
    $.ajax({
      url: "estudios/getResultado/" + id,
      method: "POST",
      dataType: "html",
    }).done(function (html) {
      /*$('#myModalLabel').html("Resultado de Laboratorio");
			$("#myModal .modal-content .modal-body").html(html);	
			$('#myModal').modal();*/

      $("#columna-antecedentes .widget-content").html(html);
      $("#columna-antecedentes .widget-content").css("height", "");
      $("#columna-antecedentes .widget-content").css(
        "max-height",
        $(window).height() * 0.65
      );
      $("#columna-agenda").hide("slow");
      $("#columna-paciente").attr("style", "margin-left:0;");

      $("#columna-antecedentes").show("slow");
      $("#volver-agenda").animate({ left: 0 }, "slow");
      $("#antecedentes-table").unblock();
    });
  }
}

function filtroPendientes() {
  if ($("#chk-pendientes").is(":checked")) {
    $("#agenda-table tbody tr.ok").addClass("oculto");
  } else {
    $("#agenda-table tbody tr.ok").removeClass("oculto");
  }
}
function abrirAntecedenteMamografia(ingreso) {
  $("#antecedentes-table").block({ message: "Cargando..." });

  $("#myModal .modal-content .modal-body").html("");

  if (ingreso != null) {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "agenda/cargarDiagnosticoMamografiaVisor/" + ingreso,
      cache: false,
    }).done(function (html) {
      $("#columna-antecedentes .widget-content").html(html);
      $("#columna-antecedentes .widget-content").css("height", "");
      $("#columna-antecedentes .widget-content").css(
        "max-height",
        $(window).height() * 0.65
      );
      $("#columna-agenda").hide("slow");
      $("#columna-paciente").attr("style", "margin-left:0;");

      $("#columna-antecedentes").show("slow");
      $("#volver-agenda").animate({ left: 0 }, "slow");
      $("#antecedentes-table").unblock();
    });
  }
}

function abrirAntecedente() {
  $("#antecedentes-table").block({ message: "Cargando..." });

  var ingreso = $(this).data("ingreso");
  var archivo = $(this).data("archivo");
  //var informe = $(this).data('informe');
  var hc = $("#form-diagnostico input[name='diag-hc']").val();
  var titulo = $(this).data("titulo");

  var sede = $(this).data("sede");
  var sector = $(this).data("sector");

  if (typeof $(this).data("servicio") === "undefined") {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "agenda/PDF/",
      data: {
        hc: hc,
        archivo: archivo,
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
    var servicio = $(this).data("servicio");
    servicio = servicio.split(" - ");

    if (servicio[0] != "35") {
      $("#myModal .modal-content .modal-body").html("");

      if (ingreso != null) {
        $.ajax({
          type: "POST",
          dataType: "html",
          url: "agenda/cargarDiagnostico/" + ingreso,
          cache: false,
          data: {
            sede: sede,
            sector: sector,
          },
        }).done(function (html) {
          $("#columna-antecedentes .widget-content").html(html);
          $("#columna-antecedentes .widget-content").css("height", "");
          $("#columna-antecedentes .widget-content").css(
            "max-height",
            $(window).height() * 0.65
          );
          $("#columna-agenda").hide("slow");
          $("#columna-paciente").attr("style", "margin-left:0;");

          $("#columna-antecedentes").show("slow");
          $("#volver-agenda").animate({ left: 0 }, "slow");
          $("#antecedentes-table").unblock();
        });
      } else {
        $.ajax({
          type: "POST",
          dataType: "html",
          url: "agenda/PDF/",
          data: {
            hc: hc,
            archivo: archivo,
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
      }
    } else {
      abrirAntecedenteMamografia(ingreso);
    }
  }
}

function abrirAdjunto() {
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
      url: "agenda/PDFadjunto/",
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

function abrirArchivo() {
  var filename = $(this).data("filename");
  if (filename.substr(-3).toUpperCase() == "PDF") {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "agenda/PDFwithpath/",
      data: {
        archivo: $(this).data("archivo"),
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

function isArray(obj) {
  return Object.prototype.toString.call(obj) === "[object Array]";
}

function actualizarAgenda() {
  var html = "";
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarAgenda",
    cache: false,
  }).done(function (turnos) {
    if (isArray(turnos)) {
      html = armarAgenda(turnos);
      $("#agenda-table tbody").html(html);
      //var sort = [[3,0]]; //fuerza el orden
      var sort = true; //actuliza con el orden actual
      $("#agenda-table").trigger("update", [sort]);
    }
  });
}

function armarAgenda(turnos) {
  var html = "";
  var clase = "";
  var icon = "";
  var tomado = $("#paciente").attr("data-ingreso");

  $.each(turnos, function (i, fila) {
    icon = "icon-circle";

    if (fila[5] != "") {
      if (fila[6]) {
        clase = "ok";
        if ($("#chk-pendientes").is(":checked")) {
          clase = "ok oculto";
        }
      } else {
        ultima = fila[0].substr(fila[0].length - 1);

        if (ultima != "0" && ultima != "5") {
          clase = "sobreturno";
        } else {
          if (fila[7] == "*") {
            clase = "espontaneo";
          } else {
            clase = "pendiente";
          }
        }
      }
    } else {
      clase = "no";
    }

    if (fila[5] == tomado) {
      coso = 'style="font-weight:bold;"';
    } else {
      coso = "";
    }

    //console.log(fila);

    html =
      html +
      "<tr " +
      coso +
      ' class="' +
      clase +
      '" data-turno="' +
      fila[2] +
      '" data-ingreso="' +
      fila[5] +
      '" data-hc="' +
      fila[4] +
      '"  data-id="' +
      fila[6] +
      '" data-registra="' +
      fila[8] +
      '"  data-telemedicina="' +
      fila[9] +
      '">';
    html = html + '<td class="col-xs-1"><span class="icono ' + icon + '">';
    if (fila[9] == "1") {
      html = html + '<span class="icon-desktop icon-telemedicina">';
    }

    html = html + "</span></td>";
    html =
      html +
      '<td class="col-xs-2">' +
      fila[4] +
      '</td><td class="col-xs-5">' +
      fila[1] +
      '</td><td class="col-xs-2">' +
      fila[0] +
      '</td><td class="col-xs-2">' +
      fila[3] +
      "</td>";
    html =
      html +
      '<td class="col-xs-1"><a href="#" class="ver-hc" data-ingreso="' +
      fila[5] +
      '" data-hc="' +
      fila[4] +
      '"><i class="icon-book" /></a></td>';
    html = html + "</tr>";
  });

  return html;
}

function cargarPaciente(ingreso, hc, id, turno, registra, telemedicina) {
  $("#agenda-table").block({ message: "Cargando..." });
  $("#datos-paciente").hide("fast");
  limpiarTodo();

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarDatosPac",
    data: {
      ingreso: ingreso,
      hc: hc,
    },
    cache: false,
  }).done(function (data) {
    $("#agenda-table tbody tr[data-ingreso!='" + ingreso + "']").css(
      "font-weight",
      "normal"
    );
    $("#agenda-table tbody tr[data-ingreso='" + ingreso + "']").css(
      "font-weight",
      "bold"
    );
    $("#paciente").attr("data-ingreso", data.saf);

    var nombre = data.ingreso[0];
    nombre = nombre.toLowerCase();
    nombre = nombre.replace(",", ", ");

    $("#datos-paciente .widget-header h3").html(hc + " - " + nombre);
    $("#paciente-nombre").val(data.ingreso[0]);
    $("#paciente-registra").val(registra);
    $("#paciente-entidad").val(data.ingreso[1] + " - " + data.ingreso[2]);
    $("#paciente-Afiliado").val(data.ingreso[10]);
    $("#paciente-nacimiento").val(data.ingreso[9]);
    $("#paciente-telefono").val(data.ingreso[7]);
    $("#paciente-documento").val(data.ingreso[8]);
    $("#paciente-edad").val(data.ingreso[3]);
    $("#paciente-email").val(data.ingreso[12]);
    $("#btn-llamar-paciente").data("hc", hc);

    $("#js-upload-form input[name='hc-adjuntos']").val(hc);
    $("#js-upload-form input[name='ingreso-adjuntos']").val(ingreso);
    $("#js-upload-form input[name='afiliado-adjuntos']").val(
      data.ingreso[10]
    );
    $("#js-upload-form input[name='entidad-adjuntos']").val(data.ingreso[1]);

    if (telemedicina == "1") {
      $(".frame-telemedicina").show();
      $("#frPacienteEmail").show();
    } else {
      $(".frame-telemedicina").hide();
      $("#frPacienteEmail").hide();
    }

    $("#rowPac2").css("display", "block");
    $("#datos-paciente").show("slow");
    $("#datos-ficha").show("slow");

    if ($("#userEnf").val() == "1") {
      $("#form-evolucionenf input[name='diag-hc']").val(hc);
      $("#form-evolucionenf input[name='diag-turno']").val(turno);
      $("#form-evolucionenf input[name='diag-ingreso']").val(ingreso);
      cargarEnfermeria(hc, turno, ingreso);
      cargarAntecedentes(hc, ingreso);
      solicitudesEstudios(hc);
    } else {
      cargarDiagnostico(ingreso, hc, id, turno);
      cargarMamografia(ingreso, hc, id, turno);
      solicitudesEstudios(hc);
      //SolEstudioView();
    }

    $("#agenda-table").unblock();
  });
}

function cargarEnfermeria(hc, turno, ingreso) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarEnfermeria",
    data: {
      ingreso: ingreso,
      hc: hc,
      turno: turno,
    },
    cache: false,
  }).done(function (data) {
    $("#diag-evolucion").val(data.evolucion);
  });
}

function SolEstudioView() {
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "estudios/ViewSolEstudios",
    cache: false,
  }).done(function (html) {
    $("#solicitudesTab").html(html);
    $(".tbSectores").bind("click", seleccionarSector);
    $(".agregarLabo").bind("click", agregarLabo);
    $(".agregarEstudio").bind("click", agregarEstudio);
    $("#btnGuardarSolicitud").bind("click", guardarSolicitudEstudios);
  });
}

function ocultarSecSolicitudes() {
  $("[name='solLaboratorio']").css("display", "none");
  $("[name='solECO']").css("display", "none");
  $("[name='solRX']").css("display", "none");
  $("[name='solTAC']").css("display", "none");
  $("[name='solRESO']").css("display", "none");
}

function seleccionarSector() {
  ocultarSecSolicitudes();
  var sSector = $(this).data("sec");

  $(".tbSectores").removeClass("active");
  $(this).addClass("active");

  switch (sSector) {
    case "LABO":
      $("[name='solLaboratorio']").css("display", "block");
      break;
    case "ECO":
      $("[name='solECO']").css("display", "block");
      break;
    case "RX":
      $("[name='solRX']").css("display", "block");
      break;
    case "TAC":
      $("[name='solTAC']").css("display", "block");
      break;
    case "RESO":
      $("[name='solRESO']").css("display", "block");
      break;
  }
}

function agregarLabo() {}

function agregarEstudio() {}

function guardarSolicitudEstudios() {}

function cargarPacienteLite(ingreso, hc) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarDatosPac",
    data: {
      ingreso: ingreso,
      hc: hc,
    },
    cache: false,
  }).done(function (data) {
    $("#agenda-table tbody tr[data-ingreso!='" + ingreso + "']").css(
      "font-weight",
      "normal"
    );
    $("#agenda-table tbody tr[data-ingreso='" + ingreso + "']").css(
      "font-weight",
      "bold"
    );
    $("#paciente").attr("data-ingreso", data.saf);
    var nombre = data.ingreso[0];
    nombre = nombre.toLowerCase();
    nombre = nombre.replace(",", ", ");

    $("#datos-paciente .widget-header h3").html(hc + " - " + nombre);
    $("#paciente-nombre").val(data.ingreso[0]);
    //$("#paciente-registra").val(registra);
    $("#paciente-entidad").val(data.ingreso[1] + " - " + data.ingreso[2]);
    $("#paciente-Afiliado").val(data.ingreso[10]);
    $("#paciente-nacimiento").val(data.ingreso[9]);
    $("#paciente-telefono").val(data.ingreso[7]);
    $("#paciente-documento").val(data.ingreso[8]);
    $("#paciente-edad").val(data.ingreso[3]);

    $("#rowPac2").css("display", "none");

    $("#datos-paciente").show("slow");
    $("#datos-ficha").show("slow");
  });
}

function cargarDiagnostico(ingreso, hc, id, turno) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarDiagnosticoPac",
    data: {
      ingreso: ingreso,
      hc: hc,
      diagnostico: id,
      turno: turno,
    },
    cache: false,
  }).done(function (data) {
    $("#form-diagnostico input[name='diag-id']").val(data.id);
    $("#form-diagnostico input[name='diag-ingreso']").val(data.saf);
    $("#form-diagnostico input[name='diag-hc']").val(data.hc);
    $("#form-diagnostico input[name='diag-turno']").val(data.turno);
    //$("#motivoOp option[value='" + data.diagnostico[0] + "']").attr('selected','true');
    $("#motivoOp").val(data.diagnostico[0]);
    $("#diag-motivo").val(data.diagnostico[1]);
    $("#diag-diagnostico").val(data.diagnostico[3]);
    $("#diag-plan").val(data.diagnostico[2]);
    $("#diag-objetivos").val(data.diagnostico[4]);
    cargarAntecedentes(hc, ingreso);
    cargarProblemas(hc);
  });
}

function limpiaDiagnosticoMamografia() {
  $("#form-mamografia input[name='mamo-id']").val("");
  $("#form-mamografia input[name='mamo-ingreso']").val("");
  $("#form-mamografia input[name='mamo-hc']").val("");
  $("#form-mamografia input[name='mamo-turno']").val("");

  $("#mamo-diagnostico").html("");
  $("#mamo-antecedentes").html("");

  $("#mamo-hijos").prop("checked", false);
  $("#mamo-hormonas").prop("checked", false);
  $("#mamo-lactancia").prop("checked", false);
  $("#mamo-menopausia").prop("checked", false);

  $("#mamo-tratamiento").prop("checked", false);
  $("#mamo-tamoxifeno").prop("checked", false);
  $("#mamo-quimioterapia").prop("checked", false);
  $("#mamo-radioterapia").prop("checked", false);
  $("#mamo-acelerador").prop("checked", false);
  $("#mamo-neoadyuvancia").prop("checked", false);
  $("#mamo-otros").val("");

  $("#mamo-operaciones").prop("checked", false);
  $("#mamo-fecoper").val("");
  $("#mamo-operiz").prop("checked", false);
  $("#mamo-operder").prop("checked", false);

  $("#mamo-punciones").prop("checked", false);
  $("#mamo-puniz").prop("checked", false);
  $("#mamo-punder").prop("checked", false);
  $("#mamo-puncionObs").html("");
  $("#mamo-fecpun").val("");

  $("#campos-mamo-puncion").hide();
  $("#campos-mamo-operacion").hide();
  $("#grupoTratamientoMamo").hide();
}

function cargarMamografia(ingreso, hc, id, turno) {
  limpiaDiagnosticoMamografia();

  $('button[name="visorHcMamo"]').unbind("click");

  $("#form-mamografia input[name='mamo-id']").val(id);
  $("#form-mamografia input[name='mamo-ingreso']").val(ingreso);
  $("#form-mamografia input[name='mamo-hc']").val(hc);
  $("#form-mamografia input[name='mamo-turno']").val(turno);

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarDiagnosticoMamografia",
    data: {
      ingreso: ingreso,
      hc: hc,
      diagnostico: id,
      turno: turno,
    },
    cache: false,
  }).done(function (data) {
    /*$("#form-mamografia input[name='mamo-id']").val(data["id"]);
		$("#form-mamografia input[name='mamo-ingreso']").val(data["saf"]);
		$("#form-mamografia input[name='mamo-hc']").val(data["hc"]);
		$("#form-mamografia input[name='mamo-turno']").val(data["turno"]);*/
    if (data.diagnostico != null) {
      $("#mamo-diagnostico").html(data.diagnostico[0]);
      $("#mamo-antecedentes").html(data.diagnostico[1]);

      if (data.preguntas[0] == "1") {
        $("#mamo-hijos").prop("checked", true);
      } else {
        $("#mamo-hijos").prop("checked", false);
      }

      if (data.preguntas[3] == "1") {
        $("#mamo-hormonas").prop("checked", true);
      } else {
        $("#mamo-hormonas").prop("checked", false);
      }

      if (data.preguntas[1] == "1") {
        $("#mamo-lactancia").prop("checked", true);
      } else {
        $("#mamo-lactancia").prop("checked", false);
      }

      if (data.preguntas[4] == "1") {
        $("#mamo-menopausia").prop("checked", true);
      } else {
        $("#mamo-menopausia").prop("checked", false);
      }

      var tratamiento = data.preguntas[2].split("^");
      if (tratamiento[0] == "1") {
        $("#mamo-tratamiento").prop("checked", true);
      } else {
        $("#mamo-tratamiento").prop("checked", false);
      }

      if (tratamiento[1] == "1") {
        $("#mamo-tamoxifeno").prop("checked", true);
      } else {
        $("#mamo-tamoxifeno").prop("checked", false);
      }

      if (tratamiento[2] == "1") {
        $("#mamo-quimioterapia").prop("checked", true);
      } else {
        $("#mamo-quimioterapia").prop("checked", false);
      }

      if (tratamiento[3] == "1") {
        $("#mamo-radioterapia").prop("checked", true);
      } else {
        $("#mamo-radioterapia").prop("checked", false);
      }

      if (tratamiento[4] == "1") {
        $("#mamo-acelerador").prop("checked", true);
      } else {
        $("#mamo-acelerador").prop("checked", false);
      }

      if (tratamiento[5] == "1") {
        $("#mamo-neoadyuvancia").prop("checked", true);
      } else {
        $("#mamo-neoadyuvancia").prop("checked", false);
      }

      $("#mamo-otros").val(tratamiento[6]);

      var operacion = data.preguntas[6].split("^");
      if (operacion[0] == "1") {
        $("#mamo-operaciones").prop("checked", true);
      } else {
        $("#mamo-operaciones").prop("checked", false);
      }

      $("#mamo-fecoper").val(operacion[1]);

      if (operacion[2] == "1") {
        $("#mamo-operiz").prop("checked", true);
      } else {
        $("#mamo-operiz").prop("checked", false);
      }

      if (operacion[3] == "1") {
        $("#mamo-operder").prop("checked", true);
      } else {
        $("#mamo-operder").prop("checked", false);
      }

      var puncion = data.preguntas[5].split("^");
      if (puncion[0] == "1") {
        $("#mamo-punciones").prop("checked", true);
      } else {
        $("#mamo-punciones").prop("checked", false);
      }

      $("#mamo-fecpun").val(puncion[1]);

      if (puncion[2] == "1") {
        $("#mamo-puniz").prop("checked", true);
      } else {
        $("#mamo-puniz").prop("checked", false);
      }

      if (puncion[3] == "1") {
        $("#mamo-punder").prop("checked", true);
      } else {
        $("#mamo-punder").prop("checked", false);
      }

      $("#mamo-puncionObs").html(puncion[4]);

      if ($("#mamo-punciones").is(":checked")) {
        $("#campos-mamo-puncion").attr("style", "");
        $("#campos-mamo-puncion").show("slow");
      }

      if ($("#mamo-operaciones").is(":checked")) {
        $("#campos-mamo-operacion").attr("style", "");
        $("#campos-mamo-operacion").show("slow");
      }

      if ($("#mamo-tratamiento").is(":checked")) {
        $("#grupoTratamientoMamo").attr("style", "");
        $("#grupoTratamientoMamo").show("slow");
      }
      //$("#mamo-hijos").prop('checked', false);
      //$("#mamo-hijos").is(":checked")
    }

    $('button[name="visorHcMamo"]').bind("click", getAntecedenteMamo);
  });
}

function getAntecedenteMamo() {
  $("#btnGuardarMamoHC").unbind("click");
  $("#btnAddEstMamo").unbind("click");
  $("#btnCloseModalMamo").unbind("click");

  var ingreso = $("#form-mamografia input[name='mamo-ingreso']").val();
  var hc = $("#form-mamografia input[name='mamo-hc']").val();

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/getAntecedenteMamo",
    data: {
      hc: hc,
      registro: ingreso,
      matricula: "",
      visor: "0",
    },
    cache: false,
  }).done(function (data) {
    $("#myModalMamo").css("width", "650px");
    $("#myModalMamo").css("left", $(window).width() / 2);
    $("#myModalMamo .modal-body").css("height", $(window).height() * 0.6);
    $("#myModalMamo .modal-body").css("max-height", $(window).height() * 0.6);
    $("#myModalLabelMamo").html(
      '<span style="color:black;">Paciente:</span> ' +
        data.paciente[0] +
        " - " +
        data.paciente[9]
    );
    $("#myModalMamo .modal-content .modal-body").html(data.body);
    $("#myModalMamo .modal-content .modal-footer").html(data.footer);
    $("#myModalMamo").modal();

    $("#btnAddEstMamo").bind("click", setEstudioMamo);
    $("#btnGuardarMamoHC").bind("click", guardarMamoHC);
    $("#btnCloseModalMamo").bind("click", cerrarModalMamo);

    $(".input-append.date.mamo")
      .datepicker({ format: "dd/mm/yyyy" })
      .on("changeDate", function (ev) {
        $(this).blur();
        $(this).datepicker("hide");
      });
  });
}

function cerrarModalMamo() {
  if ($(this).data("visor") == "1") {
    $("#myModalMamo").modal("hide");
  } else {
    swal({
      title: "<h2>¡Atencion!</h2>",
      text:
        "Los cambios no guardados se perderan, ¿Esta seguro que desea cerrar?",
      type: "warning",
      width: 400,
      showCancelButton: true,
      confirmButtonColor: "#5cb85c",
      confirmButtonText: "Aceptar",
      cancelButtonColor: "#d9534f",
      cancelButtonText: "Cancelar",
      allowOutsideClick: false,
    })
      .then(function () {
        $("#myModalMamo").modal("hide");
      })
      .done();
  }
}

function setEstudioMamo() {
  var err = false;

  if ($("#mamoHC-fecEstudio").val() == "") {
    mostrarError("Debe ingresar fecha.");
    err = true;
  }

  if (err === false) {
    $(".quitarEstudioMamo").unbind("click");

    var fecha = $("#mamoHC-fecEstudio").val();
    var estudio = $("#cboEstudiosMamo").val();
    var mamaIzq = $("#cboMamaIzq").val();
    var mamaDer = $("#cboMamaDer").val();

    var html = "<tr><td>";
    html += fecha + "</td><td>";
    html += estudio + "</td><td>";
    html += mamaIzq + "</td><td>";
    html += mamaDer + "</td><td>";
    html +=
      '<i class="icon-minus quitarEstudioMamo" style="color: red; cursor: pointer;"></i></td></tr>';

    $("#estudiosMamografia > tbody").append(html);
    $("#mamoHC-fecEstudio").val("");
    $(".quitarEstudioMamo").bind("click", quitarEstudioMamo);
  }
}

function quitarEstudioMamo() {
  var row = $(this).parent().parent();
  var fecha = row.find("td:first").html();
  var tipo = row.find("td:nth-child(2)").html();
  var mamaIzq = row.find("td:nth-child(3)").html();
  var mamaDer = row.find("td:nth-child(4)").html();

  swal({
    title: "<h4>Eliminar el estudio:</h4>",
    text: fecha + " - " + tipo + " - Izq: " + mamaIzq + " - Der: " + mamaDer,
    type: "warning",
    width: 400,
    showCancelButton: true,
    confirmButtonColor: "#5cb85c",
    confirmButtonText: "Aceptar",
    cancelButtonColor: "#d9534f",
    cancelButtonText: "Cancelar",
    allowOutsideClick: false,
  })
    .then(function () {
      row.remove();
    })
    .done();
}

function guardarMamoHC() {
  var antecedentes = new Object({});
  var antQuien = new Object({});
  var antEstudioGenetico = new Object({});
  var antEstudioGeneticoFlia = new Object({});
  var formaClinica = new Object({});
  var puncionMama = new Object({});
  var cirugiaMama = new Object({});
  var estudios = new Array();

  // Familiares del antecedente
  antQuien.madre = $("#mamoHC-Madre").is(":checked");
  antQuien.padre = $("#mamoHC-Padre").is(":checked");
  antQuien.hermana = $("#mamoHC-Hermana").is(":checked");
  antQuien.hermano = $("#mamoHC-Hermano").is(":checked");
  antQuien.abuela = $("#mamoHC-Abuela").is(":checked");
  antQuien.abuelo = $("#mamoHC-Abuelo").is(":checked");
  antQuien.tios = $("#mamoHC-Tios").is(":checked");
  antQuien.primos = $("#mamoHC-Primos").is(":checked");
  antQuien.otros = $("#mamoHC-fliaOtros").val().toUpperCase();

  // Antecedentes Estudio Genetico
  if ($("#mamoHC-EstGenetico").is(":checked")) {
    antEstudioGenetico.cual_brca1 = $("#mamoHC-Brca1").is(":checked");
    antEstudioGenetico.cual_brca2 = $("#mamoHC-Brca2").is(":checked");
    antEstudioGenetico.cual_brcaOtro = $("#mamoHC-BrcaOtro")
      .val()
      .toUpperCase();
    antEstudioGenetico.motivo1 = $("#mamoHC-MotEG1").is(":checked");
    antEstudioGenetico.motivo2 = $("#mamoHC-MotEG2").is(":checked");
    antEstudioGenetico.motivo3 = $("#mamoHC-MotEG3").is(":checked");
    antEstudioGenetico.motivo4 = $("#mamoHC-MotEG4").is(":checked");
    antEstudioGenetico.motivoOtro = $("#mamoHC-BrcaOtroMot")
      .val()
      .toUpperCase();
  }

  // Antecedentes Estudio Genetico de familiar
  if ($("#mamoHC-EstGeneticoFlia").is(":checked")) {
    antEstudioGeneticoFlia.cual_brca1 = $("#mamoHC-Brca1Flia").is(":checked");
    antEstudioGeneticoFlia.cual_brca2 = $("#mamoHC-Brca2Flia").is(":checked");
    antEstudioGeneticoFlia.cual_brcaOtro = $("#mamoHC-BrcaOtroFlia")
      .val()
      .toUpperCase();
  }

  // Forma clinica
  formaClinica.fecha = $("#mamoHC-fecdiag").val();
  formaClinica.edad = $("#mamoHC-Edad").val();
  if (
    typeof $('input[name="optMamoFormaDiag"]:checked').val() === "undefined"
  ) {
    formaClinica.estado = "";
  } else {
    formaClinica.estado = $('input[name="optMamoFormaDiag"]:checked')
      .val()
      .toUpperCase();
  }
  formaClinica.otro_estado = $("#mamoHC-Formaotra").val().toUpperCase();

  // Asintomatico
  formaClinica.motFD1 = $("#mamoHC-MotFD1").is(":checked");
  formaClinica.motFD2 = $("#mamoHC-MotFD2").is(":checked");
  formaClinica.motFD3 = $("#mamoHC-MotFD3").is(":checked");
  formaClinica.motFD4 = $("#mamoHC-MotFD4").is(":checked");
  formaClinica.fd_otro = $("#mamoHC-FdOtro").val().toUpperCase();

  // Sintomatico
  formaClinica.motFD5 = $("#mamoHC-MotFD5").is(":checked");
  formaClinica.motFD6 = $("#mamoHC-MotFD6").is(":checked");
  formaClinica.motFD7 = $("#mamoHC-MotFD7").is(":checked");
  formaClinica.fd_otro2 = $("#mamoHC-FdOtro2").val().toUpperCase();

  // Puncion mama
  if (typeof $('input[name="optMamoAntPunc"]:checked').val() === "undefined") {
    puncionMama.estado = "";
  } else {
    puncionMama.estado = $('input[name="optMamoAntPunc"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optTipoPunc"]:checked').val() === "undefined") {
    puncionMama.tipo = "";
  } else {
    puncionMama.tipo = $('input[name="optTipoPunc"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optLocPunc"]:checked').val() === "undefined") {
    puncionMama.localizacion = "";
  } else {
    puncionMama.localizacion = $('input[name="optLocPunc"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optResPunc"]:checked').val() === "undefined") {
    puncionMama.resultado = "";
  } else {
    puncionMama.resultado = $('input[name="optResPunc"]:checked')
      .val()
      .toUpperCase();
  }

  puncionMama.fecha = $("#mamoHC-fecDiagPunc").val();
  puncionMama.otroRes = $("#txtResPunc").val().toUpperCase();

  // Cirugia mama
  if (typeof $('input[name="optCirAnt"]:checked').val() === "undefined") {
    cirugiaMama.estado = "";
  } else {
    cirugiaMama.estado = $('input[name="optCirAnt"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optTipoCir"]:checked').val() === "undefined") {
    cirugiaMama.tipo = "";
  } else {
    cirugiaMama.tipo = $('input[name="optTipoCir"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optResCong"]:checked').val() === "undefined") {
    cirugiaMama.congelacion = "";
  } else {
    cirugiaMama.congelacion = $('input[name="optResCong"]:checked')
      .val()
      .toUpperCase();
  }

  if (typeof $('input[name="optMamoPQ"]:checked').val() === "undefined") {
    cirugiaMama.pq = "";
  } else {
    cirugiaMama.pq = $('input[name="optMamoPQ"]:checked').val().toUpperCase();
  }

  cirugiaMama.fecha = $("#mamoHC-FecCir").val();
  cirugiaMama.otro_tipo = $("#txtTipoCir").val().toUpperCase();
  cirugiaMama.cong_otro = $("#txtResCong").val().toUpperCase();
  cirugiaMama.pq_otro = $("#txtMamoPQ").val().toUpperCase();

  // Estudios
  $("#estudiosMamografia tbody tr").each(function () {
    var estFecha = $(this).find("td:first").html();
    var estTipo = $(this).find("td:nth-child(2)").html();
    var estIzq = $(this).find("td:nth-child(3)").html();
    var estDer = $(this).find("td:nth-child(4)").html();

    estudios.push(Array(estFecha, estTipo, estIzq, estDer));
  });

  // Aca se junta la mugre
  if (typeof $('input[name="optMamoAnt"]:checked').val() === "undefined") {
    antecedentes.estado = "";
  } else {
    antecedentes.estado = $('input[name="optMamoAnt"]:checked')
      .val()
      .toUpperCase();
  }
  antecedentes.quien = antQuien;
  antecedentes.cancer_mama = $("#mamoHC-CancerMama").is(":checked");
  antecedentes.cancer_ovario = $("#mamoHC-CancerOvario").is(":checked");
  antecedentes.cancer_otro = $("#mamoHC-CancerOtro").val().toUpperCase();
  antecedentes.estudio_genetico = $("#mamoHC-EstGenetico").is(":checked");
  antecedentes.eg_detalle = antEstudioGenetico;
  antecedentes.eg_familiar = $("#mamoHC-EstGeneticoFlia").is(":checked");
  antecedentes.eg_flia_detalle = antEstudioGeneticoFlia;
  antecedentes.forma_clinica = formaClinica;
  antecedentes.puncion = puncionMama;
  antecedentes.cirugia = cirugiaMama;
  antecedentes.estudios = estudios;

  var registro = $('input[name="mamo-ingreso"]').val();
  var hc = $('input[name="mamo-hc"]').val();

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/grabaMamografiaHC",
    data: {
      reg: registro,
      hc: hc,
      datos: antecedentes,
    },
    cache: false,
  }).done(function (data) {
    if (data.ban) {
      mostrarOK("Se guardaron los cambios correctamente.");
      /*$('#btnGuardarMamoHC').prop('disabled', true);
			$('#btnGuardarMamoHC').removeClass('btn-success');
			$('#btnGuardarMamoHC').addClass('btn-default');*/
    } else {
      mostrarError(
        "Se produjo un error al grabar los datos.\nDescripcion: " + data.res
      );
    }
  });
}

function cargarAntecedentes(hc, ingreso) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarAntecedentesPac",
    data: {
      hc: hc,
      ingreso: ingreso,
    },
    cache: false,
  }).done(function (data) {
    $("#antecedentes-table tbody").empty();
    $(".abrirAntecedente").unbind("click", abrirAntecedente);
    $(".abrirAdjunto").unbind("click");
    $(".abrirMamoHC").unbind("click");
    //$('.abrirArchivo').unbind('click');

    var html = "";
    
    if (data.antecedentes != null) {
      html = "";
      $.each(data.antecedentes, function (i, item) {
        fecha = item[0];
        fecha =
          fecha.substring(0, 4) +
          "-" +
          fecha.substring(4, 6) +
          "-" +
          fecha.substring(6, 8);
        html =
          '<tr class="abrirAntecedente" data-sede="' +
          item[4] +
          '" data-servicio="' +
          item[1] +
          '" data-sector="' +
          item[5] +
          '" data-ingreso="' +
          item[3] +
          '" data-titulo="' +
          fecha +
          " | " +
          item[1] +
          " | " +
          item[2] +
          '" ><td>' +
          fecha +
          "</td><td>" +
          item[2] +
          "</td><td>" +
          item[1] +
          "</td></tr>";
        $("#antecedentes-table tbody").append(html);
      });
    }

    if (data.archivos != null) {
      html = "";
      $.each(data.archivos, function (i, item) {
        if (
          item.archivo != "Thumbs.db" &&
          item.archivo.split("_")[0] != "IP"
        ) {
          html =
            '<tr class="abrirAntecedente" data-archivo="' +
            item.archivo +
            '"><td>' +
            item.fecha +
            "</td><td>" +
            item.archivo +
            "</td><td>Estudios Complementarios</td></tr>";
          $("#antecedentes-table tbody").append(html);
        }
      });
    }

    if (data.adjuntos != null) {
      html = "";
      $.each(data.adjuntos, function (i, item) {
        if (item.archivo != "Thumbs.db") {
          ///' + hc + "/" + item.archivo + '
          html =
            '<tr class="abrirAdjunto" data-hc="' +
            hc +
            '" data-archivo="' +
            item.path +
            '" data-nombre="' +
            item.archivo +
            '"><td>' +
            item.fecha +
            "</td><td>" +
            item.archivo +
            "</td><td>Documentos Adjuntos</td></tr>";
          $("#antecedentes-table tbody").append(html);
        }
      });
    }

    if (data.estudios != null) {
      html = "";
      $.each(data.estudios, function (i, item) {
        if (item.archivo != "Thumbs.db") {
          ///' + hc + "/" + item.archivo + '
          html =
            '<tr class="abrirEstudio" data-hc="' +
            hc +
            '" data-archivo="' +
            item.path +
            '" data-nombre="' +
            item.archivo +
            '"><td>' +
            item.fecha +
            "</td><td>" +
            item.archivo +
            "</td><td>Documentos Adjuntos</td></tr>";
          $("#antecedentes-table tbody").append(html);
        }
      });
    }

    if (data.antecedentes_mamo != null) {
      html = "";
      $.each(data.antecedentes_mamo, function (i, item) {
        if (item != "") {
          var arr = item.split("^");
          var prof = arr[2].split("-");
          html =
            '<tr class="abrirMamoHC" data-hc="' +
            hc +
            '" data-registro="' +
            arr[0] +
            '" data-matricula="' +
            prof[0].trim() +
            '"><td>' +
            arr[1] +
            "</td><td>" +
            arr[2] +
            "</td><td>" +
            arr[3] +
            "</td></tr>";
          $("#antecedentes-table tbody").append(html);
        }
      });
    }

    if (data.informes != null) {
      html = "";
      $.each(data.informes, function (i, item) {
        html =
          '<tr class="abrirAdjunto" data-informe="' +
          item[3] +
          '" data-setor="' +
          item[4] +
          '"><td>' +
          item[0] +
          "</td><td>" +
          item[2] +
          "</td><td>" +
          item[1] +
          "</td></tr>";
        $("#antecedentes-table tbody").append(html);
      });
    }

    /*if(data["archivosant"] != null){
			var html = "";
			$.each(data["archivosant"], function(i, item) {
				if(!item[2].split("\\").slice(-1).includes("IP_"))
				{
					html = '<tr class="abrirArchivo" data-filename="' + item[2].split("\\").slice(-1) + '" data-archivo="' + item[2] + '"><td>' + item[0] + '</td><td>' + item[2].split("\\").slice(-1) + '</td><td>'+ item[1] +'</td></tr>';
					$('#antecedentes-table tbody').append(html);
				}
			}); 
		}*/

    $(".abrirAntecedente").bind("click", abrirAntecedente);
    $(".abrirAdjunto").bind("click", abrirAdjunto);
    $(".abrirMamoHC").bind("click", abrirMamoHC);
    //$('.abrirArchivo').bind('click', abrirArchivo);
    $("#antecedentes-table").trigger("update");
    $("#antecedentes-table").trigger("filterReset");
  });
}

function abrirMamoHC() {
  var ingreso = $(this).data("registro");
  var hc = $(this).data("hc");
  var mat = $(this).data("matricula");

  $("#btnCloseModalMamo").unbind("click");

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/getAntecedenteMamo",
    data: {
      hc: hc,
      registro: ingreso,
      matricula: mat,
      visor: "1",
    },
    cache: false,
  }).done(function (data) {
    $("#myModalMamo").css("width", "650px");
    $("#myModalMamo").css("left", $(window).width() / 2);
    $("#myModalMamo .modal-body").css("height", $(window).height() * 0.6);
    $("#myModalMamo .modal-body").css("max-height", $(window).height() * 0.6);
    $("#myModalLabelMamo").html(
      '<span style="color:black;">Paciente:</span> ' +
        data.paciente[0] +
        " - " +
        data.paciente[9]
    );
    $("#myModalMamo .modal-content .modal-body").html(data.body);
    $("#myModalMamo .modal-content .modal-footer").html(data.footer);
    $("#myModalMamo").modal();

    $("#btnCloseModalMamo").bind("click", cerrarModalMamo);
  });
}

function cargarProblemas(hc) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/cargarProblemas",
    data: { hc: hc },
    cache: false,
  }).done(function (data) {
    $("#problemas-table tbody").empty();

    if (data.problemas != null) {
      var html = "";
      var fecha = "";

      $.each(data.problemas, function (i, item) {
        fecha = item[0];
        fecha =
          fecha.substring(6, 8) +
          "/" +
          fecha.substring(4, 6) +
          "/" +
          fecha.substring(0, 4);
        html =
          '<tr data-id="' +
          item[3] +
          '"><td>' +
          fecha +
          "</td><td>" +
          item[1] +
          '</td><td class="col-xs-1">';
        html =
          html +
          '<input id="chkbox' +
          item[3] +
          '" data-fecha="' +
          item[0] +
          '" data-texto="' +
          item[1] +
          '" data-id="' +
          item[3] +
          '" type="checkbox" ' +
          (item[2] == 1 ? "checked" : "") +
          ' class="chk-slide cmn-toggle cmn-toggle-round" /><label for="chkbox' +
          item[3] +
          '"></label>';
        html = html + "</td></tr>";
        $("#problemas-table tbody").append(html);
      });
      /*new DG.OnOffSwitchAuto({
				cls: '.chk-slide',
				height: 20,
				isCheckbox: true,
				listener : function(name, checked){
	
				}
			});*/
    }

    $("#problemas-table").trigger("update");
  });
}

function limpiarTodo() {
  $("#problemas-table tbody").html("");
  $("#antecedentes-table tbody").html("");
  $("#diag-menu li").show();
  $("#antecedentes-table tbody").empty();
  $("#diag-id").val("");
  $("#diag-ingreso").val("");
  $("#diag-hc").val("");
  $("#diag-turno").val("");
  $("#motivoOp option").removeAttr("selected");
  $("#diag-motivo").val("");
  $("#diag-diagnostico").val("");
  $("#diag-objetivos").val("");
  $("#diag-plan").val("");
  $("#paciente").removeAttr("data-ingreso");
  $("#paciente-nombre").val("");
  $("#paciente-entidad").val("");
  $("#paciente-afiliado").val("");
  $("#paciente-registra").val("");
  $("#paciente-nacimiento").val("");
  $("#paciente-edad").val("");
  $("#paciente-documento").val("");
  $("#fecha-problema").val("");
  $("#texto-problema").val("");

  $("#diag-menu a:first").tab("show");
}

function grabarEnfermeria() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/grabarEnfermeria",
    cache: false,
    data: $("#form-evolucionenf").serialize(),
  }).done(function (data) {
    if (data.ban == "0") {
      cerrarPaciente();
    } else {
      $("#form-evolucionenf").prepend(data.errores);
    }
  });
  return false;
}

function grabarDiagnostico() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/grabarDiagnostico",
    cache: false,
    data: $("#form-diagnostico").serialize(),
  }).done(function (data) {
    if (typeof data.errores == "undefined") {
      cerrarPaciente();
    } else {
      $("#form-diagnostico").prepend(data.errores);
    }
  });
  return false;
}

function grabarDiagnosticoMamografia() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/grabarDiagnosticoMamografia",
    cache: false,
    data: $("#form-mamografia").serialize(),
  }).done(function (data) {
    if (typeof data.errores == "undefined") {
      cerrarPaciente();
    } else {
      $("#form-mamografia").prepend(data.errores);
    }
  });
  return false;
}
function buscarDisponibilidad(desde, hasta) {
  $("#disponibilidad-table tbody").block({ message: "Cargando..." });

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "turnos/getDisponibilidad",
    cache: false,
    data: {
      "fecha-desde": desde,
      "fecha-hasta": hasta,
    },
  }).done(function (data) {
    if (data.turnos != null) {
      var html = "";
      $("#disponibilidad-table tbody").html("");
      $.each(data.turnos, function (i, item) {
        html =
          '<tr><td><input type="checkbox" name="turno' +
          i +
          '" /> </td><td>' +
          item[1] +
          "</td><td>" +
          item[2] +
          "</td><td>" +
          item[0] +
          ' " - " ' +
          item[3] +
          "</td><td>" +
          data.servicio +
          "</td></tr>";
        $("#disponibilidad-table tbody").append(html);
      });
    }
  });
  $("#disponibilidad-table tbody").unblock();
}

function cerrarPaciente() {
  dejarDeLlamar();
  cerrarVisor();
  limpiarTodo();
  $("#datos-paciente").hide("slow");
  $("#datos-ficha").hide("slow");
  $("#paciente").data("ingreso", "");
  actualizarAgenda();
}

function cerrarVisor() {
  $("#columna-antecedentes .widget-content").html("");
  $("#columna-agenda").show("slow");
  $("#columna-paciente").attr("style", "");
  $("#columna-antecedentes").hide("slow");
  $("#volver-agenda").animate({ left: -100 }, "slow");
}

function guardarProblema(id, estado, recargar, fecha, texto) {
  if (id == "") {
    fecha = $("input[name='fecha-problema']").val();
    fecha =
      fecha.substring(6, 10) + fecha.substring(3, 5) + fecha.substring(0, 2);
    texto = $("input[name='texto-problema']").val();
  }

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "agenda/grabarProblema",
    cache: false,
    data: {
      fecha: fecha,
      texto: texto,
      estado: estado,
      hc: $("input[name='diag-hc']").val(),
      id: id,
    },
  }).done(function (data) {
    if (typeof data.errores == "undefined") {
      if (recargar) {
        $("input[name='fecha-problema']").val("");
        $("input[name='texto-problema']").val("");
        cargarProblemas($("input[name='diag-hc']").val());
      }
    } else {
      $("#form-problemas").prepend(data.errores);
    }
  });
}

function mostrarError(sMSG) {
  // Sirve para no repetir codigo, muestra el mensaje que se le pase por parametro
  swal({
    title: "ERROR",
    text: sMSG,
    type: "error",
    confirmButtonText: "OK",
    confirmButtonColor: "#d9534f",
    allowOutsideClick: false,
  }).done();
}

function mostrarAdvertencia(sMSG) {
  // Sirve para no repetir codigo, muestra el mensaje que se le pase por parametro
  swal({
    title: "ATENCION",
    text: sMSG,
    type: "warning",
    confirmButtonText: "OK",
    confirmButtonColor: "#f0ad4e",
    allowOutsideClick: false,
  }).done();
}

function mostrarOK(sTitulo, sMSG) {
  // Sirve para no repetir codigo, muestra el mensaje que se le pase por parametro
  swal({
    title: sTitulo,
    text: sMSG,
    type: "success",
    confirmButtonText: "OK",
    confirmButtonColor: "#5cb85c",
    allowOutsideClick: false,
  }).done();
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if (new Date().getTime() - start > milliseconds) {
      break;
    }
  }
}
