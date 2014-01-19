/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	var calendar, currentWorkdate;

	// get timelogs

	function getTimelog() {
		$.post(
			'getTimelogs',
			{
				'workdate': currentWorkdate
			},
			function (html) {
				$('#timelogui').html(html);
				$('.widget-header span.title').text(currentWorkdate);
			}
		);
	}

	function showOverlay() {
		$('.widget-content').addClass('overlay');
	}
	function hideOverlay() {
		$('.widget-content').removeClass('overlay');
	}

	// calendar

	calendar = $('#calendar').datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		onSelect: function () {
			currentWorkdate = $(this).val();
			getTimelog();
		}
	});
//	calendar.datepicker('setDate', 'today+1');

	// update timelog

	$('#timelogui').on('click', '#updateTimelog', function () {
//	$('#updateTimelog').click(function () {
		var timelogs = [], hasError, chkWorktime;
		hasError = false;
		$('table.timeloglist .input-error').removeClass('input-error');
		showOverlay();

		// check & make array for post

		$('table.timeloglist tr[id^=timelog-]').each(function () {

			chkWorktime = $(this).find("input[name=worktime]");
			// check
			if (!$.isNumeric(chkWorktime.val()) || parseFloat($(chkWorktime).val()) <= 0.00) {
				$(this).find("input[name=worktime]").addClass('input-error');
				window.alert('invalid worktime.');
				hasError = true;
				$(chkWorktime).focus();
				return false;
			}

			timelogs.push({
				'id': $(this).closest("[id^=timelog-]").attr('id').replace('timelog-', ''),
				'timelogcategory_id': $(this).find("select[name=timelogcategory_id]").val(),
				'timelogtask_id': $(this).find("select[name=timelogtask_id]").val(),
				'title': $(this).find("input[name=title]").val(),
				'worktime': $(this).find("input[name=worktime]").val(),
				'workdate': currentWorkdate
			});
		});

		if (hasError) { return false; }
		$(this).removeClass('btn-primary').addClass('btn-warning');

		$.ajax({
			type: 'post',
			url: "ajax_updateTimelog",
			data: {'Timelog': timelogs},
//			dataType:	"json",
			success: function (data, status, xhr) {
				getTimelog(); // reload
				hideOverlay();
			}
		});
	});

	// insert

	$('#timelogui').on('click', 'i.insert', function () {
		$.post(
			'ajax_getTemplate',
			{},
			function (newitem) {
				$(newitem).hide(); //.appendTo($('.timeloglist')).fadeIn();
				$('tr.total').before($(newitem));
				$(newitem).fadeIn();
//				$(newitem).hide().appendTo($('.timeloglist')).fadeIn();
			}
		);
	});

	// 再計算

	function reset_summary() {
		var total = 0.0;
		$('table.timeloglist tr[id^=timelog-]').each(function () {
			total += parseFloat($(this).find("input[name=worktime]").val());
		});
		$('table.timeloglist td.total_worktime').text(total.toFixed(2));
	}

	// remove timelog

	$('#timelogui').on('click', 'i.remove', function () {
		if (!window.confirm('削除しますか？')) {
			return false;
		}
		var timelog = $(this).closest("[id^=timelog-]");
		timelog.fadeOut('normal', function () {
			$.post(
				'ajax_delete',
				{
					'id': timelog.attr('id').replace('timelog-', '')
				}
			);
			timelog.remove();
			reset_summary();
		});
	});

	// toggle toolbox

	$('#timelogui').on('click', 'i.toggletool', function () {
		var visible = $(this).next('.toolbox').toggle().is(':visible');
		if (visible) {
			$(this).closest('.widget').find('.checkmark').show();
		} else {
			$(this).closest('.widget').find('.checkmark').hide();
		}
	});

	// toggle all checkbox

	$('#timelogui').on('click', 'input.tooglecheckall', function () {
		var cv = $(this).prop('checked');
		$(this).closest('.widget').find('.checkmark').prop('checked', cv);
	});

	// remove checked item

	$('#timelogui').on('click', 'i.removechecked', function () {
		if (!window.confirm('チェックしたアイテムを本当に削除しますか？')) {
			return false;
		}
		var chks, idlist = [];
		chks = $(this).closest('.widget').find('tr').has('.checkmark:checked');
		if (chks.length === 0) { return false; }
		chks.each(function () {
			idlist.push($(this).attr('id').replace('timelog-', ''));
			$(this).remove();
		});
		$.post(
			'ajax_deleteitems',
			{
				'items': idlist
			}
		);
		reset_summary();
		$(this).closest('.actions').find('i.toggletool').click();
	});

	// keyboard

	$('#timelogui').on('keydown', 'input', function (e) {
		// tab
//		if (e.which === 9) {
//			e.preventDefault();
//			if (e.shiftKey) {
//				$(this).closest('tr').prev().find('.timelog_worktime').focus();
//			} else {
//				$(this).closest('tr').next().find('.timelog_worktime').focus();
//			}
//		}
		// enter
//		if (e.which === 13) {
//			var inputs = $(this).parents("table").eq(0).find(":input"),
//				idx = inputs.index(this);
//			if (idx === inputs.length - 1) {
//				inputs[0].select();
//			} else {
//				inputs[idx + 1].focus();
//			}
//			return false;
//		}
		// down, enter
//		if (e.which === 13 || e.which === 40) {
//			e.preventDefault();
//			$(this).closest('tr').next().find('.text').focus();
//		}
		// escape
//		if (e.which === 27) {
//			e.preventDefault();
//			$(this).text($(this).data('before'));
//		}
		// up arrow
//		if (e.which === 38) {
//			e.preventDefault();
//			$(this).closest('tr').prev().find('.text').focus();
//		}
		// insert item into next posion
		if (e.which === 45 && !e.shiftKey) {
			e.preventDefault();
			$(this).closest('.widget').find('i.insert').click();
		}
	});

});