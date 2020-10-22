<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Adminscript
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerAdminscript' ) )
{

	class enscControllerAdminscript
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $edit;

		private $hooks;

		private $global;

		private $domain;

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
			$this->edit    = $edit;

			$this->global  = $enscInstanceObj;

			$this->domain  = $this->global->getDomain();

			$this->prefix  = $this->global->getPrefix();

			$this->suffix  = $this->global->getSuffix();

			$this->version = $this->global->getVersion();

			$this->assets  = $this->global->getAssetsURL();

			$this->hooks   = $this->edit ? array( 'edit.php' ) : array( 'post-new.php', 'post.php' );

			/**
			 * Start Metaboxes
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Add Settings Metabox, Style and Script
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			add_action( 'admin_enqueue_scripts', array( $this, 'style' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'script' ) );

			// add_action( 'admin_footer', array( $this, 'script' ), PHP_INT_MAX );

			foreach ( $this->hooks as $hook )
			{

				add_action( "admin_head-{$hook}", function() { $this->scriptLocalize(); });

			} // end foreach
		} // end initialize

		/**
		 * Add style for the admin page
		 *
		 * @since 1.0.0
		 */
		public function style()
		{

			$slug = $this->prefix . ( $this->edit ? '-edit' : '-meta' );

			wp_enqueue_style( $slug, $this->assets . 'css/' . $slug . $this->suffix . '.css', array(), $this->version, 'all' );

		} // end style

		/**
		 * Add script for the admin page
		 *
		 * @since 1.0.0
		 */
		public function script()
		{

			$slug = $this->prefix . '-meta';

			wp_enqueue_script( $slug, $this->assets . 'js/' . $slug . $this->suffix . '.js', array( 'jquery' ), $this->version, 'all', true );

		} // end script

		/**
		 * Localize script
		 *
		 * @since	1.0.0
		 */
		public function scriptLocalize()
		{

			$enscPHPmb = array(

				'copy'   => esc_html__( 'Copy', $this->domain ),
				'copied' => esc_html__( 'Copied to clipboard', $this->domain ),
				'desc'   => esc_html__( 'Press CMD + C on the Mac, or STRG + C on Windows', $this->domain ),

			);

			?>

				<script type='text/javascript'>var enscPHPmb = <?php echo json_encode( $enscPHPmb ) ?>;</script>

			<?php

		} // end scriptLocalize
	} // end class
} // end if
