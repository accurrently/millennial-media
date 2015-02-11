// mm-sticky-scroller.js
// slick function for sticky scroller
$(document).ready(function(){
	$('.mm-sticky-scroller').slick({
		autoplay: true,
		autoplaySpeed: 5000,
		lazyLoad: 'ondemand',
		slidesToShow: 1,
		slidesToScroll: 1
	});
});