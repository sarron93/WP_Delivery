<?php
/**
 * The main core utility class for misc utility
 * methods that is not belong anywhere else.
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Utility {

	private static $files;



	/**
	 * Function to scan directories for files
	 */
	static function scanDirectory($dir, $mask, $recurse = TRUE, $reset = FALSE) {

		// Return on invalid directory to avoid exception error.
		if (!is_dir($dir)) {
			return array();
		}

		if (!isset(self::$files[$dir][$mask]) || $reset == true) {
			$scans = $recurse ? new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) : new DirectoryIterator($dir);
			$scans = new RegexIterator($scans, $mask);

			$files = array();

			foreach ($scans as $scan) {
				$filename = $scan->getFilename();

				if ($filename == '.' || $filename == '..') {
					continue;
				}

				$file = new stdClass();
				$file->path = self::backSlashIt($scan->getPathname());
				$file->directory = self::backSlashIt(dirname($file->path));
				$file->filename = $filename;
				$file->name = self::backSlashIt(pathinfo($file->filename, PATHINFO_FILENAME));
				$files[$file->path] = $file;
			}

			self::$files[$dir][$mask] = $files;
		}

		return self::$files[$dir][$mask];
	}




	/**
	 * Function to merge two arrays and update the value for the second array
	 * using the value of the first array.
	 */
	static function arrayMergeRecursiveDistinct(&$args, &$defaults) {

      $merged = $defaults;

      unset($defaults);

      if (!is_array($args) || $args === array()) {
        unset($args);
        return $merged;
      }

      foreach ($args as $key => &$value) {

        // Special case for class just merge the entry by adding them
        if ($key === 'class' && isset($merged['class'])) {
          $merged['class'] = array_merge((array) $value, (array) $merged['class']);
          $merged['class'] = array_unique($merged['class']);
        }

        elseif (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
          $merged[$key] = self::arrayMergeRecursiveDistinct($value, $merged[$key]);
        }

        else {
          $merged[$key] = $value;
        }

        unset($value);
      }

      unset($args);
      return $merged;
	}




	/**
	 * Helper function to convert to backslash
	 */
	static function backSlashIt($string) {
		return str_replace('\\', '/', $string);
	}



	/**
	 * Fixed serialized string
	 */
	static public function fixSerialString($string) {
	  return preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $string);
	}



	/**
	 * Check if string is serialized and unserialize them
	 * @seems not working properly?
	 */
	static public function maybeUnserialize($string) {
	  if (is_serialized_string($string)) {
	    $string = unserialize(self::fixSerialString($string));
	  }

	  return $string;
	}





	/**
	 * Function for searching array value by key
	 */
	static function searchArrayValueByKey(array $array, $search) {
	  foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array), RecursiveIteratorIterator::SELF_FIRST) as $key => $value) {
	    if ($search === $key) {
	      return $value;
	    }
	  }
	  return NULL;
	}





	/**
	 * Function for removing array value by key
	 */
	static function removeArrayValueByKey(array $array, $search) {
	  $array = new ArrayObject($array);
	  $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array), RecursiveIteratorIterator::CHILD_FIRST);
	  foreach ($iterator as $key => $value) {
	    if ($search === $key) {
	      $iterator->offsetUnset($key);
	    }
	  }
	  return $array->getArrayCopy();
	}





	/**
	 * Function for removing empty array value
	 * this will remove all value that is true to empty()
	 * including string '', boolean false, null.
	 */
	static function arrayFilterEmpty(array $array) {
    foreach ($array as &$value) {
      if (is_array($value)) {
        $value = self::arrayFilterEmpty($value);
      }
    }

    return array_filter($array, array('VTCore_Utility', 'checkEmpty'));
	}



	/**
	 * Helper function for checking empty value
	 * this is meant to be paired with arrayFilterEmpty()
	 * function
	 */
	static function checkEmpty($value) {
	  return !empty($value);
	}



	/**
	 * Function for update or setting array value by key
	 */
	static function setArrayValueByKey(array $array, $key, $value) {
	  $array = new ArrayObject($array);
	  $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array), RecursiveIteratorIterator::CHILD_FIRST);
	  foreach ($iterator as $delta => $data) {
	    if ($key == $delta) {
	      $iterator->offsetSet($delta, $value);
	    }
	  }

	  return $array->getArrayCopy();
	}


	/**
	 * Function for update or setting array value by keys
	 * of array keys
	 *
	 * it supports dotted and hashed drilling.
	 * example :
	 *   arraykey.arraykey2.arraykey3
	 *   or
	 *   arraykey#arraykey2#arraykey3
	 *
	 *   is equal to
	 *   array(arraykey, arraykey2, arraykey3)
	 */
	static function setArrayValueKeys(array &$array, $paths, $value) {

	  if (is_string($paths)) {
	    // Support dotted drilling
	    if (strpos($paths, '.') !== false) {
	      $paths = explode('.', $paths);
	    }
	    // Support dashed drilling
	    elseif (strpos($paths, '#') !== false) {
	      $paths = explode('#', $paths);
	    }
	  }

	  $paths = (array) $paths;
	  $pathCount = count($paths);
	  $node = &$array;


	  for ($i=0; $i < $pathCount; $i++) {

	    $path = $paths[$i];

	    if (!array_key_exists($path, (array) $node)) {
	      $node[$path] = array();
	    }

        if ($i == $pathCount - 1) {
          $node[$path] = $value;
        }
        else {
          $node = &$node[$path];
        }
	  }

	  unset($node);

	  return $array;
	}





	/**
	 * Function for remove array value defining
	 * a hierarchical array keys
	 *
	 * This method will only remove the leave end
	 * of the hiearchical point
	 *
	 * it supports dotted and hashed drilling.
	 * example :
	 *   arraykey.arraykey2.arraykey3
	 *   or
	 *   arraykey#arraykey2#arraykey3
	 *
	 *   is equal to
	 *   array(arraykey, arraykey2, arraykey3)
	 */
	static function removeArrayValueKeys(array &$array, $paths) {

	  if (is_string($paths)) {
	    // Support dotted drilling
	    if (strpos($paths, '.') !== false) {
	      $paths = explode('.', $paths);
	    }
	    // Support dashed drilling
	    elseif (strpos($paths, '#') !== false) {
	      $paths = explode('#', $paths);
	    }
	  }

	  $paths = (array) $paths;
	  $pathCount = count($paths);
	  $node = &$array;

	  for ($i=0; $i < $pathCount; $i++) {

	    $path = $paths[$i];

	    if (!is_array($node) || !array_key_exists($path, $node)) {
	      break;
	    }

	    if ($i == $pathCount - 1) {
	      unset($node[$path]);
	    }
	    else {
	      $node = &$node[$path];
	    }
	  }

	  unset($node);

	  return $array;
	}




	/**
	 * Function for retrieving array value by keys
	 * of array keys
	 *
	 * it supports dotted and hashed drilling.
	 * example :
	 *   arraykey.arraykey2.arraykey3
	 *   or
	 *   arraykey#arraykey2#arraykey3
	 *
	 *   is equal to
	 *   array(arraykey, arraykey2, arraykey3)
	 */
	static function getArrayValueKeys(array $array, $paths) {

	  if (is_string($paths)) {
	    // Support dotted drilling
	    if (strpos($paths, '.') !== false) {
	      $paths = explode('.', $paths);
	    }
	    // Support dashed drilling
	    elseif (strpos($paths, '#') !== false) {
	      $paths = explode('#', $paths);
	    }
	  }

	  $paths = (array) $paths;
	  $pathCount = count($paths);
	  $node = $array;

	  for ($i=0; $i < $pathCount; $i++) {

	    $path = $paths[$i];

	  	if (!is_array($node) || !array_key_exists($path, $node)) {
	      $node = NULL;
	      break;
	    }

	    $node = $node[$path];
	  }

	  return $node;

	}


	/**
	 * Function for prepending a value at the front of an array and
	 * preserve the array key.
	 */
	static function arrayUnshiftAssoc(&$arr, $key, $val) {
	  $arr = array_reverse($arr, true);
	  $arr[$key] = $val;
	  return array_reverse($arr, true);
	}



	/**
	 * Function for recursively converting to true booleans
	 *
	 * Will convert :
	 * (string) 'true' to (boolean) true
	 * (string) 'false' to (boolean) false
	 * (string) '1' to (boolean) true
	 * (string) '0' to (boolean) false
	 */
	static function convertBooleans(array &$array) {

	  foreach ($array as $delta => &$value) {

	    if ($value === '0' || $value === 'false') {
	      $value = false;
	    }

	    elseif ($value === '1' || $value === 'true') {
	      $value = true;
	    }

	    elseif (is_array($value)) {
	      self::convertBooleans($value);
	    }
	  }

	  return $array;
	}
}