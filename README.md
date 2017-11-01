# WPContactForm
Wordpress Contact form Plugin with Captcha and shortcode integration
This works best with a bootstrap theme but with a bit of editing it will look fine without bootstrap.
1. Clone this repo down and add to your Plugins folder - wordpress/wp-content/plugins
2.  Activate the plugin in Wordpress
3. Get a reCAPTCHA site-key and secret key from https://www.google.com/recaptcha/admin#list
4.  Create your contact page and add the following shortcode

[contact to='your email' secret='reCAPTCHA secret'  sitekey='reCAPTCHA sitekey' from='add a from address if you like']
if you leave the 'to' blank it will default to the Wordpress admin email address
SAVE and BOOM you should be good to go!

Let me know if you have any problems.
