<?php
/*
Plugin Name: Change Amazon Short Links to Smile Links
Plugin URI: https://thomasloughlin.com/amazon-smile-amazons-affiliate-program/
Version: 1.0.2
Author: Thomas Loughlin
Author URI: https://thomasloughlin.com/
Description: Version 1 finds all shortened Amazon Affiliate Links and remaps them to smile.amazon.com.
*/

function smile_maker ($content)
{
    $smile_url="//smile.amazon.com";
    $normal_url="//www.amazon.com";
/*
 * Grabs cache  if available / initializes array if not
 */
    if ( false === ( $cache_temp = get_transient( 'wp_chg2smile_results' ) ) ) {
        $cache_temp=array();
    }
/*
 * Match http:// or https:// that is enclosed with ' or "
 */
    $pattern = '/(https?:\/\/amzn\.to\/[a-zA-Z0-9]*["|\'])/i' ;
    $found=preg_match_all($pattern, $content, $matches, PREG_PATTERN_ORDER);

    $find=array();
    $replace= array();
/*
 * Finds all matching http://amzn.to/<some numbers and letters> and then the stopping delimiter of single or double quote.
 * I grab the delimiter because the Amazon shortened urls are not a fixed length and I wanted to avoid matching the wrong
 * patterns with a simple str_replace later.  This problem can be solved other ways.
 *
 * If no links are found - skip this mess and dump the content
 */
    if($found!==FALSE)
    {
        for($i=0;$i<$found;$i++)
        {

            /*
             * Check if it exists in cache
             * 1st get last part, then use that as a key
             */
            $temp=explode('/',substr($matches[0][$i],0, -1));
            $key=$temp[(count($temp)-1)];
            if(isset($cache_temp[$key]))
            {
                /*
                 * Using Cached Copy
                 *  TODO: add in duplicate checking
                 */
                $find[]=$matches[0][$i];
                $replace[]=$cache_temp[$key] . substr($matches[0][$i],-1, 1);

            }
            else
            {
                /*
                 * No Cache - grabbing headers and setting cache
                 *
                 */
                $header_info= get_headers(substr($matches[0][$i],0, -1),1);

                if($header_info!==FALSE)
                {
                    /*
                     * If get_headers fails - we just ignore the link by not including it in our find / replace
                     *
                     */
                    $find[]=$matches[0][$i];
                    $new_url=str_replace($normal_url,$smile_url,$header_info['Location']); //swap www with smile
                    $replace[]=$new_url. substr($matches[0][$i],-1, 1);
                    $cache_temp[$key]=$new_url;   //add the key and the new url to cache
                }
            }

            set_transient( 'wp_chg2smile_results', $cache_temp, 60*60*12);
        }
        if(count($find)>0)
        {
            /*
             * Only do the replace if needed
             */
            $content=str_replace($find,$replace,$content);
        }

    }
/*
 *  Daring or Dangerous people can replace  "return $content;"
 * with "return str_replace($normal_url,$smile_url,$content);"
 */
 return $content;

}
/*
 * Wordpress has many more objects that like filters.  I have only tested the below.
 */
add_filter ('the_content',       'smile_maker');
add_filter ('the_excerpt',       'smile_maker');
