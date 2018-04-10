<?php
/**
 * Page callback class for building the VicTheme Core
 * configuration page
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Pages_Config
extends VTCore_Wordpress_Models_Page {



  protected function register() {
    $this->headerText = __('VicTheme Core - Configuration', 'victheme_core');
    $this->headerIcon = 'dashboard';
    $this->saveKey = 'vtcore-save';
    $this->resetKey = 'vtcore-reset';
    $this->actionHeaderKey = 'vtcore-configuration-header-alter';
    $this->actionFormKey = 'vtcore-configuration-form-alter';
  }

  protected function loadAssets() {
    wp_deregister_script('heartbeat');
    VTCore_Wordpress_Utility::loadAsset('wp-bootstrap');
    VTCore_Wordpress_Utility::loadAsset('wp-page');
    VTCore_Wordpress_Utility::loadAsset('bootstrap-confirmation');
  }

  public function renderAjax($post) {
    return false;
  }

  protected function save() {
    $this->messages->setNotice(__('All Core related cached deleted', 'victheme_core'));

    // Just promise to delete on next page load
    update_option('vtcore_clear_cache', true);
  }

  protected function reset() {
    return $this;
  }


  public function buildPage() {
    if (isset($_POST['compress-core'])) {
      $this->compressCore();
    }

    parent::buildPage();
  }


  protected function buildForm() {

    $this->form = new VTCore_Bootstrap_Form_BsInstance(array(
      'attributes' => array(
        'id' => 'vtcore-configuration-form',
        'method' => 'post',
        'action' => $_SERVER['REQUEST_URI'],
        'class' => array('container-fluid', 'vtcore-configuration-form-skins'),
        'autocomplete' => 'off',
      ),
    ));

    $this->form
      ->addChildren(new VTCore_Bootstrap_Element_BsPanel(array(
        'text' => __('Performance', 'victheme_core'),
      )))
      ->lastChild()
      ->addContent(new VTCore_Bootstrap_Form_BsDescription(array(
        'text' => __('Caching core will be performed automatically, you can force to clear the cache by clicking the clear cache button', 'victheme_core'),
      )))
      ->addContent(new VTCore_Bootstrap_Form_BsSubmit(array(
        'attributes' => array(
          'name' => $this->saveKey,
          'value' => __('Clear Cache', 'victheme_core'),
        ),
        'mode' => 'danger',
        'confirmation' => true,
        'title' => __('Are you sure?', 'victheme_core'),
        'ok' => __('Yes', 'victheme_core'),
        'cancel' => __('No', 'victheme_core'),
      )));


    /** Experimental
    $this->form
      ->addChildren(new VTCore_Bootstrap_Element_BsPanel(array(
        'text' => __('Merge & Compressed Core Class', 'victheme_core'),
      )))
      ->lastChild()
      ->addContent(new VTCore_Bootstrap_Form_BsDescription(array(
        'text' => __('Merging core class into a single class can improve page loading but it can increase the memory used when loading the page. Please make sure
                      that your server has high memory limit set and PHP is allowed to write into the plugin folder.', 'victheme_core'),
      )))
      ->addContent(new VTCore_Bootstrap_Form_BsSubmit(array(
        'attributes' => array(
          'name' => 'compress-core',
          'value' => __('Compress', 'victheme_core'),
        ),
        'mode' => 'danger',
        'confirmation' => true,
        'title' => __('Are you sure?', 'victheme_core'),
        'ok' => __('Yes', 'victheme_core'),
        'cancel' => __('No', 'victheme_core'),
      )));
     */

  }

  /**
   * Method for joining multiple smaller classes found in each directory
   * into a single large file with multiple classes.
   *
   * Not all files can be merged especially one that is extending another
   * class.
   *
   * Only list directory that is safe to be combined.
   *
   * @experimental Do not use this yet!
   */
  protected function compressCore() {
    $paths = array(
      'compressed-html.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'html',
      'compressed-form.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'form',
      'compressed-socialshare.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'socialshare',
      'compressed-validator.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'validator',
      'compressed-cssbuilder.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'cssbuilder',
      // 'compressed-bootstrap.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vtcore' . DIRECTORY_SEPARATOR . 'bootstrap',
      // 'compressed-wordpress.php' => VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'wordpress',
    );

    foreach ($paths as $filename => $path) {
      $directories = new RecursiveDirectoryIterator($path);
      $content = '';
      foreach (new RecursiveIteratorIterator($directories) as $file) {
        $ext = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
        if ($ext != 'php') {
          continue;
        }

        $content .= file_get_contents($file->getRealPath()) . "\n?>\n";
      }

      if (!empty($content)) {
        $fileTarget = fopen(VTCORE_CORE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'compressed' . DIRECTORY_SEPARATOR . $filename, w);
        fwrite($fileTarget, $content);
        fclose($fileTarget);
      }

    }
  }

}