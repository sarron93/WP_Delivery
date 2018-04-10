<?php
/**
 * Hooking into vtcore_register_shortcode_prefix filter
 * to register portfolio related shortcodes
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Timeline_Filters_VTCore__Register__Shortcode__Prefix
extends VTCore_Wordpress_Models_Hook {

  public function hook($prefix = NULL) {

    $prefix[] = 'VTCore_Timeline_Shortcodes_';

    return $prefix;
  }
}