/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

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

				$('.widget-header span.title').text($('.categories .active').text());
//				reset();
			}
		);
	});

	// load first page

//	$('.categoryselector').eq(0).click();
	$('.categoryselector:eq(0)').click();

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
		if ($(this).text() === $(this).data('before')) {
			$(this).removeData('before');
			return;
		}
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

	// csv download

	$('#recordui').on('click', 'i.download', function () {
		location.href = 'download/' +
			$(this).closest("[id^=category-]").attr('id').replace('category-', '');
		return;

//		var category = $(this).closest("[id^=category-]").attr('id').replace('category-', '');
//		$.post(
//			'download',
//			{
//				'recordcategory_id': category.attr('id').replace('category-', '')
//			}
//		);
	});

	// event date for new item

	$('#recordui').on('focus', '.input_date', function () {
		$(this).datepicker({
			dateFormat: "yy-mm-dd",
			showButtonPanel: true,
			showAnim: 'show'
		}).data('before', $(this).val());
	});

	$('#recordui').on('change', '.input_date', function () {
		if (!window.confirm('日付を変更しますか？')) {
			$(this).val($(this).data('before')).datepicker("hide").data('before').remove();
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
		$('input.input_date').datepicker('destroy');
		$('.recordlist tbody').html(
			$('.recordlist tr').sort(function (a, b) {
				return $(a).find('input.input_date').val() < $(b).find('input.input_date').val() ? 1 : -1;
			})
		);
	});

	// focus event

	$('#recordui').on('focus', 'td.text', function () {
		$(this).data('before', $(this).html()).selectText();
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
		// tab
		if (e.which === 9) {
			e.preventDefault();
			if (e.shiftKey) {
				$(this).closest('tr').prev().find('.text').focus();
			} else {
				$(this).closest('tr').next().find('.text').focus();
			}
		}
		// down, enter
//		if (e.which === 13 || e.which === 40) {
//			e.preventDefault();
//			$(this).closest('tr').next().find('.text').focus();
//		}
		// escape
		if (e.which === 27) {
			e.preventDefault();
			$(this).html($(this).data('before'));
		}
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