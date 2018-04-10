<?php
/**
 * Factory class for registering all VTCore related
 * shortcodes into wordpress.
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Wordpress_Factory_Shortcodes
extends VTCore_Wordpress_Models_Config
implements VTCore_Wordpress_Interfaces_Factory {

  protected $database = 'vtcore_registered_shortcode';
  protected $filter = 'vtcore_register_shortcode';

  /**
   * Private vars for statically storing
   * available subclasses
   * @performance this is for autoloader perfomance improvement only.
   */
  private static $classes = array();


  /**
   * Registering shortcodes to WordPress
   */
  protected function register(array $options) {

    $this->options = array(
      'fontawesome',
      'bsrow',
      'bscolumn',
      'bsheader',
      'bsalert',
      'bsbadge',
      'bsheader',
      'bsjumbotron',
      'bslabel',
      'bspanel',
      'bswell',
      'bsglyphicon',
      'bsmedialist',
      'bsmediaobject',
      'bslistgroup',
      'bslistobject',
      'bsbutton',
      'wpimage',
    );

    // Merge the user supplied options
    $this->merge($options);
  }

  /**
   * Registering shortcodes to wordpress
   */
  public function initialize() {
    foreach ($this->options as $shortcode) {
      add_shortcode($shortcode, array($this, ucfirst($shortcode)), 10, 2);
    }
  }

  /**
   * Overloading method that is declared on child subclass
   * but not in this main class
   */
  public function __call($method, $context) {

    // Check if we should bypass cache
    $this->maybeByPassCache();

    // Load cache
    $this->loadCache();

    foreach ($this->getOverloader() as $prefix) {
      $class = $prefix . $method;
      if (isset(self::$classes[$class])) {

        if (self::$classes[$class]) {
          $name = $class;
          break;
        }
        else {
          continue;
        }
        break;
      }
      elseif (class_exists($class, true)) {
        $name = $class;
        self::$classes[$class] = true;
        break;
      }
      else {
        self::$classes[$class] = false;
      }
    }

    if (isset($name)) {
      $object = new $name($context[0], $context[1], $method);
      $object->buildObject();
    }
    else {
      throw new Exception('Error Class VTCore_Wordpress_Shortcodes_' . $method . ' does\'t exists');
    }

    set_transient('vtcore_shortcode_class_map', self::$classes, 12 * HOUR_IN_SECONDS);

    return $object->getMarkup();
  }


  /**
   * Method for checking if class should bypass cache
   * @return VTCore_Wordpress_Factory_Layout
   */
  public function maybeByPassCache() {
    // Wordpress on debug mode
    if ((defined('WP_DEBUG') && WP_DEBUG)
        || (defined('VTCORE_CLEAR_CACHE') && VTCORE_CLEAR_CACHE)) {

      $this->clearCache();
    }

    return $this;
  }


  /**
   * Method for loading from cache
   * @return VTCore_Wordpress_Factory_Layout
   */
  public function loadCache() {
    self::$classes = get_transient('vtcore_shortcode_class_map');
    return $this;
  }


  /**
   * Method for clearing cached elements
   * @return VTCore_Wordpress_Factory_Layout
   */
  public function clearCache() {
    delete_transient('vtcore_shortcode_class_map');
    return $this;
  }




  /**
   * Retrieving registered overloader class
   *
   * @todo remove the filter once the registration process is automated via spl observer
   */
  private function getOverloader() {

    // @hook allow other class to register custom overloader prefix
    //       for shortcode class use.
    return apply_filters('vtcore_register_shortcode_prefix', array(
      'VTCore_Wordpress_Shortcodes_'
    ));
  }

}