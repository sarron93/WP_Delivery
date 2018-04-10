<?php namespace flow\social\timelines;
if ( ! defined( 'WPINC' ) ) die;
/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014 Looks Awesome
 */
interface FFTimeline {
    public function init($stream, $feed);
    public function getUrl();
    public function getField();
}