<?php
/**
 * Class for managing asset library information
 * This class will auto cache the library information
 * array to database to save performance.
 *
 * To clear the cache please invoke the delete() method
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Objects_Library
extends VTCore_Wordpress_Models_Config {

  protected $options = array();
  protected $database = '';
  protected $filter = '';

  private $hash;
  private $allowed = array();


  protected function register(array $options) {
    $this->options = array(
      'cache' => array(),
    );

    $this->load();
  }


  /**
   * Method for iterating to user specified folders
   * and scan for proper asset files.
   *
   * This method respect caching system to avoid
   * expensive directory iterators multiple time

   * @return VTCore_Wordpress_Objects_Library
   */
  public function detect($path, $base) {

    $this->hash = md5($path . $base);

    if (!$this->get('cache.' . $this->hash) || (defined('WP_DEBUG') && WP_DEBUG) || (defined('VTCORE_CLEAR_CACHE') && VTCORE_CLEAR_CACHE)) {

      $directories = new RecursiveDirectoryIterator($path);

      foreach (new RecursiveIteratorIterator($directories) as $file) {

        $ext = pathinfo($file->getFilename(), PATHINFO_EXTENSION);

        if (in_array($ext,  $this->allowed)) {

          $this->add($directories->getSubPathname() . '.' . $ext . '.' . pathinfo(str_replace(array('.', '#'), '-', $file->getFilename()), PATHINFO_FILENAME), array(
            'url' => $base . '/' . $directories->getSubPathname() . '/' . $ext . '/' . $file->getFilename(),
            'path' => $path . DIRECTORY_SEPARATOR . $directories->getSubPathName() . DIRECTORY_SEPARATOR . $ext . DIRECTORY_SEPARATOR . $file->getFilename(),
          ));
        }
      }

      $this->add('cache.' . $this->hash, true);

      $this->save();
    }

    return $this;
  }




  /**
   * Allow user to change the trapped file extension
   */
  public function allowed($allowed) {
    $this->allowed = (array) $allowed;
    return $this;
  }




  /**
   * Allow user to change the database name for caching the result
   */
  public function database($database) {
    $this->database = $database;
    return $this;
  }

}