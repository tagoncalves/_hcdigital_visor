$(document).ready(function() {
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar').fullCalendar({
	    header: {
			left: 'prev,next today',
			center: 'title',
			right: 'agendaWeek,agendaDay'
		},
		allDaySlot: false,
		minTime: '07:00:00',
		maxTime: '21:00:00',
		slotDuration: '00:15:00',
		defaultView: 'agendaWeek',
		businessHours:
		{
			start: '9:00',
			end: '18:00',
			dow: [ 1, 2, 3, 4, 5 ]
		},
		//hiddenDays: [ 0, 6 ],
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			var title = prompt('Titulo del evento:');
			if (title) {
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end
						/*allDay: allDay*/
					},
				true // make the event "stick"
				);
			}
			calendar.fullCalendar('unselect');
		},
		editable: true,
		events: [
			{
				title: 'Ejemplo Corto',
				start: new Date(y, m, 1)
			},
			/*{
				title: 'Ejemplo Largo',
				start: new Date(y, m, d+5),
				end: new Date(y, m, d+7)
			},*/
			{
				id: 999,
				title: 'Ejemplo Repetitivo',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Ejemplo Repetitivo 2',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Ejemplo',
				start: new Date(y, m, d, 10, 30),
				end: new Date(y, m, d, 11, 0),
				allDay: false
			},
			/*{
				title: 'Ejemplo Largo 2',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},*/
			{
				title: 'Ejemplo Cumpleaños',
				start: new Date(y, m, d+9, 13, 0),
				end: new Date(y, m, d+9, 13, 30),
				allDay: false,
				constraint: 'turnos'
			},
			{
				title: 'Ejemplo Web',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://EGrappler.com/'
			},
			{
				id: 'turnos',
				start: new Date(y, m, d+7, 7, 0),
				end: new Date(y, m, d+7, 12, 0),
				rendering: 'background'
			},
			{
				id: 'turnos',
				start: new Date(y, m, d+9, 7, 0),
				end: new Date(y, m, d+9, 12, 0),
				rendering: 'background'
			}
		]
	});
	
	$('#txt-matricula').focusout(function(){
		
		var html = '';
		$.ajax({
			method : 'POST',
			dataType : 'json',
			url : 'turnos/getProfesional',
			data : {
				matricula : $(this).val()
			}
		}).done(function(turnos){		
			alert("llegue viteh"),
			$('#txt-profesional').val(turnos.apellido)
		});
	});
	
});