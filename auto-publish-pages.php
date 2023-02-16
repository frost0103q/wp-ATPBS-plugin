<?php
/**
 * Plugin Name: Auto Publishing Pages Extension
 * Plugin URI: https://tutoringfinder.org
 * Description: Once select the base page, Allow auto-publishing pages by Rest API
 * Author: JFrost
 * Version: 1.0.0
 * Author URI: https://jfrostdev.com/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ATPBS_DIR_PATH' ) ) {
	define( 'ATPBS_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ATPBS_DIR_URL' ) ) {
	define( 'ATPBS_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'ATPBS_VERSION' ) ) {
	define( 'ATPBS_VERSION', '1.0.0' );
}

if ( ! defined( 'ATPBS_TEXT_DOMAIN' ) ) {
	define( 'ATPBS_TEXT_DOMAIN', 'atpbs' );
}

if ( file_exists( ATPBS_DIR_PATH . 'includes/class-atpbs-init.php' ) ) {
	$main = require_once ATPBS_DIR_PATH . 'includes/class-atpbs-init.php';
	new $main();
}
