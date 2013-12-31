/*jslint browser: true, node: false, plusplus: true */
/*global $, jQuery*/
$(document).ready(function () {
	'use strict';

	$('#menu-toggle').click(function (e) {
		e.preventDefault();
		$('#wrapper').toggleClass('active');
	});

	$(".gotop").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.gotop').slideDown();
			} else {
				$('.gotop').slideUp();
			}
		});
	});
	$('.gotop a').click(function (e) {
		$('body,html').animate({scrollTop: 0}, 300);
		e.preventDefault();
	});



	$('.widget-header i.off').on('click', function () {
		$(this).closest('.widget').find('.widget-content').toggle('blind', 300);
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