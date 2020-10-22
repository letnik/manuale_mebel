<?php
/*
Plugin Name: Enfold - Nested Shortcodes
Plugin URI: https://ensc.indikator-design.de/enfold-nested-shortcodes-documentation-and-faq/
Description: Enfold - Nested Shortcodes gives you the possibility to nest Enfold shortcodes in a very simple and comfortable way.
Version: 1.0.0
Author: Bruno Bouyajdad | Indikator Design
Author URI: https://indikator-design.de
Author Email: info@indikator-design.de
Text Domain: enfold-nested-shortcodes
Domain Path: /assets/lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2016 Bruno Bouyajdad (http://indikator-design.de, info@indikator-design.de)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );


/**
 * Enfold - Nested Shortcodes - Initialize
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscPluginInitialize' ) )
{

	class enscPluginInitialize
	{

		/**
		 * Define plugin prefix
		 *
		 * @since	1.0.0
		 */
		const PREFIX  = 'ensc';

		/**
		 * Define plugin version
		 *
		 * @since	1.0.0
		 */
		const VERSION = '1.0.0';

		/**
		 * Define this file
		 *
		 * @since	1.0.0
		 */
		const FILE    = __FILE__;

		/**
		 * Define envato id
		 *
		 * @since	1.0.0
		 */
		const ITEMID  = '19305825';

		/**
		 * Define ENSC Textdomain
		 *
		 * @since	1.0.0
		 */
		const DOMAIN  = 'enfold-nested-shortcodes';

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct()
		{

			/**
			 * Include autoloader
			 *
			 * @since	1.0.0
			 */
			require_once( trailingslashit( plugin_dir_path( self::FILE ) ) . 'includes/controller/autoloader.php' );

			new enscControllerAutoloader( self::FILE, self::PREFIX, 'includes' );

			/**
			 * Instanciate the plugin
			 *
			 * @since	1.0.0
			 */
			$GLOBALS['enscInstanceObj'] = new enscControllerInitialize();

		} // end constructor
	} // end class
} // end if

new enscPluginInitialize();

