/*jslint browser: true, node: false, plusplus: true, sloppy: false */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	/*---------- debug -----------*/
	var cnt = 0;

	function log(val) {
		cnt++;
		$('#log').prepend('<div>' + cnt + ':' + val + '</div>');
	}
	/*---------- debug -----------*/
	$('.widget i').tooltip();


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
				'ajaxreorder',
				{
					idlist:	arr
				}
			);
		}
	});
	$('.todolist span.actions').disableSelection();
	$('.widget-header').disableSelection();

	$(".todoui").sortable({
		handle: "i.icon",
		placeholder: 'sortable-placeholder',
		update: function () {
			var arr = $(this).sortable('toArray');
			$.post(
				'ajaxreorder_category',
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
			'ajaxadd',
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
			'ajaxedit',
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
			'ajaxdelete',
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
		}
		todo.toggleClass('completed');
		$.post(
			'ajaxedit',
			{
				'id': todo.attr('id').replace('todo-', ''),
				'completed': completed
			}
		);
	});

	$('div.widget').on('click', 'i.toggletool', function () {
		var visible = $(this).next('.toolbox').toggle().is(':visible');
		if (visible) {
			$(this).closest('.widget').find('.checkmark').show();
		} else {
			$(this).closest('.widget').find('.checkmark').hide();
		}
	});

	$('div.widget').on('click', 'input.tooglecheckall', function () {
		var cv = $(this).prop('checked');
		$(this).closest('.widget').find('.checkmark').prop('checked', cv);
	});

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
			'ajaxdeleteitems',
			{
				'items': idlist
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});

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
			'ajaxcompleteitems',
			{
				'items': idlist,
				'completed': completed
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});

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
			'ajax2allhistory',
			{
				'items': idlist
			}
		);
		$(this).closest('.actions').find('i.toggletool').click();
	});





	// td.text handling

	$('div.widget').on('blur', 'td.text', function () {

		// changed

		var todo = $(this).closest("[id^=todo-]");
		$.post(
			'ajaxedit',
			{
				'id': todo.attr('id').replace('todo-', ''),
				'title': $(this).text()
			}
		);
		$(this).text($(this).text()).removeData('before');
	});


	$('div.widget').on('focus', 'td.text', function () {
		$(this).data('before', $(this).text()).selectText();
		//	log($(this).text());
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