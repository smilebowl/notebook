/*jslint browser: true, node: false, plusplus: true */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	$('#menu-toggle').click(function (e) {
		e.preventDefault();
		$('#wrapper').toggleClass('active');
	});

	// toggle menu
//	$('ul.sidebar-nav li').click(function (e) {
//		$(this).children().show();
//	});

	$(".gotop").hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.gotop').slideDown();
		} else {
			$('.gotop').slideUp();
		}
	});

	$('a[href^=#]').click(function () {
		if ($(this).attr('href') === '#') {
			$('body,html').animate({scrollTop: 0}, 300);
			return false;
		}
		var offset = $(this.hash).offset().top;
		$('html,body').animate({scrollTop: offset}, 'fast');
		return false;
	});


	$('.widget-header i.off').on('click', function () {
		$(this).closest('.widget').find('.widget-content').toggle('blind', 300);
	});

	// jquery datepicker
	$('.input_date').datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		showButtonPanel: true,
		showAnim: 'show'
	});

});


/* select text */
jQuery.fn.selectText = function () {
	'use strict';

	var doc = document, element = this[0], range, selection;
//	console.log(this, element);
	if (doc.body.createTextRange) {
		range = document.body.createTextRange();
		range.moveToElementText(element);
		range.select();
	} else if (window.getSelection) {
		selection = window.getSelection();
		range = document.createRange();
		range.selectNodeContents(element);
		selection.removeAllRanges();
		selection.addRange(range);
	}
};