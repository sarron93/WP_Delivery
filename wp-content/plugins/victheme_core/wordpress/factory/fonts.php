<?php
/**
 * Class for managing VTCore Assets libraries
 * Centralizing the assets record so other plugin
 * can just load the asset by folder name.
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Wordpress_Factory_Fonts
implements VTCore_Wordpress_Interfaces_Factory {

  protected $googleFonts;

  public function __construct() {

    // Check if we should bypass caching
    $this->maybeByPassCache();

    $this->loadCache();

    if (empty($this->googleFonts)) {
      $this->googleFonts = new VTCore_Wordpress_Data_Google_Fonts();
      set_transient('vtcore_google_fonts_cache', $this->googleFonts, 12 * HOUR_IN_SECONDS);
    }

    return $this;
  }


  public function __call($method, $context) {
    if (is_a($this->googleFonts, 'VTCore_Wordpress_Data_Google_Fonts')
        && method_exists($this->googleFonts, $method)) {

      return call_user_func_array(array($this->googleFonts, $method), $context);
    }
  }



   /**
    * Method for checking if we should bypass cache
    * @return VTCore_Wordpress_Factory_Assets
    */
   public function maybeByPassCache() {

     if (defined('VTCORE_CLEAR_CACHE') && VTCORE_CLEAR_CACHE) {
       $this->clearCache();
     }

     return $this;
   }



   /**
    * Load compressed asset from cache
    * @return VTCore_Wordpress_Objects_Assets_Loader
    */
   public function loadCache() {
     $this->googleFonts = get_transient('vtcore_google_fonts_cache');
     return $this;
   }



   /**
    * Removing all compressed assets
    */
   public function clearCache() {
     delete_transient('vtcore_google_fonts_cache');
     return $this;
   }

}