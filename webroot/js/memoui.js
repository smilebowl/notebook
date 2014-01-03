/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	$(".categories").sortable({
//		handle: "i.icon",
		cancel: 'a.addmemo',
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

		$('#memoui .widget').draggable({
//			handle: 'div.widget-header',
			handle: 'i.icon',
			stack: 'div.widget',
			stop: function (event, ui) {
				var allxyz = [], memo_id, pos, curxyz;
				$('.widget').each(function () {
					memo_id = $(this).attr('id').replace('memo-', '');
					pos = $(this).position();
					curxyz = pos.left + '.' + pos.top + '.' + $(this).zIndex();
					allxyz.push({ 'id': memo_id, 'xyz': curxyz });
				});
				$.post('ajax_allpositon', { 'allxyz': allxyz });
			}
		});

		$('.widget').resizable({
			minHeight: 80,
			minWidth: 160,
			stop: function (event, ui) {
				$.post('ajax_edit',	{
					'id':	$(this).attr('id').replace('memo-', ''),
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
			'getMemos',
			{
				'memocategory_id': category_id
			},
			function (html) {
				$('#memoui').html(html);
				reset();

				$('div.infobox a').removeClass('active');
				me.addClass('active');
			}
		);
	});

	// insert new item

	$('a.addmemo').click(function () {
		var z, category = $('#memoui').find("[id^=category-]");
		if (category.length === 0) { return false; }
		$.post(
			'ajax_add',
			{
				'name': 'Memo',
				'text': 'New memo.',
				'xyz': '0.0.10',
				'wh': '280.150',
				'memocategory_id': category.attr('id').replace('category-', '')
			},
			function (newitem) {
				$(newitem).hide().prependTo(category).fadeIn();
				reset();
			}
		);
	});

	$('.categoryselector').eq(0).click();




	// remove item

	$('#memoui').on('click', 'i.remove', function () {
		if (!window.confirm('削除しますか？')) {
			return false;
		}
		var memo = $(this).closest("[id^=memo-]");
		$.post(
			'ajax_delete',
			{
				'id': memo.attr('id').replace('memo-', '')
			},
			function (result) {
				if (result === "1") {
					memo.fadeOut(
						'normal',
						function () {	memo.remove('fast');	}
					);
				}
			}
		);
	});

	// td.text handling

	$('#memoui').on('focus', 'div[contenteditable]', function () {
		$(this).data('before', $(this).html());
	});

	// save text

	$('#memoui').on('blur', 'div[contenteditable]', function () {
		var memo = $(this).closest("[id^=memo-]");
		if ($(this).data('before') !== $(this).html()) {
			$.post(
				'ajax_edit',
				{
					'id': memo.attr('id').replace('memo-', ''),
					'text': $(this).html()
				}
			);
//			$(this).closest('.widget-content').height($(this).height());
		}
		$(this).removeData('before');
	});

	// reset format

	$('#memoui').on('click', 'i.formatreset', function () {
		if (!window.confirm('書式をクリアしますか？')) {
			return false;
		}
		var memo = $(this).closest("[id^=memo-]"), memotext;
		memotext = memo.find('.text');
		memotext.text(memotext.text());
		$.post(
			'ajax_edit',
			{
				'id': memo.attr('id').replace('memo-', ''),
				'text': memotext.text()
			}
		);
	});

	// keyboard

	$('#memoui').on('keydown', 'div.text', function (e) {
		// escape
		if (e.which === 27) {
			e.preventDefault();
			$(this).html($(this).data('before'));
		}
	});

	// change title

	$('#memoui').on('blur', 'span.title', function () {
		var memo = $(this).closest("[id^=memo-]");
		$.post(
			'ajax_edit',
			{
				'id': memo.attr('id').replace('memo-', ''),
				'name': $(this).text()
			}
		);
		$(this).text($(this).text());
	});

});