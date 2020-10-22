<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes Controller - Translation
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerTranslation' ) )
{

	class enscControllerTranslation
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $file;

		private $global;

		private $domain;

		private $assets;

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

			$this->file   = $this->global->getFile();

			$this->domain = $this->global->getDomain();

			$this->assets = trailingslashit( plugin_basename( dirname( $this->file ) ) ) . 'assets/';

			/**
			 * Start Translation
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Load the textdomains
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			$locale = apply_filters( 'ensc_translation_locale', get_locale(), $this->domain );

			load_textdomain( $this->domain, WP_LANG_DIR . '/plugins/' . $this->domain . '-' . $locale . '.mo' );

			load_plugin_textdomain( $this->domain, false, $this->assets . 'lang/' );

		} // end initialize
	} // end class
} // end if
