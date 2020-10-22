<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Pagebuilder
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerPagebuilder' ) )
{

	class enscControllerPagebuilder
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $pType;

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

			$this->pType  = $this->global->getPosttype();

			/**
			 * Initialize
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Add post type to pagebuilder
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			add_filter( 'avf_builder_boxes', function( $metabox )
			{

				foreach( $metabox as &$meta )
				{

					if( $meta['id'] == 'avia_builder' )
					{

						$meta['page'][] = $this->pType;

					} // end if
				} // end foreach

				return $metabox;

			}); // end add_filter
		} // end initialize
	} // end class
} // end if
