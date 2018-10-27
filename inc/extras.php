<?php


// port city Count

function port_city_pics_count() {
  ob_start();
  $count = wp_count_posts('image');
  $count = $count->publish;
  //$count = count($pics);
  return $count;
}

add_shortcode('port_city_count','port_city_pics_count');

add_action('init', 'my_custom_init');
    function my_custom_init() {
        // 'portfolio' is my post type, you replace it with yours
        add_post_type_support( 'image', 'thumbnail' );
    }


//Move Featured Image box //
/*
 * Customize the Featured Image metabox w/ info-text
 *
 */
function mim_remove_featuredimage_metabox() {
    remove_meta_box( 'postimagediv', 'image', 'side' );
}
add_action( 'admin_head', 'mim_remove_featuredimage_metabox' );

function mim_custom_featuredimage_metabox( $post ) {

	$thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );
	echo _wp_post_thumbnail_html( $thumbnail_id, $post->ID );

}
function mim_add_featuredimage_metabox() {
	add_meta_box( 'postimagediv', __( 'Featured Image' ), 'mim_custom_featuredimage_metabox', 'image', 'normal', 'high' );
}
add_action( 'admin_head', 'mim_add_featuredimage_metabox' );


// pre get posts for tags

function cody_cpt_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'image' ) );
    }
}
add_action( 'pre_get_posts', 'cody_cpt_tags' );


// add conditional statements for mobile devices
function is_ipad() {
	$is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if ($is_ipad)
		return true;
	else return false;
}
function is_iphone() {
	$cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
	if ($cn_is_iphone)
		return true;
	else return false;
}
function is_ipod() {
	$cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod');
	if ($cn_is_iphone)
		return true;
	else return false;
}
function is_ios() {
	if (is_iphone() || is_ipad() || is_ipod())
		return true;
	else return false;
}
function is_android() { // detect ALL android devices
	$is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
	if ($is_android)
		return true;
	else return false;
}
function is_android_mobile() { // detect ALL android devices
	$is_android   = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
	$is_android_m = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Mobile');
	if ($is_android && $is_android_m)
		return true;
	else return false;
}
function is_android_tablet() { // detect android tablets
	if (is_android() && !is_android_mobile())
		return true;
	else return false;
}
function is_mobile_device() { // detect ALL mobile devices
	if (is_android_mobile() || is_iphone() || is_ipod())
		return true;
	else return false;
}
function is_tablet() { // detect ALL tablets
	if ((is_android() && !is_android_mobile()) || is_ipad())
		return true;
	else return false;
}

// add browser name to body class
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $is_iphone;
	if(!wp_is_mobile()) {
		if($is_gecko) $classes[] = 'browser-gecko';
		elseif($is_opera) $classes[] = 'browser-opera';
		elseif($is_safari) $classes[] = 'browser-safari';
		elseif($is_chrome) $classes[] = 'browser-chrome';
        elseif($is_IE) {
            $classes[] = 'browser-ie';
            if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie-version-'.$browser_version[1];
        }
		else $classes[] = 'browser-unknown';
	} else {
    	if(is_iphone()) $classes[] = 'browser-iphone';
        elseif(is_ipad()) $classes[] = 'browser-ipad';
        elseif(is_ipod()) $classes[] = 'browser-ipod';
        elseif(is_android()) $classes[] = 'browser-android';
        elseif(is_tablet()) $classes[] = 'device-tablet';
        elseif(is_mobile_device()) $classes[] = 'device-mobile';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false) $classes[] = 'browser-kindle';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false) $classes[] = 'browser-blackberry';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) $classes[] = 'browser-opera-mini';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) $classes[] = 'browser-opera-mobi';
	}
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows') !== false) $classes[] = 'os-windows';
        elseif(is_android()) $classes[] = 'os-android';
        elseif(is_ios()) $classes[] = 'os-ios';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false) $classes[] = 'os-mac';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Linux') !== false) $classes[] = 'os-linux';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false) $classes[] = 'os-kindle';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false) $classes[] = 'os-blackberry';
	return $classes;
}


function svg_arrow() {
  echo '<?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 16.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
<g id="Icon_8_">
	<g>
		<path d="M427,234.625H167.296l119.702-119.702L256,85L85,256l171,171l29.922-29.924L167.296,277.375H427V234.625z"/>
	</g>
</g>
</svg>';
}
