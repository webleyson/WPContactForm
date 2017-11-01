<?php
/**
 * @package Contact_Form
 * @version 1.0
 */
/*
Plugin Name:  Contact Form with reCAPTCHA
Plugin URI: https://twitter.com/webleyson
Description: 
Author: Matt Webley
Version: 1.0
Author URI: https://twitter.com/webleyson

Register a reCAPTCHA key at
https://www.google.com/recaptcha/admin#list then add them to your shortcode
Full instructions - https://github.com/webleyson/WP-Contact-From
*/

function contactForm($atts){
	wp_enqueue_script('test', plugin_dir_url(__FILE__) . 'js/mw-contact.js');
	wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
	 extract(shortcode_atts(array(
        "to" => get_bloginfo('admin_email'),
        "secret" => '',
        "sitekey" => ''
    ), $atts));

	$formHtml = "<form id='contactForm' class='form-horizontal' action='' method='post'>";
	$formHtml .= "<input type='hidden' name='to' value='".$to."'>";
	$formHtml .= "<input type='hidden' name='secret' value='".$secret."'>";
	$formHtml .= "<div class='form-group'><label form='name'>Name *</label><br /><input type='text' name='name' class='form-control required' requried><div class='error'></div></div>";
	$formHtml .= "<div class='form-group'><label form='name'>Email *</label><br /><input type='email' name='email' class='form-control required' requried><div class='error'></div></div>";
	$formHtml .= "<div class='form-group'><label form='name'>Phone</label><br /><input type='phone' name='phone' class='form-control required' requried></div>";
	$formHtml .= "<div class='form-group'><label form='name'>Mesage *</label><textarea name='message' class='form-control required' requried></textarea><div class='error'></div></div><br />";
	$formHtml .= "<div class='form-group g-recaptcha' data-sitekey='".$sitekey."' data-callback='enableBtn'></div>";
	$formHtml .= "<div class='form-group spinner'></div>";
	$formHtml .= "<div class='form-group'><input type='submit' id='submit' class='btn btn-success btn-send'></div>";
	$formHtml .= "</form>";


	return $formHtml;
}

add_shortcode('contact', 'contactForm');
?>
