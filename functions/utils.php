<?php

// // Cryptage des emails
function blone_crypt_email( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
add_shortcode( 'email', 'blone_crypt_email' );

// // RGPD

// // use priority 11 to be called after CF7 registered filter,
// // in which the `google-recaptcha` script must still be enqueued
// add_action('wp_footer', function () {
// 	// don’t do anything if reCAPTCHA is not enqueued
// 	if (!wp_script_is('google-recaptcha', 'enqueued')) {
// 		return;
// 	}

// 	// remove CF7 reCAPTCHA script
// 	wp_dequeue_script('google-recaptcha');

// 	// create customized TAC service (with callback parameter)
// 	// based on original (https://github.com/AmauriC/tarteaucitron.js/blob/master/tarteaucitron.services.js:1205)
// 	$tacReCaptchaService = 'tarteaucitron.services.recaptchacf7 = {
// 	"key": "recaptchacf7",
// 	"type": "api",
// 	"name": "reCAPTCHA",
// 	"uri": "http://www.google.com/policies/privacy/",
// 	"needConsent": true,
// 	"cookies": ["nid"],
// 	"js": function () {
// 		"use strict";
// 		tarteaucitron.fallback(["g-recaptcha"], "");
// 		tarteaucitron.addScript("https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit&ver=2.0");
// 	},
// 	"fallback": function () {
// 		"use strict";
// 		var id = "recaptchacf7";
// 		tarteaucitron.fallback(["g-recaptcha"], tarteaucitron.engage(id));
// 	}
// };';

// 	// add it after TarteAuCitron script
// 	wp_add_inline_script('tac', $tacReCaptchaService, 'after');

// 	// register the customized service
// 	wp_add_inline_script('tac', '(tarteaucitron.job = tarteaucitron.job || []).push("recaptchacf7");', 'after');
// }, 11);

// add_theme_support( 'post-thumbnails', array( 'post' ) ); 