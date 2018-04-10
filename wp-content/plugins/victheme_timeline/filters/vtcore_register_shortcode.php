<?php
/**
 * Hooking into vtcore_register_shortcode filter
 * to register portfolio related shortcodes
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Timeline_Filters_VTCore__Register__Shortcode
extends VTCore_Wordpress_Models_Hook {

  public function hook($shortcodes = NULL) {

    $shortcodes[] = 'timeevents';
    $shortcodes[] = 'timeline';
    $shortcodes[] = 'timemajor';
    $shortcodes[] = 'timeend';
    $shortcodes[] = 'timelinesimple';

    return $shortcodes;
  }
}