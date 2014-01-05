/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	$.datepicker.setDefaults($.datepicker.regional.ja);

	$(".categories").sortable({
//		handle: "i.icon",
		cancel: 'a.addrecord',
//		placeholder: 'sortable-placeholder',
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

	// for reload

	function reset_datepicker() {
		$('.inputdate').datepicker({
			dateFormat: "yy-mm-dd",
			showButtonPanel: true,
			showAnim: 'show'
//			currentText: 'Today'
		});
		$('span.actions').disableSelection();
		$('.widget-content td[contenteditable!=true]').disableSelection();
//		$('#ui-datepicker-div').hide();
	}

	function reset() {

		// set title
		$('.widget-header span.title').text($('.categories .active').text());
//		$('.widget-header').disableSelection();
		reset_datepicker();
//		$('.widget i').tooltip();
//		$('div.text').niceScroll();
	}

	// select category

	$('div.infobox a.categoryselector').click(function () {
		var category_id = $(this).closest("[id^=nc-]").attr('id').replace('nc-', ''),
			me = $(this);
		$.post(
			'getRecords',
			{
				'recordcategory_id': category_id
			},
			function (html) {
				$('#recordui').html(html);

				$('div.infobox a').removeClass('active');
				me.addClass('active');

				reset();
			}
		);
	});

	// load first page

	$('.categoryselector').eq(0).click();

	// insert

	$('#recordui').on('click', 'i.insert', function () {
		var category = $(this).closest("[id^=category-]");
		$.post(
			'ajax_add',
			{
				'title': 'New Item.',
				'recordcategory_id': category.attr('id').replace('category-', ''),
				'eventdate': $.datepicker.formatDate('yy-mm-dd', new Date())
			},
			function (newitem) {
				$(newitem).hide().prependTo(category.find('.recordlist')).fadeIn().find('.text').focus();
				$('tr').removeClass('active');
			}
		);
	});

	//edit title

	$('#recordui').on('focus', 'span.title', function () {
		$(this).data('before', $(this).text());
	});
	$('#recordui').on('blur', 'span.title', function () {
		var title = $(this).text(),
			category_id = $(this).closest("[id^=category-]").attr('id').replace('category-', '');
		if (title.length === 0) {
			window.alert('Not allow blunk.');
			$(this).text($(this).data('before')).removeData('before');
			return;
		}
		$(this).removeData('before');
		$('.categories .active').text(title);

		$.post(
			'ajax_edit_category',
			{
				'id': category_id,
				'name': $(this).text()
			}
		);
	});

	// remove item

	$('#recordui').on('click', 'i.remove', function () {
		if (!window.confirm('削除しますか？')) {
			return false;
		}
		var record = $(this).closest("[id^=record-]");
		$.post(
			'ajax_delete',
			{
				'id': record.attr('id').replace('record-', '')
			},
			function (result) {
				if (result === "1") {
					record.fadeOut(
						'normal',
						function () {	record.remove('fast');	}
					);
				}
			}
		);
	});

	// priority

	$('#recordui').on('dblclick', 'i.handle', function () {
		var flag = 1, record = $(this).closest("[id^=record-]");
		if (record.find('td.text').hasClass('high-priority')) {
			flag = 0;
		}
		record.find('td.text').toggleClass('high-priority');
		$.post(
			'ajax_edit',
			{
				'id': record.attr('id').replace('record-', ''),
				'priority': flag
			}
		);
	});

	// toggle toolbox

	$('#recordui').on('click', 'i.toggletool', function () {
		var visible = $(this).next('.toolbox').toggle().is(':visible');
		if (visible) {
			$(this).closest('.widget').find('.checkmark').show();
		} else {
			$(this).closest('.widget').find('.checkmark').hide();
		}
	});

	// toggle all checkbox

	$('#recordui').on('click', 'input.tooglecheckall', function () {
		var cv = $(this).prop('checked');
		$(this).closest('.widget').find('.checkmark').prop('checked', cv);
	});

	// reset format

	$('#recordui').on('click', 'i.formatreset', function () {
		if (!window.confirm('書式をクリアしますか？')) {
			return false;
		}
		var record = $(this).closest("[id^=record-]"), title;
		title = record.find('.text');
		title.text(title.text());
		$.post(
			'ajax_edit',
			{
				'id': record.attr('id').replace('record-', ''),
				'title': title.text()
			}
		);
	});

	// remove checked item

	$('#recordui').on('click', 'i.removechecked', function () {
		if (!window.confirm('チェックしたアイテムを本当に削除しますか？')) {
			return false;
		}
		var chks, idlist = [];
		chks = $(this).closest('.widget').find('tr').has('.checkmark:checked');
		if (chks.length === 0) { return false; }
		chks.each(function () {
			idlist.push($(this).attr('id').replace('record-', ''));
			$(this).remove();
		});
		$.post(
			'ajax_deleteitems',
			{
				'items': idlist
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});

	// event date for new item

	$('#recordui').on('focus', '.inputdate', function () {
		$(this).datepicker({dateFormat: "yy-mm-dd"});
	});

	$('#recordui').on('change', '.inputdate', function () {
		if (!window.confirm('日付を変更しますか？')) {
			return false;
		}
		var record = $(this).closest("[id^=record-]");

		$('tr').removeClass('active');
		$(this).closest('tr').addClass('active');

		$.post(
			'ajax_edit',
			{
				'id': record.attr('id').replace('record-', ''),
				'eventdate': $(this).val()
			}
		);
		// sort
		$('input.inputdate').datepicker('destroy');
		$('.recordlist tbody').html(
			$('.recordlist tr').sort(function (a, b) {
				var ee = $(a).find('input.inputdate').val();
				return $(a).find('input.inputdate').val() < $(b).find('input.inputdate').val() ? 1 : -1;
			})
		);
		reset_datepicker();
	});

	// focus event

	$('#recordui').on('focus', 'td.text', function () {
		$(this).data('before', $(this).html());
		//	log($(this).text());
	});

	// td.text handling

	$('#recordui').on('blur', 'td.text', function () {
		// changed
		var record = $(this).closest("[id^=record-]");
		if ($(this).data('before') !== $(this).html()) {
			$.post(
				'ajax_edit',
				{
					'id': record.attr('id').replace('record-', ''),
					'title': $(this).html()
				}
			);
		}
		$(this).removeData('before');
	});

	// keyboard

	$('#recordui').on('keydown', 'td.text', function (e) {
		// down, enter
//		if (e.which === 13 || e.which === 40) {
		if (e.which === 40) {
			e.preventDefault();
			$(this).closest('tr').next().find('.text').focus();
		}
		// escape
		if (e.which === 27) {
			e.preventDefault();
			$(this).text($(this).data('before'));
		}
		// up arrow
		if (e.which === 38) {
			e.preventDefault();
			$(this).closest('tr').prev().find('.text').focus();
		}
		// insert item into next posion
		if (e.which === 45 && !e.shiftKey) {
//		if (e.which === 45) {
			e.preventDefault();
			$(this).closest('.widget').find('i.insert').click();
//			$(this).closest('tr').find('i.insert').focus().click();
		}
	});

});