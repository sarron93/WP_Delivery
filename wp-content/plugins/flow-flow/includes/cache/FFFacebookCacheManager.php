<?php namespace flow\cache;
if ( ! defined( 'WPINC' ) ) die;

use flow\social\FFFeedUtils;

/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014 Looks Awesome
 */
class FFFacebookCacheManager {
    private static $postfix_at = 'la_facebook_access_token';
    private static $postfix_at_expires = 'la_facebook_access_token_expires';
    /** @var FFFacebookCacheManager */
    private static $instance = null;

	/**
	 * @param array $context
	 *
	 * @return FFFacebookCacheManager
	 */
    public static function get($context = null) {
        if ( null == self::$instance ) {
            self::$instance = new self($context);
        }
        return self::$instance;
    }

	/** @var LADBManager  */
	private $db = null;
	private $auth = null;
	private $error = null;
	private $access_token = null;

    public function __construct($context) {
	    $this->db = $context['db_manager'];
    }

	public function getError(){
		return $this->error;
	}

	public function clean(){
		$this->deleteOption($this->getNameExtendedAccessToken());
		$this->deleteOption($this->getNameExtendedAccessToken(true));
	}

	/**
     * @return string|bool
     */
    public function getAccessToken(){
	    if ($this->access_token != null) return $this->access_token;

		$at = $this->getNameExtendedAccessToken();
        if (false !== ($access_token_transient = $this->getOption($at))){
            $access_token = $access_token_transient;
        }
        else{
            $auth = $this->getAuth();
            $access_token = $auth['facebook_access_token'];
            if(!isset($access_token) || empty($access_token)){
	            $this->error = array(
		            'type'    => 'facebook',
		            'message' => 'Facebook access token is empty.'
	            );
                return false;
            }
        }
        $expires = $this->getOption($this->getNameExtendedAccessToken(true));
	    if ( $expires === false || time() > ($expires - 2629743) ){
            $auth = $this->getAuth();
            $facebookAppId = $auth['facebook_app_id'];
            $facebookAppSecret = $auth['facebook_app_secret'];
		    $access_token = $this->extendAccessToken($access_token, $facebookAppId, $facebookAppSecret);
        }
	    $this->access_token = $access_token;
        return $access_token;
    }

    private function extendAccessToken($access_token, $facebookAppId, $facebookAppSecret){
        $token_url="https://graph.facebook.com/oauth/access_token?client_id={$facebookAppId}&client_secret={$facebookAppSecret}&grant_type=fb_exchange_token&fb_exchange_token={$access_token}";
	    $settings = $this->db->getGeneralSettings();
        $response = FFFeedUtils::getFeedData($token_url, 200, false, true, $settings->useCurlFollowLocation(), $settings->useIPv4());
	    if (false !== $response['response']){
	        $response = (string)$response['response'];
	        $response = explode ('=',$response);
	        if (sizeof($response) > 2) $expires = (int)$response[2];
	        $access_token = explode ('&',$response[1]);
		    $this->updateOption($this->getNameExtendedAccessToken(), $access_token[0]);
		    $this->updateOption($this->getNameExtendedAccessToken(true), time() + ( isset($expires) ? $expires : 2629743 ));
		    return $access_token[0];
        }
	    else if (isset($response['errors'])) {
		    $error = $response['errors'][0];
		    $this->error = array(
			    'type'    => 'facebook',
			    'message' => $error['msg'],
			    'url' => $token_url
		    );
	    }
	    return false;
    }

	private function getNameExtendedAccessToken($expires = false){
		$auth = $this->getAuth();
		$facebookAppId = $auth['facebook_app_id'];
		$facebookAppSecret = $auth['facebook_app_secret'];
		$name = $expires ? self::$postfix_at_expires : self::$postfix_at;
		return $name . substr(hash('md5', $facebookAppId . $facebookAppSecret), 0, 6);
	}

	private function getAuth(){
		if (empty($this->auth)){
			$this->auth = $this->db->getOption('fb_auth_options', true);
		}
		return $this->auth;
	}

	private function getOption($name){
		return FF_USE_WP ? get_option($name) : $this->db->getOption($name);
	}

	private function updateOption($name, $value){
		FF_USE_WP ? update_option($name, $value) : $this->db->setOption($name, $value);
	}

	private function deleteOption($name){
		FF_USE_WP ? delete_option($name) : $this->db->deleteOption($name);
	}
}