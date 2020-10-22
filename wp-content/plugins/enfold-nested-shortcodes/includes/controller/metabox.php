<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Metabox
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerMetabox' ) )
{

	class enscControllerMetabox
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $domain;

		private $screen;

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

			$this->domain = $this->global->getDomain();

			$this->screen = $this->global->getPosttype();

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

			add_action( 'add_meta_boxes', array( $this, 'metabox' ) );

		} // end initialize

		/**
		 * Set Metaboxes
		 *
		 * @since 1.0.0
		 */
		public function metabox()
		{

			/**
			 * Settings Meta Box
			 *
			 * @since 1.0.0
			 */
			add_meta_box( 'ensc_metabox', __( 'Enfold Shortcode', $this->domain ), array( $this, 'enscMetabox' ), $this->screen, 'side', 'default', null );

		} // end metabox

		/**
		 * Get metabox Settings View
		 *
		 * @since 1.0.0
		 */
		public function getColumView() { $this->enscMetabox(); } // end mbSettings

		/**
		 * Metabox Settings View
		 *
		 * @since 1.0.0
		 */
		public function enscMetabox()
		{

			$file  = $this->enscView( __FUNCTION__ );
			$data  = array(

				'title'   => get_the_title(),
				'copy'    => esc_html__( 'Copy', $this->domain ),
				'noTitle' => esc_html__( 'Add a title and save the post.', $this->domain ),

			);

			new enscViewLoader( $file, true, $data );

		} // end mbSettings

		/**
		 * Get the file name
		 *
		 * @since 1.0.0
		 */
		public function enscView( $name )
		{

			return strtolower( implode( '-', preg_split( '/(?=[A-Z])/', $name ) ) ) . '.php';

		} // end enscView
	} // end class
} // end if
