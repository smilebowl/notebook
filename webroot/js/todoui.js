/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

//	$('.widget i, span.toolbox i').tooltip();

	$('body').niceScroll({
		scrollspeed: 100,
		mousescrollstep: 80,
		cursoropacitymin: 0.4
	});

	$(".todolist tbody").sortable({
		axis: 'y',
		handle: ".handle",
		placeholder: 'sortable-placeholder',
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
//	$('.todolist span.actions').disableSelection();
	$('.widget-content td[contenteditable!=true]').disableSelection();
	$('.widget span.actions').disableSelection();

	$(".todoui").sortable({
		handle: "i.icon",
//		placeholder: 'sortable-placeholder',
		update: function () {
			var arr = $(this).sortable('toArray');
			$.post(
				'ajax_reorder_category',
				{
					idlist:	arr
				}
			);
		}
	});

	// insert new item

	$('div.widget').on('click', 'i.insert', function () {
		var category = $(this).closest("[id^=category-]");
		$.post(
			'ajax_add',
			{
				'title': 'New Item.',
				'todocategory_id': category.attr('id').replace('category-', '')
			},
			function (newitem) {
				$(newitem).hide().prependTo(category.find('.todolist')).fadeIn().find('.text').focus();
			}
		);
	});


	$('div.widget').on('dblclick', 'i.handle', function () {
		var flag = 1, todo = $(this).closest("[id^=todo-]");
		if (todo.find('td.text').hasClass('high-priority')) {
			flag = 0;
		}
		todo.find('td.text').toggleClass('high-priority');
		$.post(
			'ajax_edit',
			{
				'id': todo.attr('id').replace('todo-', ''),
				'priority': flag
			}
		);
	});
	// remove item

	$('div.widget').on('click', 'i.remove', function () {
		if (!window.confirm('削除しますか？')) {
			return false;
		}
		var todo = $(this).closest("[id^=todo-]");
		$.post(
			'ajax_delete',
			{
				'id': todo.attr('id').replace('todo-', '')
			},
			function (result) {
				if (result === "1") {
					todo.fadeOut(
						'normal',
						function () {	todo.remove('fast');	}
					);
				}
			}
		);
	});

	// complete item

	$('div.widget').on('click', 'i.done', function () {
		var todo = $(this).closest("[id^=todo-]"),
			completed = $.datepicker.formatDate('yy-mm-dd', new Date());
		if (todo.hasClass('completed')) {
			completed = null;
			$(this).removeAttr('title');
		} else {
			$(this).attr('title', '完了日：' + completed);
		}
		todo.toggleClass('completed');
		$.post(
			'ajax_edit',
			{
				'id': todo.attr('id').replace('todo-', ''),
				'completed': completed
			}
		);
	});

	// toggle toolbox

	$('div.widget').on('click', 'i.toggletool', function () {
		var visible = $(this).next('.toolbox').toggle().is(':visible');
		if (visible) {
			$(this).closest('.widget').find('.checkmark').show();
		} else {
			$(this).closest('.widget').find('.checkmark').hide();
		}
	});

	// toolbox / checkbox

	$('div.widget').on('click', 'input.tooglecheckall', function () {
		var cv = $(this).prop('checked');
		$(this).closest('.widget').find('.checkmark').prop('checked', cv);
	});

	// remove checked items

	$('div.widget').on('click', 'i.removechecked', function () {
		if (!window.confirm('チェックしたアイテムを本当に削除しますか？')) {
			return false;
		}
		var chks, idlist = [];
		chks = $(this).closest('.widget').find('tr').has('.checkmark:checked');
		if (chks.length === 0) { return false; }
		chks.each(function () {
			idlist.push($(this).attr('id').replace('todo-', ''));
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

	// complete checked items

	$('div.widget').on('click', 'i.donechecked', function () {
		if (!window.confirm('チェックしたアイテムを完了としますか？')) {
			return false;
		}
		var chks, idlist = [], completed = $.datepicker.formatDate('yy-mm-dd', new Date());
		chks = $(this).closest('.widget').find('tr').has('.checkmark:checked');
		if (chks.length === 0) { return false; }
		chks.each(function () {
			idlist.push($(this).attr('id').replace('todo-', ''));
			$(this).addClass('completed');
		});
		$.post(
			'ajax_completeitems',
			{
				'items': idlist,
				'completed': completed
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});

	// to history checked items

	$('div.widget').on('click', 'i.historychecked', function () {
		if (!window.confirm('チェックしたアイテムを履歴に移動（完了分のみ）しますか？')) {
			return false;
		}
		var chks, idlist = [];
		chks = $(this).closest('.widget').find('tr').has('.checkmark:checked');
		chks.each(function () {
			if (!$(this).hasClass('completed')) {
				return true;	//continue
			}
			idlist.push($(this).attr('id').replace('todo-', ''));
			$(this).remove();
		});
		if (idlist.length === 0) { return false; }
		$.post(
			'ajax_2allhistory',
			{
				'items': idlist
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});

	//edit category

	$('div.widget').on('focus', 'span.title', function () {
		$(this).data('before', $(this).text());
	});

	$('div.widget').on('blur', 'span.title', function () {
		if ($(this).text() === $(this).data('before')) { return; }
		var title = $(this).text(),
			category_hash = $(this).closest("[id^=category-]").attr('id'),
			category_id = category_hash.replace('category-', ''),
			target;
		if (title.length === 0) {
			window.alert('Not allow blunk.');
			$(this).text($(this).data('before')).removeData('before');
			return;
		}
		$(this).removeData('before');
		target = ".categories [href=#" + category_hash + "]";
		$(target).text(title);
//		$('.categories').text(title);

		$.post(
			'ajax_edit_category',
			{
				'id': category_id,
				'name': title
			}
		);
	});




	// td.text handling

	$('div.widget').on('blur', 'td.text', function () {

		// changed

		var todo = $(this).closest("[id^=todo-]");
		if ($(this).data('before') !== $(this).text()) {
			$.post(
				'ajax_edit',
				{
					'id': todo.attr('id').replace('todo-', ''),
					'title': $(this).text()
				}
			);
		}
		$(this).text($(this).text()).removeData('before');
	});


	$('div.widget').on('focus', 'td.text', function () {
		$(this).data('before', $(this).text()).selectText();
	});


	// keyboard

	$('div.widget').on('keydown', 'td.text', function (e) {
		// ↓、enter
		if (e.which === 13 || e.which === 40) {
			e.preventDefault();
			$(this).closest('tr').next().find('.text').focus();
		}
		// escape
		if (e.which === 27) {
			e.preventDefault();
			$(this).text($(this).data('before'));
		}
		// ↑
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