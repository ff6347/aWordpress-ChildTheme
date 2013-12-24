/**
 * This is our main JS it gets included in functions.php
 */
// main.js

// function addViewToggle() {
// 	jQuery('#main').append(
// 		'<button class="viewToggle" onClick="toggleView()">↓</button>'
// 	);
// }

// function toggleView() {
// 	jQuery("html, body").animate(
// 		{
// 			scrollTop: jQuery('.home-link').offset().top
// 		},
// 		1000);
// }

// function scroll() {
// 	if(document.body.scrollTop + 200 > jQuery('.home-link').offset().top){
// 		jQuery('.viewToggle').hide();
// 	}
// 	else{
// 		jQuery('.viewToggle').show();
// 	}
// }

jQuery(document).ready(function($){
	var windowHeight = jQuery(window).height();
	// alert(windowHeight);
	// 'page-id-48' is the class given to the 'Kontakt & Anfahrt' page
	// eventually needs to be changed
	if($('body').hasClass('page-id-48')){
		initGoogleMap();
	}
	else if($('body').hasClass('home')){
		var $slideshowImages = $('.slideshow_slide_image a img');
		var $slideshow = $('.slideshow_container, .slideshow_content, .slideshow_view, .slideshow_slide')
		$slideshowImages.css({
			marginTop: 0
		});
		$slideshow.css({
			height: windowHeight
		});

		$('slideshow_view').css({
			top: windowHeight
		});
	}
});

// jQuery(window).resize(function($){
// 	var windowHeight = jQuery(window).height();
// 	// alert(windowHeight);
// 	// 'page-id-48' is the class given to the 'Kontakt & Anfahrt' page
// 	// eventually needs to be changed
// 	if($('body').hasClass('page-id-48')){
// 		initGoogleMap();
// 	}
// 	else if($('body').hasClass('home')){
// 		var $slideshow = $('.slideshow_container, .slideshow_content, .slideshow_view, .slideshow_slide')
// 		$slideshow.addClass('slideshowFullScreen').css({
// 			height: windowHeight
// 		});

// 		$('slideshow_view').css({
// 			top: windowHeight
// 		})
// 		// $('.slideshow_container').css('height: 100%;')

// 	}
// });
