
// ===== Sticky header ==== 

$(function() {
			var header = $(".header");
			$(window).scroll(function() {    
				var scroll = $(window).scrollTop();
			
				if (scroll >= 200) {
					header.removeClass('header').addClass("sticky-head");
				} else {
					header.removeClass("sticky-head").addClass('header');
				}
			});
});

