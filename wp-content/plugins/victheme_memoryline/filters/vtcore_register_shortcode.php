<?php
/**
 * Registering memoryline shortcode to wordpress
 * shortcodes via VTCore_Wordpress_Shortcode
 * using vtcore_register_shortcode filter
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_MemoryLine_Filters_VTCore__Register__Shortcode
extends VTCore_Wordpress_Models_Hook {

  public function hook($shortcodes = NULL) {
    $shortcodes[] = 'memoryline';
    $shortcodes[] = 'memorylineinner';
    $shortcodes[] = 'memorylinesimple';

    return $shortcodes;
  }
}