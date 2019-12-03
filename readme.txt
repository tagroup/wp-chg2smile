=== WP Amazon Affiliate Change to Smile Links  ===
Contributors: Thomas Loughlin
Tags: amazon affiliate smile
Requires at least: 3.5
Tested up to: 5.3
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Replaces Shortened Amazon Affiliate Links with Affiliate links using smile.amazon.com

== Description ==

Looks for a shortened amazon affiliate link like https://amzn.to/33GJdHb and converts it to the smile version (https://smile.amazon.com/dp/B00X0AWA6E/ref=as_li_ss_tl?ie=UTF8&linkCode=ll1&tag=playwiththewe-20&linkId=d88644f0ca89b94b52f5710bf6750b0a&language=en_US)  at runtime.  This process can be slow so there is some caching.

How the WordPress AmazonSmile plugin works - Long Version from http://thomasloughlin.com/amazon-smile-amazons-affiliate-program/ 

Adds a filter so the content is passed to a function.
Content is searched for a shortened Amazon Affiliate Link.
The ‘key’ is extracted from the url and checked against cache.
If the end url is not found, the full url is grabbed, converted to smile and thrown into cache.

It's pretty simple to run, just drop it in the plugin directory and activate that's all it takes.

== Installation ==

1. Upload the complete directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Test - You assume all risk in changing urls.

== Frequently Asked Questions ==

= Can I use this to change regular www.amazon.com affiliate links to smile.amazon.com affiliate links? =

Yes - to do so, change the line "return $content;" to "return str_replace($normal_url,$smile_url,$content);".  Please make sure to test all your links.

== Changelog ==

= 1.0.1 =
* Updated readme.

= 1.0.2 =
* Updated readme / updated after testing with WP 5.3.
