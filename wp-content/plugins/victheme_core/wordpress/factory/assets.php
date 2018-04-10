<?php
/**
 * Class for managing VTCore Assets libraries
 * Centralizing the assets record so other plugin
 * can just load the asset by folder name.
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Wordpress_Factory_Assets
  extends VTCore_Wordpress_Models_Config
  implements VTCore_Wordpress_Interfaces_Factory {

  protected $options = array();
  protected $database = 'vtcore_asset_cache';
  protected $filter = FALSE;

  private static $reset = false;

  private $base;
  private $hash;
  private $context;

  protected function register(array $options) {

    $this->options = array(
      'library' => new VTCore_Wordpress_Objects_Library(),
      'queues' => new VTCore_Wordpress_Objects_Queue(),
      'aggregate' => true,
      'minify' => false,
      'default' => array(
        'deps' => array('jquery'),
        'version' => '',
        'footer' => true,
      ),
      'prefix' => 'comp-front-',
      'compressed' => array(),
    );

    // Setting up the library object;
    $this
      ->get('library')
      ->allowed(array('js', 'css'))
      ->database('vtcore_asset_library')
      ->load();

    if (is_admin()) {
      $this->mutate('prefix', 'comp-admin-');
    }

    $this->merge($options)->load();

    return $this;
  }


  /**
   * Method for generating hashed key
   * @return mixed
   */
  protected function generateHash() {
    $this->hash = $this->get('prefix') . md5(implode('#', array_keys($this->get('queues')->extract())));
    return $this;
  }


  /**
   * Main logic for loading assets
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function process() {


    $this->maybeByPassCache();

    // Generate unique hash
    $this->generateHash();

    // Always aggregate on admin pages
    if (is_admin()) {
      $this->change('aggregate', TRUE);
    }

    // Do asset aggregation service
    if ($this->get('aggregate')) {

      // Try to get cached assets
      if ($this->checkCache()) {
        $this->loadCache();
      }

      // Build new aggregation
      else {
        // Compress the assets
        $this->compress();

        // Save the cache
        $this->save();
      }
    }

    // Enqueue the assets to wordpress
    $this->enqueue();

    return $this;
  }


  /**
   * Method for enqueue queued asset to wordpress
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function enqueue() {

    foreach ($this->get('queues')->extract() as $name => $data) {
      if (!$this->get('library')->get($name)) {
        continue;
      }

      $inline = array();
      $localize = array();

      $data = wp_parse_args($data, $this->get('default'));

      foreach ($this->get('library')->get($name) as $type => $files) {
        $content = '';

        foreach ($files as $filename => $file) {

          if (@!file_exists($file['path'])) {
            continue;
          }

          if ($type == 'css') {
            wp_enqueue_style($filename, $file['url']);
          }

          if ($type == 'js') {
            wp_enqueue_script($filename, $file['url'], $data['deps'], $data['version'], $data['footer']);
          }

          if (isset($file['inline'])) {
            $inline[$filename] = implode("\n", $file['inline']);
          }

          if (isset($file['localize'])) {
            $localize[$filename] = $file['localize'];
          }
        }
      }

      // Enqueue inline styles
      foreach ($inline as $filename => $css) {
        wp_add_inline_style($filename, $css);
      }

      // Enqueue localized script
      foreach ($localize as $filename => $local) {
        foreach ($local as $var => $value) {
          wp_localize_script($filename, $var, $value);
        }
      }

      $this->get('queues')->processed($name);
    }

    return $this;
  }


  /**
   * Method for checking if we should bypass cache
   * @return VTCore_Wordpress_Factory_Assets
   */
  public function maybeByPassCache() {

    // Force remove if defined global clear cache constant
    if ((defined('WP_DEBUG') && WP_DEBUG)
      || (defined('VTCORE_CLEAR_CACHE') && VTCORE_CLEAR_CACHE)
      || get_option('vtcore_clear_cache', false) == true) {

      $this->clearCache();

    }

    return $this;
  }


  /**
   * Load compressed asset from cache
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function loadCache() {
    // Add cached custom asset to library
    $this
      ->get('library')
      ->add($this->get('compressed.' . $this->hash . '.id'), $this->get('compressed.' . $this->hash . '.assets'));

    // Remove previously cached assets from queues
    foreach ($this->get('queues')->extract() as $name => $data) {
      $this->get('queues')->processed($name);
    }

    // Add the cached assets to queue
    $this
      ->get('queues')
      ->add($this->get('compressed.' . $this->hash . '.id'), TRUE);

    return $this;
  }


  /**
   * Check if the cached file actually exists
   * to prevent missing file break site bug.
   * @return boolean
   */
  public function checkCache() {

    $check = false;
    if ($this->get('compressed.' . $this->hash . '.assets') && self::$reset == false) {
      foreach ($this->get('compressed.' . $this->hash . '.assets') as $type => $data) {
        $file = array_shift($data);
        if (isset($file['path']) && @file_exists($file['path'])) {
          $check = true;
        }

        // Bail out if one of the cached file is missing
        else {
          $check = false;
          break;
        }
      }
    }

    return $check;
  }


  /**
   * Overriden method for saving to database
   * This object doesn't need to save referenced
   * assets objects to database.
   *
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function save() {

    $data = $this->extract();
    $this->options = array('compressed' => $this->get('compressed'));

    parent::save();

    $this->options = $data;

    unset($data);

    return $this;
  }


  /**
   * Method for compressing queued assets
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function compress() {

    $this->context = array(
      'css' => '',
      'js' => '',
      'inline' => '',
      'id' => uniqid('custom-'),
    );

    foreach ($this->get('queues')->extract() as $name => $data) {

      if (!$this->get('library')->get($name)) {
        continue;
      }

      foreach ($this->get('library')->get($name) as $type => $files) {
        $content = '';

        foreach ($files as $filename => $file) {
          if (file_exists($file['path'])) {
            $content .= file_get_contents($file['path']);
          }

          if (isset($file['inline'])) {
            $this->context['inline'] .= implode("\n", $file['inline']);
          }

          if (isset($file['localize'])) {
            $this->get('library')
              ->add($this->context['id'] . '.js.' . $this->context['id'] . '.localize', $file['localize']);
          }
        }


        if ($type == 'css') {
          $this->base = trailingslashit(dirname($file['url']));
          $content = preg_replace_callback('/url\(\s*[\'"]?(?![a-z]+:|\/+)([^\'")]+)[\'"]?\s*\)/i', array(
            $this,
            'fixCssPath'
          ), $content);
        }

        if ($type == 'js' && substr($content, -1) != ';') {
          $content .= ";\n";
        }

        $this->context[$type] .= $content;
      }

      $this->get('queues')->processed($name);
    }

    // Merge inline css last
    $this->context['css'] .= $this->context['inline'];

    if ($this->get('minify')) {
      $this->minify();
    }

    if (!empty($this->context['css'])) {

      // Remove multiple @charset
      $this->context['css'] = preg_replace('/^@charset\s+[\'"](\S*?)\b[\'"];/i', '', $this->context['css']);

      $upload = VTCore_Wordpress_Utility::uploadBits($this->context['id'] . '.css', $this->context['css'], array('vtcore-assets'));

      if (!$upload['error']) {
        $this->get('queues')->add($this->context['id'], TRUE);
        $this->get('library')
          ->add($this->context['id'] . '.css.' . $this->context['id'] . '.url', $upload['url']);
        $this->get('library')
          ->add($this->context['id'] . '.css.' . $this->context['id'] . '.path', $upload['file']);
      }
    }

    if (!empty($this->context['js'])) {
      $upload = VTCore_Wordpress_Utility::uploadBits($this->context['id'] . '.js', $this->context['js'], array('vtcore-assets'));

      if (!$upload['error']) {
        $this->get('queues')->add($this->context['id'], TRUE);
        $this->get('library')
          ->add($this->context['id'] . '.js.' . $this->context['id'] . '.url', $upload['url']);
        $this->get('library')
          ->add($this->context['id'] . '.js.' . $this->context['id'] . '.path', $upload['file']);

      }
    }

    // Add the compressed file map to compressed library
    // @bugfix compressed file never got removed
    $this->add('compressed.' . $this->hash, array(
      'id' => $this->context['id'],
      'assets' => $this->get('library')->get($this->context['id']),
    ));

    // free memory
    $this->context = array();
    unset($this->context);

    return $this;
  }


  /**
   * Method for dequeuing assets from wordpress queue
   * @return VTCore_Wordpress_Objects_Assets_Loader
   */
  public function dequeue($name, $js = TRUE, $css = TRUE) {

    if ($this->get('library')->get($name)) {
      foreach ($this->get('library')->get($name) as $type => $files) {
        foreach ($files as $filename => $file) {
          if ($type == 'css') {
            wp_dequeue_style($filename);
          }

          if ($type == 'js') {
            wp_dequeue_script($filename);
          }
        }
      }
    }

    return $this;
  }


  /**
   * Method ripped from drupal for fixing css relative path
   */
  public function fixCssPath($matches, $base = NULL) {

    // Store base path for preg_replace_callback.
    if (isset($base)) {
      $this->base = $base;
    }

    // Prefix with base and remove '../' segments where possible.
    $path = $this->base . $matches[1];
    $last = '';
    while ($path != $last) {
      $last = $path;
      $path = preg_replace('`(^|/)(?!\.\./)([^/]+)/\.\./`', '$1', $path);
    }
    return 'url(' . $path . ')';
  }


  /**
   * Minify the assets, ripped off from drupal 7
   *
   * @return VTCore_Wordpress_Factory_Assets
   */
  public function minify() {

    if (!empty($this->context['css'])) {
      $this->context['css'] = VTCore_CSSBuilder_Minify_CSS::minify($this->context['css']);
    }

    if (!empty($this->context['js'])) {
      $this->context['js'] = VTCore_CSSBuilder_Minify_JS::minify($this->context['js']);
    }

    return $this;
  }


  /**
   * Removing all compressed assets
   * This can only be invoked once per
   * page load as it is enough to clear
   * all cached file once.
   */
  public function clearCache() {

    if (self::$reset == false) {

      $upload = VTCore_Wordpress_Utility::getUploadDir(false);
      $files = glob($upload['basedir'] . DIRECTORY_SEPARATOR . 'vtcore-assets' . DIRECTORY_SEPARATOR . '*');

      foreach($files as $file) {
        if (is_file($file)) {
          unlink($file);
        }
      }

      $this->add('compressed', array());

      // Remove library asset cache
      if (is_object($this->get('library')) && method_exists($this->get('library'), 'delete')) {
        $this->get('library')->delete();
      }

      $this->save();

      // Lock this method up
      self::$reset = true;
    }

    return $this;
  }

}