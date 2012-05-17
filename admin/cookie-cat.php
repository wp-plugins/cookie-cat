<?php // (C) Copyright Bobbing Wide 2012
/**
 * Display a message when cookie-cat is not functional due to the dependencies not being activated or installed
 * Note: We can't use oik APIs here as we don't know if it's activated.
*/
function cookie_cat_inactive( $plugin=null, $dependencies=null ) {
  $plug_name = plugin_basename( $plugin );
  $message = '<div class="error">';
  $message .= "$plug_name is not yet functional. It is dependent upon the following plugins: $dependencies. Please install and activate these plugins.";
  $message .= "</div>";
  echo $message; 
}


/**
 * Test if cookie_cat is functional
 * 
 * Unless oik is installed and activated we won't do anything
 * Note: If oik is installed and activated then we would shouldn't have any problem
 * although there could be a version number requirement to satisfy as well! Not yet implemented.
*/
function cookie_cat_lazy_activation( $plugin=null, $dependencies=null, $callback=null ) {
  if ( function_exists( "oik_depends" ) ) {  
    /* Good - oik appears to be activated and loaded */
    oik_depends( $plugin, $dependencies, $callback );
  } else {
    if ( is_callable( $callback )) {
      call_user_func( $callback, $plugin, $dependencies );
    }  
  }   
}




