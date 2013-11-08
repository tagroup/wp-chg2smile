I added this to the wordpress.org plugins at http://wordpress.org/plugins/amazon-affiliate-change-to-smile-link/


=== WP Change Affiliate Links to Smile ===
Contributors: Thomas Loughlin
Tags: amazon affiliate smile
Requires at least: 3.5
Tested up to: 3.7
Stable tag: 1.0.0

Replaces Shortened Amazon Affiliate Links with Affiliate links that also have smile

== Description ==

Looks for a shortened amazon affiliate link like http://amzn.to/YPupmI and converts it to the smile version (http://smile.amazon.com/gp/product/B003MWQ30E/ref=as_li_qf_sp_asin_il_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=B003MWQ30E&linkCode=as2&tag=tl3po-20)  at runtime.  To speed the process up, transient caching is used.

How the WordPress AmazonSmile plugin works (Long Version from http://thomasloughlin.com/amazon-smile-amazons-affiliate-program/):

Adds a filter so the content is passed to a function.
Content is searched for a shortened Amazon Affiliate Link.
The ‘key’ is extracted from the url and checked against cache.
If the end url is not found, the full url is grabbed, converted to smile and thrown into cache.

It's pretty simple to run, just drop it in the plugin directory and activate that's all it takes.

== Installation ==

1. Upload the complete wp-chg2smile directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Test - You assume all risk in changing urls.
