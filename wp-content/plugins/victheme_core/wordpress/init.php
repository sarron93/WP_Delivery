<?php
/**
 * This class is for initializing all related
 * WordPress specific sub classes
 *
 * This is needed to keep clean VTCore that can
 * be ported or used by other CMS.
 *
 * Currently this class is managing centralized
 * registration system for :
 *
 * 1. Template system
 * 2. Actions system
 * 3. Filters system
 * 4. Fonts system
 * 5. Extension for VTCore class autoloader system
 * 6. Registering assets
 * 7. Bridging VTCore elements to VisualComposer
 * 8. WPML Bridge system
 *
 * @todo Implement the WPML system for config models
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Init {

  private $autoloader;
  static private $factories = array();

  public function __construct() {

    $this->autoloader = new VTCore_Autoloader('VTCore_Wordpress', dirname(dirname(__FILE__)));
    $this->autoloader->setRemovePath('vtcore' . DIRECTORY_SEPARATOR);
    $this->autoloader->register();

    // Autoload translation for vtcore
    load_plugin_textdomain('victheme_core', false, 'victheme_core/wordpress/languages');


    // Booting asset management system
    self::$factories['assets'] = new VTCore_Wordpress_Factory_Assets();


    // Load VTCore assets to library
    self::$factories['assets']->get('library')->detect(
      VTCore_Init::getCorePath() . DIRECTORY_SEPARATOR . 'assets',
      VTCore_Init::getCoreURL() . '/assets');


    // Load VTCore wordpress assets to library
    self::$factories['assets']->get('library')->detect(
      dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets', str_replace('vtcore', 'wordpress',
      VTCore_Init::getCoreURL()) . '/assets');


    // Wp ajax needs extra variables
    self::$factories['assets']
      ->get('library')
      ->add('wp-ajax.js.wp-ajax-js.localize.wpajax', array('ajaxurl' => admin_url('admin-ajax.php')));


    // Booting plugin templating system
    self::$factories['template'] = new VTCore_Wordpress_Factory_Templates();

    // Booting google fonts system
    self::$factories['fonts'] = new VTCore_Wordpress_Factory_Fonts();

    // Booting shortcodes system
    self::$factories['shortcodes'] = new VTCore_Wordpress_Factory_Shortcodes();

    // Booting custom templates
    self::$factories['customTemplate'] = new VTCore_Wordpress_Factory_CustomTemplate();

    // Booting Customizer
    self::$factories['customizer'] = new VTCore_Wordpress_Factory_Customizer();

    // Booting VisualComposer integration
    if (defined('WPB_VC_VERSION')) {
      self::$factories['visualcomposer'] = new VTCore_Wordpress_Factory_VC();
      self::$factories['visualcomposer']->register();
    }

    // Booting WPML integration for wpml-config.xml
    if (defined('ICL_SITEPRESS_VERSION')) {
      self::$factories['wpml'] = new VTCore_Wordpress_Factory_WPML();
    }

    // Load core classes registry cache for performance
    if (!(defined('VTCORE_CLEAR_CACHE') && VTCORE_CLEAR_CACHE)
        || !(defined('WP_DEBUG') && WP_DEBUG)) {

      $object = new VTCore_Wordpress_Objects_Cache();
      $object->loadCoreClasses();
      unset($object);
    }

    // Booting updater plugin, other plugin can utilize the
    // centralized version mapping system to add their own
    // updating logic
    self::$factories['updater'] = new VTCore_Wordpress_Factory_Updater();

    // Booting action system
    // Need to fire last
    self::$factories['actions'] = new VTCore_Wordpress_Factory_Actions();
    self::$factories['actions']->register();


    // Booting filter system
    // Need to fire last
    self::$factories['filters'] = new VTCore_Wordpress_Factory_Filters();
    self::$factories['filters']->register();

    // Process late clear cache
    if (get_option('vtcore_clear_cache')) {
      update_option('vtcore_clear_cache', false);

      // Force Clear Cache
      if (!defined('VTCORE_CLEAR_CACHE')) {
        define('VTCORE_CLEAR_CACHE', true);
      }

      VTCore_Autoloader::resetMapCache();
    }

    if (get_theme_support('load_vtcore_bootstrap')) {
      add_theme_support('bootstrap');
      VTCore_Wordpress_Utility::loadAsset('bootstrap');
    }

  }

  /**
   * Allow user to inject Factory Dynamically
   * @param $name
   * @param $object
   */
  public static function setFactory($name, $object) {
    if (is_object($object)) {
      self::$factories[$name] = $object;
    }
  }

  /**
   * Retrieves stored factory singleton object.
   * @param string $type the factory type
   */
  public static function getFactory($type) {
    return isset(self::$factories[$type]) ? self::$factories[$type] : false;
  }


  /**
   * Get all available factories
   */
  public static function getFactories() {
    return self::$factories;
  }


  /**
   * Clear all factory caches
   */
  public static function factoriesClearCache() {
    foreach (self::getFactories() as $factory) {
      if ($factory instanceof VTCore_Wordpress_Interfaces_Factory) {
        $factory->clearCache();
      }
    }
  }
}