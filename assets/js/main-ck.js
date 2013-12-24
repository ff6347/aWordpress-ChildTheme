/**
 * This is our main JS it gets included in functions.php
 */// main.js
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
jQuery(document).ready(function(e){var t=jQuery(window).height();if(e("body").hasClass("page-id-48"))initGoogleMap();else if(e("body").hasClass("home")){var n=e(".slideshow_slide_image a img"),r=e(".slideshow_container, .slideshow_content, .slideshow_view, .slideshow_slide");n.css({marginTop:0});r.css({height:t});e("slideshow_view").css({top:t})}});