<?php namespace flow\tabs;
if ( ! defined( 'WPINC' ) ) die;

use \LAClassLoader;

/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2015 Looks Awesome
 */
class FFAuthTab implements LATab {
	public function __construct() {
	}

	public function id() {
		return 'auth-tab';
	}

	public function flaticon() {
		return 'flaticon-user';
	}

	public function title() {
		return 'Auth';
	}

	public function includeOnce( $context ) {
		LAClassLoader::get()->includeOnceView('auth', $context);
	}
}