<?php
/**
 * Main Class for handling the Plugin operation
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Timeline_Init {

  private $autoloader;

  private $filters = array(
    'vtcore_register_shortcode_prefix',
    'vtcore_register_shortcode',
    'vc_load_default_templates',
  );

  private $actions = array(
    'vc_backend_editor_enqueue_js_css',
    'vc_frontend_editor_enqueue_js_css',
    'vc_load_iframe_jscss',
    'vtcore_updater',
  );


  private $shortcodes = array(
    'VTCore_Timeline_Composer_TimeLine',
    'VTCore_Timeline_Composer_TimeLineSimple',
    'VTCore_Timeline_Composer_TimeMajor',
    'VTCore_Timeline_Composer_TimeEvents',
    'VTCore_Timeline_Composer_TimeEnd',
  );

  /**
   * Constructing the main class and adding action to init.
   */
  public function __construct() {

    // Load autoloader
    $this->autoloader = new VTCore_Autoloader('VTCore_Timeline', dirname(__FILE__));
    $this->autoloader->setRemovePath('vtcore' . DIRECTORY_SEPARATOR . 'timeline' . DIRECTORY_SEPARATOR);
    $this->autoloader->register();

    // Autoload translation for vtcore
    load_plugin_textdomain('victheme_timeline', false, 'victheme_timeline/languages');

    // Registering assets
    VTCore_Wordpress_Init::getFactory('assets')
      ->get('library')
      ->detect(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets', plugins_url('', __FILE__) . '/assets');

    // Registering actions
    VTCore_Wordpress_Init::getFactory('filters')
      ->addPrefix('VTCore_Timeline_Filters_')
      ->addHooks($this->filters)
      ->register();


    // Registering filters
    VTCore_Wordpress_Init::getFactory('actions')
      ->addPrefix('VTCore_Timeline_Actions_')
      ->addHooks($this->actions)
      ->register();

    // Register to visual composer via VTCore Visual Composer Factory
    if (VTCore_Wordpress_Init::getFactory('visualcomposer')) {
      VTCore_Wordpress_Init::getFactory('visualcomposer')
        ->mapShortcode($this->shortcodes);
    }
  }

}