<?php
/*
 * Plugin Name: Infographic
 * Plugin URI: http://wordpress.org/plugins/equal-height-columns
 * Description: Super simple, totally responsive equal height columns.
 * Version: 0.9.0
 * Author: MIGHTYminnow
 * Author URI: http://mightyminnow.com
 * License:     GPLv2+
 * Text Domain: ehc
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Mickey Kay & MIGHTYminnow (email : mickey@mightyminnow.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class InfographicPlugin {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Infographic';
	const slug = 'infographic';
	const version = '0.9.0';

	/*--------------------------------------------*
	 * Properties
	 *--------------------------------------------*/
	private static $instance;

	/*
	 * Get instance function for hooking into plugin
	 */
	public static function get_instance() {
		if( ! is_object( self::$instance ) ) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	function __construct() {
		// Register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'activate' ) );

		// Load text domain
		add_action( 'plugins_loaded', array( &$this, 'load_text_domain' ) );

		// Add TinyMCE
		add_action( 'admin_head', array( &$this, 'add_mce_button' ) );


		// Do scripts and styles
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_scripts_and_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts_and_styles' ) );

	}

	/**
	 * Runs when the plugin is activated
	 */  
	function activate() {
		// do not generate any output here
	}

	/**
	 * Load text domain
	 */
	function load_text_domain() {
		load_plugin_textdomain( self::slug, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/*
	 * Add TinyMCE button
	 */
	function add_mce_button() {
		// Check user permissions
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		// Check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( &$this, 'add_mce_plugin' ) );
			add_filter( 'mce_buttons', array( &$this, 'register_mce_button' ) );
		}
	}

	/*
	 * Add TinyMCE plugin
	 */
	function add_mce_plugin( $plugin_array ) {
		$plugin_array['infographic_mce_button'] = plugins_url( '/js/infographic-mce-plugin.js' , __FILE__ );
		return $plugin_array;
	}

	/*
	 * Register TinyMCE button
	 */
	function register_mce_button( $buttons ) {
		array_push( $buttons, 'infographic_mce_button' );
		return $buttons;
	}

	/**
	 * Register front-end styles & scripts
	 */
	function register_scripts_and_styles() {
		// Require jQuery to work
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Register admin styles & scripts
	 */
	function register_admin_scripts_and_styles() {
		
	}

}
$infographic_plugin_object = InfographicPlugin::get_instance();