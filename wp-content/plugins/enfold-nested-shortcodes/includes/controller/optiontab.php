<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Optiontab
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerOptiontab' ) )
{

	class enscControllerOptiontab
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

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

			$this->domain = $this->global->getDomain();

			/**
			 * Initialize
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Add settings to enfold settings page
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			add_action( 'avf_option_page_init', array( $this, 'enscTab' ) );

			add_action( 'avf_option_page_data_init', array( $this, 'enscTabContent' ) );

		} // end initialize

		/**
		 * Set ensc tab
		 *
		 * @since 1.0.0
		 */
		public function enscTab( $pages )
		{

			$args  = array(

				'title'  =>  __( 'Nested Shortcodes', $this->domain ),
				'icon'   => 'doc_text_image.png',
				'slug'   => 'ensc',
				'parent' => 'avia',

			);

			$pages[] = apply_filters( 'ensc_theme_tab', $args );

			return $pages;

		} // end enscTab

		/**
		 * Set tab content
		 *
		 * @since 1.0.0
		 */
		public function enscTabContent( $elements )
		{

			$elements[] = array(

				'name' => esc_html__( 'Enfold - Nested Shortcodes: Settings', $this->domain ),
				'desc' => esc_html__( 'Fill in your Envato credentials for automatic updates and determine whether to delete your data when uninstalling. If you have already registered your data for Theme Updates and these data are the same as those you used to buy "Enfold - Nested Shortcodes", you do not need to enter anything in the fields below.', $this->domain ),
				'std'  => '',
				'slug' => 'ensc',
				'type' => 'heading',
				'nodescription'=>true

			);

			$elements[] =	array(

				'name' => esc_html__( 'Your Envato User Name', $this->domain ),
				'desc' => esc_html__( 'Enter your user name with which you purchased this item.', $this->domain ),
				'std'  => '',
				'slug' => 'ensc',
				'type' => 'text',
				'id'   => 'ensc_username',

			);

			$elements[] =	array(

				'name' => esc_html__( 'Your Envato API-Key', $this->domain ),
				'desc' => esc_html__( 'Here you can enter your API-Key.', $this->domain ),
				'std'  => '',
				'slug' => 'ensc',
				'id'   => 'ensc_apikey',
				'type' => 'text'

			);

			$elements[] = array(

				'name' => esc_html__( 'Delete data when uninstalling', $this->domain ),
				'desc' => esc_html__( 'Here you can choose to delete all data during deinstallation. Please note that this process can not be undone. Enfold must be enabled for this action to access the options.', $this->domain ),
				'std'  => '',
				'slug' => 'ensc',
				'id'   => 'ensc_delete',
				'type' => 'checkbox',

			);

			return $elements;

		} // end enscTabContent
	} // end class
} // end if
