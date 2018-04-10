<?php
/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2015 Looks Awesome
 */
class LAClassLoader {
	private static $instance = null;

	public static function get($root = null) {
		if(self::$instance == null) {
			self::$instance = new LAClassLoader($root);
		}
		return self::$instance;
	}

	private $root;
	private $views;
	private $migrations;

	private function __construct($root) {
		$this->root = $root;
		$classes = file_get_contents($this->root . 'classes.json');
		$classes = json_decode($classes, true);
		$this->views = $classes['views'];
		$this->migrations = $classes['migrations'];
	}

	public function includeView($viewName, $context = null){
		/** @noinspection PhpIncludeInspection */
		include($this->root  . $this->views[$viewName]);
	}

	public function includeOnceView($viewName, $context = null){
		/** @noinspection PhpIncludeInspection */
		include_once($this->root . $this->views[$viewName]);
	}

	public function loadClass($className) {
	    if (0 === strpos($className, 'flow')){
			$path = $this->root . 'includes';
			$cls = str_replace('flow', $path, $className);
			$path = str_replace('\\', DIRECTORY_SEPARATOR, $cls) . '.php';
			/** @noinspection PhpIncludeInspection */
			require_once($path);
		}
	}

	public function migrations(){
		$result = array();
		foreach ( $this->migrations as $class => $migration ) {
			$result[] = 'flow\\db\\migrations\\' . $class;
		}
		return $result;
	}

	public function register($with_config = false) {
		if ($with_config) {
			require_once($this->root . 'ff-config.php');
			require_once($this->root . 'ff-init.php');
		}
		spl_autoload_register(array(self::get(), 'loadClass'));
	}

	/**
	 * @return mixed
	 */
	public function getRoot() {
		return $this->root;
	}
} 