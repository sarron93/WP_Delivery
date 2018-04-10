<?php namespace flow\cache;
if ( ! defined( 'WPINC' ) ) die;

use flow\db\FFDB;

/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014 Looks Awesome
 */
class FFImageSizeCacheManager {
	const FF_IMG_CACHE_SIZE = 1000;

    /**
     * @return void
     */
    public static function clean(){
	    try{
		    if (FFDB::beginTransaction()){
			    FFDB::conn()->query('DELETE FROM ?n', FF_IMAGE_SIZE_CACHE_TABLE_NAME);
			    FFDB::commit();
		    }
		    FFDB::rollback();
	    }catch (Exception $e){
		    FFDB::rollbackAndClose();
	    }
    }

	private static $instance = null;
    /**
     * @return FFImageSizeCacheManager
     */
    public static function get() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private $size;
    private $image_cache;
    private $new_images = array();

    function __construct() {
	    $sql = "SELECT `url`, `width`, `height`  FROM ?n ORDER BY `creation_time` DESC LIMIT ?i";

        if (false === ($result = FFDB::conn()->getIndCol('url', $sql, FF_IMAGE_SIZE_CACHE_TABLE_NAME, self::FF_IMG_CACHE_SIZE))) {
            $result = array();
        }
        $this->size = sizeof($result);
        $this->image_cache = $result;
    }

    /**
     * @param string $url
     * @return array
     */
    public function size($url){
        $h = hash('md5', $url);
        if (!array_key_exists($h, $this->image_cache)){
            try{
	            $time = date("Y-m-d H:i:s", time());
	            if ($url && !empty($url)) {
		            if (isset($_REQUEST['debug'])){
			            ini_set('upload_max_filesize', '16M');
			            ini_set('post_max_size', '16M');
			            ini_set('max_input_time', '60');
		            }
		            @list($width, $height) = getimagesize($url);
		            if (empty($width) || empty($height)){
		                @list($width, $height) = $this->alternativeGetImageSize($url);
			            if (empty($width) || empty($height)){
				            $width  = -1;
				            $height = -1;
			            }
		            }
		            $data = array('creation_time' => $time, 'width' => $width, 'height' => $height);
	            } else $data = array('creation_time' => $time, 'width' => -1, 'height' => -1);
	            if ($data['width'] > 0 && $data['height'] > 0){
		            $this->image_cache[$h] = $data;
		            $this->new_images[$h] = $data;
	            }
	            return $data;
            } catch (Exception $e) {
//	            error_log($url);
//	            error_log($e->getMessage());
//                error_log($e->getTraceAsString());
	            return array('time' => time(), 'width' => -1, 'height' => -1, 'error' => $e->getMessage());
            }
        }
        return $this->image_cache[$h];
    }


	/**
	 * @param array $result
	 * @return void
	 */
	private function removeOldRecords( $result ) {
		//TODO
	}

    /**
     * @return void
     */
    public function save() {
	    if (FFDB::beginTransaction()){

		    foreach ( $this->new_images as $url => $image ) {
			    FFDB::conn()->query('INSERT INTO ?n SET `url` = ?s, ?u ON DUPLICATE KEY UPDATE ?u',
				    FF_IMAGE_SIZE_CACHE_TABLE_NAME, $url, $image, array('creation_time' => $image['creation_time']));
	        }
		    FFDB::commit();
	    }
	    FFDB::rollback();
    }

	private function alternativeGetImageSize($url){
		$raw = $this->ranger($url);
		$im = imagecreatefromstring($raw);
		$width = imagesx($im);
		$height = imagesy($im);
		return array($width, $height);
	}

	private function ranger($url){
		$headers = array(
			"Range: bytes=0-32768"
		);

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}
}