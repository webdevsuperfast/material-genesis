<?php
/**
 * Scripts
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2016, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Theme Scripts & Stylesheet
add_action( 'wp_enqueue_scripts', 'gb_theme_scripts' );
function gb_theme_scripts() {
	$version = wp_get_theme()->Version;
	if ( !is_admin() ) {
		// 
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', GB_JS . 'jquery.min.js', array(), $version, true );
		wp_enqueue_script( 'jquery' );
		
		// Popper JS
		wp_register_script( 'popper-js', GB_JS . 'popper.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'popper-js' );

		// Bootstrap JS
		wp_register_script( 'bootstrap-js', GB_JS . 'bootstrap.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'bootstrap-js' );

		// Material Design Bootstrap JS
		wp_register_script( 'mdb-js', GB_JS . 'mdb.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'mdb-js' );

		// Theme JS
		wp_register_script( 'app-js', GB_JS . 'app.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'app-js' );

		//* Deregister SuperFish Scripts
		wp_deregister_script( 'superfish' );
		wp_deregister_script( 'superfish-args' );

		// Theme CSS
		wp_enqueue_style( 'app-css', GB_CSS . 'app.css' );
	}
}
