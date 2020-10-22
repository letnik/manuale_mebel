<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Shortcodes
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerShortcodes' ) )
{

	class enscControllerShortcodes
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $prefix;

		private $domain;

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct()
		{

			/**
			 * Get global enscObj
			 *
			 * @since 1.0.0
			 */
			global $enscInstanceObj;

			/**
			 * Set properties
			 *
			 * @since 1.0.0
			 */
			$this->global = $enscInstanceObj;

			$this->prefix = $this->global->getPrefix();

			$this->domain = $this->global->getDomain();

			/**
			 * Start Shortcoodes
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Set shortcodes
		 *
		 * @since 1.0.0
		 */
		private function initialize()
		{

			add_shortcode( $this->prefix, function( $atts )
			{

				$args = array( 'title' => '' );

				$atts = shortcode_atts( $args, $atts );

				if ( empty( $atts['title'] ) ) return;

				$error = '<p>' . esc_html__( 'Please check your used title..', $this->domain ) . '</p>';

				return ( $sc = ( new enscModelGetdata )->shortcodeTransient( $atts['title'] ) ) ? do_shortcode( $sc ) : $error;

			}); // end add_shortcode
		} // end initialize
	} // end class
} // end if
