/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';


	$(".categories").sortable({
		cancel: 'a.addmemo',
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
//			handle: 'i.icon',
			handle: '.widget-header:not(.title)',
			stack: 'div.widget',
			containment: '#memoui',
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

		$('#memoui .widget').resizable({
			minHeight: 80,
			minWidth: 160,
			stop: function (event, ui) {
				$.post('ajax_edit',	{
					'id':	$(this).attr('id').replace('memo-', ''),
					'wh':	(ui.size.width + 1) + '.' + (ui.size.height + 1)
				});
			}
		});

		$('.widget i').tooltip();
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

	// load first
//	$('.categoryselector').eq(0).click();
	$('.categoryselector:eq(0)').click();


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
				memo.fadeOut('normal').closest('.norwwrapper').remove();
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

	// focus title

	$('#memoui').on('click', 'span.title', function () {
		$(this).data('before', $(this).text()).focus().selectText();
	});

	$('#memoui').on('blur', 'span.title', function () {
		if ($(this).text().length === 0) {
			$(this).text($(this).data('before')).removeData('before');
			return;
		}
		var memo = $(this).closest("[id^=memo-]");
		if ($(this).text() !== $(this).data('before')) {
			$.post(
				'ajax_edit',
				{
					'id': memo.attr('id').replace('memo-', ''),
					'name': $(this).text()
				}
			);
			$(this).text($(this).text());
		}
		$(this).removeData('before');
	});

});