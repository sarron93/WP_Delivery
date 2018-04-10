<?php
/**
 * Class for encapsulating updater factory
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Wordpress_Factory_Updater
extends VTCore_Wordpress_Models_Config {

  protected $database = 'vtcore_updater_map';
  protected $filter = false;
  protected $current = '';
  protected $options = array();

  /**
   * Overloading parent method.
   * @param array $options
   * @return void|VTCore_Wordpress_Config_Base
   */
  protected function register(array $options) {
    $this->load();
  }

  /**
   * Method for overloading the object and invoke
   * the plugin updater.
   *
   * @param VTCore_Wordpress_Models_Updater $object
   */
  public function execute(array $plugin) {

    if (!isset($plugin['version'])
      || !isset($plugin['plugin'])
      || !isset($plugin['object'])) {
      return $this;
    }

    $plugin['version'] = $this->sanitizeVersion($plugin['version']);
    $this->current = $plugin['plugin'] . '.' . $plugin['version'];

    if ($this->get($this->current) == false) {

      // @performance loading object will invoke disk access
      // Avoid it as much as possible.
      if (class_exists($plugin['object'])) {

        $object = new $plugin['object']();
        if ($object->execute($plugin['version'])) {
          $object = NULL;
          unset($object);

          // Mark update is performed
          $this->add($this->current, TRUE);
          $this->save();
        }
      }
    }

    return $this;

  }

  /**
   * Sanitizing method name as per PHP class method name
   * @param $method
   * @return mixed
   */
  final protected function sanitizeVersion($method) {
    return str_replace(array('.'), array('_'), $method);
  }

}