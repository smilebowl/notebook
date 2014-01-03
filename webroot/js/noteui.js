/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	$(".categories").sortable({
//		handle: "i.icon",
		cancel: 'a.addnote',
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

	function reset() {

		$('#noteui .widget').draggable({
//			handle: 'div.widget-header',
			handle: 'i.icon',
			stack: 'div.widget',
			stop: function (event, ui) {
				var allxyz = [], note_id, pos, curxyz;
				$('.widget').each(function () {
					note_id = $(this).attr('id').replace('note-', '');
					pos = $(this).position();
					curxyz = pos.left + '.' + pos.top + '.' + $(this).zIndex();
					allxyz.push({ 'id': note_id, 'xyz': curxyz });
				});
				$.post('ajax_allpositon', { 'allxyz': allxyz });
			}
		});

		$('.widget').resizable({
			minHeight: 80,
			minWidth: 160,
			stop: function (event, ui) {
				$.post('ajax_edit',	{
					'id':	$(this).attr('id').replace('note-', ''),
					'wh':	(ui.size.width + 1) + '.' + (ui.size.height + 1)
				});
			}
		});

//		$('.widget-header').disableSelection();
		$('.widget i').tooltip();
//		$('div.text').niceScroll();
	}

	// select category

	$('div.infobox a.categoryselector').click(function () {
		var category_id = $(this).closest("[id^=nc-]").attr('id').replace('nc-', ''),
			me = $(this);
		$.post(
			'getNotes',
			{
				'notecategory_id': category_id
			},
			function (html) {
				$('#noteui').html(html);
				reset();

				$('div.infobox a').removeClass('active');
				me.addClass('active');
			}
		);
	});

	// insert new item

	$('a.addnote').click(function () {
		var z, category = $('#noteui').find("[id^=category-]");
		if (category.length === 0) { return false; }
		$.post(
			'ajax_add',
			{
				'name': 'Note',
				'text': 'New Item.',
				'xyz': '0.0.10',
				'wh': '280.150',
				'notecategory_id': category.attr('id').replace('category-', '')
			},
			function (newitem) {
				$(newitem).hide().prependTo(category).fadeIn();
				reset();
			}
		);
	});

	$('.categoryselector').eq(0).click();




	// remove item

	$('#noteui').on('click', 'i.remove', function () {
		if (!window.confirm('削除しますか？')) {
			return false;
		}
		var note = $(this).closest("[id^=note-]");
		$.post(
			'ajax_delete',
			{
				'id': note.attr('id').replace('note-', '')
			},
			function (result) {
				if (result === "1") {
					note.fadeOut(
						'normal',
						function () {	note.remove('fast');	}
					);
				}
			}
		);
	});

	// td.text handling

	$('#noteui').on('focus', 'div[contenteditable]', function () {
		$(this).data('before', $(this).html());
	});

	// save text

	$('#noteui').on('blur', 'div[contenteditable]', function () {
		var note = $(this).closest("[id^=note-]");
		if ($(this).data('before') !== $(this).html()) {
			$.post(
				'ajax_edit',
				{
					'id': note.attr('id').replace('note-', ''),
					'text': $(this).html()
				}
			);
//			$(this).closest('.widget-content').height($(this).height());
		}
		$(this).removeData('before');
	});

	// reset format

	$('#noteui').on('click', 'i.formatreset', function () {
		if (!window.confirm('書式をクリアしますか？')) {
			return false;
		}
		var note = $(this).closest("[id^=note-]"), notetext;
		notetext = note.find('.text');
		notetext.text(notetext.text());
		$.post(
			'ajax_edit',
			{
				'id': note.attr('id').replace('note-', ''),
				'text': notetext.text()
			}
		);
	});

	// keyboard

	$('#noteui').on('keydown', 'div.text', function (e) {
		// escape
		if (e.which === 27) {
			e.preventDefault();
			$(this).html($(this).data('before'));
		}
	});

	// change title

	$('#noteui').on('blur', 'span.title', function () {
		var note = $(this).closest("[id^=note-]");
		$.post(
			'ajax_edit',
			{
				'id': note.attr('id').replace('note-', ''),
				'name': $(this).text()
			}
		);
		$(this).text($(this).text());
	});

});