<?php
/**
 * Registering history shortcode to wordpress
 * shortcodes via VTCore_Wordpress_Shortcode
 * using vtcore_register_shortcode_prefix filter
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_CenterLine_Filters_VTCore__Register__Shortcode__Prefix
extends VTCore_Wordpress_Models_Hook {

  public function hook($prefix = NULL) {
    $prefix[] = 'VTCore_CenterLine_Shortcodes_';
    return $prefix;
  }
}