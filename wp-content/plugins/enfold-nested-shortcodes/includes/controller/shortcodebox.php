<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Shortcodebox
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerShortcodebox' ) )
{

	class enscControllerShortcodebox
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $assets;

		private $prefix;

		private $suffix;

		private $version;

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct( $edit = false )
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
			$this->global  = $enscInstanceObj;

			$this->prefix  = $this->global->getPrefix();

			$this->suffix  = $this->global->getSuffix();

			$this->version = $this->global->getVersion();

			$this->assets  = $this->global->getAssetsURL();

			/**
			 * Initialize
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Set style
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			add_action( 'admin_enqueue_scripts', array( $this, 'style' ) );

		} // end initialize

		/**
		 * Add style to the admin area
		 *
		 * @since 1.0.0
		 */
		public function style()
		{

			$slug = $this->prefix . '-post';

			wp_enqueue_style( $slug, $this->assets . 'css/' . $slug . $this->suffix . '.css', array(), $this->version, 'all' );

		} // end style
	} // end class
} // end if
