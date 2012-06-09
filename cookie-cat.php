<?php
/**
Plugin Name: cookie-cat
Depends: oik base plugin
Plugin URI: http://www.oik-plugins.com/oik-plugins/cookie-cat
Description: [cookies] shortcode for producing a table of cookies the website uses
Version: 1.1
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2012 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/
add_action( "oik_loaded", "cookie_cat_init" );


/* This code will produce a message when cookie-cat is activated but oik isn't */
$plugin_basename = plugin_basename(__FILE__);
$plugin_name = basename( $plugin_basename, ".php" );
//bw_trace2( $plugin_basename, $plugin_name ); 
$plugin_activation = str_replace( "-", "_", $plugin_name). "_activation";
add_action( "after_plugin_row_" . $plugin_basename, $plugin_activation );
add_action( "admin_notices", $plugin_activation );


function cookie_cat_init() {
  bw_add_shortcode( 'cookies', 'cookie_cat',  oik_path( "shortcodes/cookie-cat.php", "cookie-cat"), false ); 
  add_filter( "cookies", "oik_cookie_filter", 11, 2 );
  add_action( "admin_menu", "cookie_cat_admin_menu" );
}


function cookie_cat_activation() {
  require_once( "admin/oik-activation.php" );
  if ( is_multisite() ) { 
    $depends = "oik:1.13"; 
  } else {
    $depends = "oik:1.13";
  }     
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}


function cookie_cat_admin_menu() {
  oik_require( "admin/cookie-cat.php", "cookie-cat" );
  cookie_cat_lazy_admin_menu( __FILE__ );
}

function oik_cookie_filter( $cookie_list ) {
  oik_require( "shortcodes/cookie-cat.php", "cookie-cat" );
  return( oik_lazy_cookie_filter( $cookie_list ));  
}






