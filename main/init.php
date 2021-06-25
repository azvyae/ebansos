<?php 

require_once "../esubsidi/config/config.php";
// require_once "../esubsidi/faker/src/autoload.php";

spl_autoload_register( function( $class ) {

	# namespace prefix that we will use for autoloading the appropriate classes and ignoring others
	$prefix = '';

	# base directory where our project's files reside
	$base_dir = dirname(__DIR__, 1);
    $base_dir .= '/';
	/**
	 * Does the class being called use our specific namespace prefix?
	 *
	 *  - Compare the first {$len} characters of the class name against our prefix
	 *  - If no match, move to the next registered autoloader in the system (if any)
	 */

	# character length of our prefix
	$len = strlen( $prefix );

	# if the first {$len} characters don't match
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}

	# get the name of the class after our prefix has been peeled off
	$class_name = str_replace( $prefix, '', $class );

	/**
	 * Perform normalizing operations on the namespace/class string in order to get the file name to be required
	 *
	 * - Replace namespace separators with directory separators in the class name
	 * - Prepend the base directory
	 * - Append with .php
	 */
	$file = $base_dir . str_replace('\\', '/', strtolower($class_name) ) . '.php';
	# require the file if it exists
	if( file_exists( $file ) ) {
		require_once $file;
	}

}); # end: spl_autoload_register()