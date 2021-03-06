<?php namespace flow\cache;
if ( ! defined( 'WPINC' ) ) die;
/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2015 Looks Awesome
 */
interface FFCache {
	/**
	 * @param FFStreamSettings $stream
	 * @return void
	 */
	public function setStream($stream);
	public function posts($feeds, $disableCache);
	public function errors();
	public function hash();
	public function transientHash($streamId);
	public function moderate();
}