
/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	var calendar,
		current_category_id,
		dialog_event,
		currentEvent,	// selected event object for update
		mode_update;	// flag

	$('body').niceScroll({
		scrollspeed: 100,
		mousescrollstep: 80,
		cursoropacitymin: 0.4
	});


	/* ------------ */
	/* FullCalendar */
	/* ------------ */

	// dialog for event update. preset currentEvent

	function updateEvent(event) {
		currentEvent = event;
		$('#event_title').val(currentEvent.title);
		$('#event_date').val($.fullCalendar.formatDate(currentEvent.start, 'yyyy-MM-dd'));

		// get event record from server

		$.ajax({
			type:	'post',
			url:	"ajax_getrecord",
			data:	{'id': currentEvent.id},
			dataType:	"json",
			success: function (data, dataType) {
				$('#event_detail').val(data.detail);
				$('#event_color').val(data.color).change();

				// open dialog
				dialog_event.dialog('option', 'title', 'Update event');
				$('#dialog-event').dialog('open');
			}
		});
	}

	// dialog for new event

	function addEvent(start) {
		$('#event_date').val($.fullCalendar.formatDate(start, 'yyyy-MM-dd'));
		$('#event_title').val('');
		$('#event_detail').val(null);
		dialog_event.dialog('option', 'title', 'New event');

		// open dialog

		$('#dialog-event').dialog('open');
		calendar.fullCalendar('unselect');
	}

	function initCalendar(element) {

		calendar = $(element).fullCalendar({
			header: {
	//			left: 'prev,next today', center: 'title', right: 'month,basicWeek',
				ignoreTimezone: false
			},
			editable: true,
			firstDay: 1, // 1:Monday
			selectable: true,
			selectHelper: true,
//			theme: true,	// use jquery ui theme

			titleFormat: {
				month: 'yyyy年 M月',
				week: '[yyyy年 ]M月 d日{ &#8212;[yyyy年 ][ M月] d日}',
				day: 'yyyy年 M月 d日 dddd'
			},

			// get events / json

			events: {
				url: "ajax_loadevent",
				data : {'calendarcategory_id': current_category_id}
			},

			// google holiday calendar(Japanese)

			eventSources: [
				{
					url: 'http://www.google.com/calendar/feeds/ja.japanese%23holiday%40group.v.calendar.google.com/public/basic',
					color: '#2c3e50', //'#f0e4e4',
					textColor: '#fff',
					editable: false,
					success: function (events) {
						$(events).each(function () {
							this.url = null;	// remove link
						});
					},
					error: function () {
						window.alert('there was an error while fetching events!');
					}
				}
			],

			// new event

			select: function (start, end, allDay, jsEvent, view) {

				addEvent(start);

				// initialize dialog items for new event

//				$('#event_date').val($.fullCalendar.formatDate(start, 'yyyy-MM-dd'));
//				$('#event_title').val('');
//				$('#event_detail').val(null);
//				dialog_event.dialog('option', 'title', 'New event');
//
//				// open dialog
//
//				$('#dialog-event').dialog('open');
//				calendar.fullCalendar('unselect');
			},

			// update event

			eventClick: function (event, jsEvent, view) {

				if (!$.isNumeric(event.id)) { return; } // skip google calender


				mode_update = true;

				updateEvent(event);
				// initialize dialog for update

//				$('.datepart').show();
//				$('#event_title').val(event.title);
//				$('#event_date').val($.fullCalendar.formatDate(event.start, 'yyyy-MM-dd'));
//
//				// get event record from server
//
//				$.ajax({
//					type:	'post',
//					url:	"ajax_getrecord",
//					data:	{'id': event.id},
//					dataType:	"json",
//					success: function (data, dataType) {
//						$('#event_detail').val(data.detail);
//						$('#event_color').val(data.color).change();
//
//						// open dialog
//						dialog_event.dialog('option', 'title', 'Update event');
//						$('#dialog-event').dialog('open');
//					}
//				});
			},

			// event droped

			eventDrop: function (event, delta, minuteDelta, allDay, revertFunc, jsEvent, ui, view) {

				$.post(
					"ajax_update",
					{
						'id': event.id,
						'start': $.fullCalendar.formatDate(event.start, 'yyyy-MM-dd'),
						'end': $.fullCalendar.formatDate(event.end, 'yyyy-MM-dd')
					},
					function () {
						calendar.fullCalendar('updateEvent', event);
					}
				);
			},

			eventResize: function (event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {

				$.post(
					"ajax_update",
					{
						'id': event.id,
						'start': $.fullCalendar.formatDate(event.start, 'yyyy-MM-dd'),
						'end': $.fullCalendar.formatDate(event.end, 'yyyy-MM-dd')
					},
					function () {
						calendar.fullCalendar('updateEvent', event);
					}
				);
			}
		});

	}	// function initCalendar

	/* ------------ */
	/*    Dialog    */
	/* ------------ */

	dialog_event = $("#dialog-event").dialog({
		resizable: false,
		modal: true,
		width: '420px',
		autoOpen: false,
		show: 'slide',

		buttons: {
			'OK': function () {

				if (!$('#event_title').val()) {
					window.alert('Title is empty.');
					return;
				}

				if (mode_update) {

					// update

					currentEvent.title = $('#event_title').val();
					currentEvent.start = $('#event_date').val();
					currentEvent.color = $('#event_color').val();
//					var id = currentEvent.id;
					$.post(
						"ajax_update",
						{
							'id': currentEvent.id,
							'title': currentEvent.title,
							'start': currentEvent.start,
							'color': currentEvent.color,
							'detail': $('#event_detail').val()
//							'calendarcategory_id': current_category_id
						},
						function (msg) {
							calendar.fullCalendar('updateEvent', currentEvent);
						}
					);

				} else {

					// new event

					var title = $('#event_title').val(),
						start = $('#event_date').val(),
						color = $('#event_color').val();
					$.post(
						"ajax_newevent",
						{
							'title': title,
							'start': start,
							'color': color,
							'detail':	$('#event_detail').val(),
							'calendarcategory_id': current_category_id
						},
						function (id) {
							if (id) {
								calendar.fullCalendar(
									'renderEvent',
									{
										id: id,
										title: title,
										start: start,
										color: color
									}
//									false // make the event "stick"
								);
							}
						}
					);
				}

				$(this).dialog('close');
			},
			Cancel: function () {
				$(this).dialog('close');
			},
			Delete: function () {
				if (!window.confirm("削除しますか？")) { return; }

				$.post("ajax_delete/" + currentEvent.id, null, function () {
					calendar.fullCalendar('removeEvents', currentEvent.id);
				});

				$(this).dialog('close');
			}
		},

		// initialize

		open: function (event, ui) {
			if (mode_update) {
				$('.ui-dialog-buttonpane').find('button:contains("Delete")').show();
			} else {
				$('.ui-dialog-buttonpane').find('button:contains("Delete")').hide();
			}
		},
		close: function (event, ui) {
			mode_update = false;
		}
	}); //dialog_event

	$(".categories").sortable({
//		cancel: 'a.addrecord',
		update: function () {
			var arr = $(this).sortable('toArray');
			$.post(
				'ajax_reorder',
				{
					idlist:	arr
				}
			);
		}
	});

	// select category

	$('a.categoryselector').click(function () {
		current_category_id = $(this).closest("[id^=cal-]").attr('id').replace('cal-', '');
		$('#calendarui').html('');
		$('.categoryselector').removeClass('active');
		$(this).addClass('active');
		initCalendar('#calendarui', current_category_id);
	});

	$('.categoryselector:eq(0)').click();

	// event colorpicker

	$('#event_color option').text('').each(function () {
		$(this).css('background-color', $(this).val());
	});
	$('#event_color').change(function () {
		$(this).find('option').text('');
		$(this).find('option:selected').text('✔');
//		var clr = $(this).find('option:selected').val();
//		$(this).css('background-color', clr);
		$(this).css('background-color', $(this).val());
	}).change();

});