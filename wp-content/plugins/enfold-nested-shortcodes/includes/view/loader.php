<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - View Loader
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscViewLoader' ) )
{

	class enscViewLoader
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		public $view;

		private $file;

		public $global;

		private $render;

		private $domain;

		private $include;

		private $output;

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct( $file, $render = false, $data = false )
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
			$this->file    = $file;

			$this->render  = $render;

			$this->global  = $enscInstanceObj;

			$this->domain  = $this->global->getDomain();

			$this->include = trailingslashit( $this->global->getInclude() ) . 'view/';

			/**
			 * Start the view
			 *
			 * @since 1.0.0
			 */
			$this->initialize( $data );

		} // end constructor

		/**
		 * Get template path or render view
		 *
		 * @since 1.0.0
		 */
		public function initialize( $data = false )
		{

			$file = $this->include . $this->file;

			if ( file_exists( $file ) )
			{

				if ( $this->render ) return $this->render( $file, $data );

				else return $file;

			} // end if

			if ( $this->render ) return $this->error();

			return false;

		} // end initialize

		/**
		 * Render the view
		 *
		 * @since 1.0.0
		 */
		public function render( $file, $data )
		{

			require( $file );

		} // end render

		/**
		 * Show error message
		 *
		 * @since 1.0.0
		 */
		public function error()
		{

			return __( 'The file does not exist..', $this->domain );

		} // end error
	} // end class
} // end if
