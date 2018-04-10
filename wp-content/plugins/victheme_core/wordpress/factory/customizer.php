<?php
/**
 * Customizer Factory Class
 * This class is for pooling all arrays of configuration
 * meant to be passed to Wordpress Customizer
 *
 * Valid array structure example
 *
 * $options['settings'][{setting_name}] = array(
 *   'object' => 'setting_class_name' or false to use the default settings
 *   'default' => 'setting default value',
 *   'transport' => 'setting transport',
 *   'capability' => 'setting capability',
 *   'priority' => 'setting weight',
 * );
 *
 * Other setting keys will be passed on without filtering.
 *
 * $options['controls'][{control_name}] = array(
 *   'object' => 'control_class_name' or false to use default controller
 *   'label' => 'control label text',
 *   'section' => 'control section',
 *   'priority' => 'control weight',
 *   'type' => 'control type',
 * );
 *
 * Other control options such as choices will be passed on without filtering.
 *
 * $options['panels'][{panel_name}] = array(
 *   'title' => 'panel title text',
 *   'capability' => 'panel capability',
 *   'description' => 'panel description',
 *   'priority' => 'panel weight',
 * );
 *
 * Other panel options will be passed on without filtering.
 *
 * $options['sections'][{section_name}] = array(
 *   'title' => 'section title text',
 *   'panel' => 'valid panel id'
 *   'capability' => 'panel capability',
 *   'priority' => 'panel weight',
 * );
 *
 * Other panel options will be passed on without filtering.
 *
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Wordpress_Factory_Customizer
extends VTCore_Wordpress_Models_Config {

  protected $filter = 'vtcore_wordpress_customizer_registry_alter';
  protected $database = 'vtcore_customizer_array';
  protected $options = array();



  /**
   * Overriding parent method
   * @param array $options
   */
  protected function register(array $options) {
    $this->options = $options;

    // Increase the memory limit temporarily
    ini_set('memory_limit', '128M');
  }

  public function process($customizer) {
    // Apply the filter
    $this->filter();

    foreach (array_keys($this->options) as $key) {
      // Build Panel
      if ($this->get($key . '.panels')) {
        foreach ($this->get($key . '.panels') as $id => $options) {
          $customizer->add_panel($id, $options);
        }
      }

      // Build Sections
      if ($this->get($key . '.sections')) {
        foreach ($this->get($key . '.sections') as $id => $options) {
          $customizer->add_section($id, $options);
        }
      }


      // Build Settings
      if ($this->get($key . '.settings')) {
        foreach ($this->get($key . '.settings') as $id => $options) {
          if (isset($options['object'])
            && $options['object'] != FALSE
            && class_exists($options['object'], TRUE)
          ) {

            $name = $options['object'];
            $customizer->add_setting(new $name($customizer, $id, $options));
          }
          else {
            $customizer->add_setting($id, $options);
          }
        }
      }

      // Build Controls
      if ($this->get($key . '.controls')) {
        foreach ($this->get($key . '.controls') as $id => $options) {
          if (isset($options['object'])
            && $options['object'] != FALSE
            && class_exists($options['object'], TRUE)
          ) {

            $name = $options['object'];
            $customizer->add_control(new $name($customizer, $id, $options));
          }
          else {
            $customizer->add_control($id, $options);
          }
        }
      }

      // Build Pointers
      if ($this->get($key . '.pointers')) {
        foreach ($this->get($key . '.pointers') as $id => $options) {
          $customizer->get_control($id)->json['pointer'] = $options;
        }
      }
    }

    return $this;

  }

  /**
   * Method for freeing memory by destroying the options array.
   * @return $this
   */
  public function clear() {
    $this->options = array();
    unset($this->options);

    return $this;
  }




}