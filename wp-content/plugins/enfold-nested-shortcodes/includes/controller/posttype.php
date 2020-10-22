<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Posttype
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerPosttype' ) )
{

	class enscControllerPosttype
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $domain;

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

			$this->domain = $this->global->getDomain();

			$this->pType  = $this->global->getPosttype();

			/**
			 * Initialize
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Register post type and expand its index columns
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			$this->posttype();

			add_filter( "manage_{$this->pType}_posts_columns", array( $this, 'editColumn' ) );

			add_action( "manage_{$this->pType}_posts_custom_column", array( $this, 'customColumn' ), 10, 2 );

		} // end initialize

		/**
		 * Add Custom Column to post type index
		 *
		 * @since 1.0.0
		 */
		public function editColumn( $columns )
		{

			$part1 = array_slice( $columns, 0, 2 );
			$part2 = array_slice( $columns, 2 );

			$part1['shortcode'] = esc_html__( 'Enfold Shortcode', $this->domain );

			return array_merge( $part1, $part2 );

		} // end editColumn

		/**
		 * Add Custom Column to post type index
		 *
		 * @since 1.0.0
		 */
		public function customColumn( $column, $postID )
		{

			( new enscControllerMetabox )->getColumView();

		} // end customColumn

		/**
		 * Add Settings Metabox, Style and Script
		 *
		 * @since 1.0.0
		 */
		public function posttype()
		{

			$labels = array(

				'name'               => esc_html__( 'Shortcodes',             $this->domain ),
				'singular_name'      => esc_html__( 'Shortcode',              $this->domain ),
				'menu_name'          => esc_html__( 'Shortcodes',             $this->domain ),
				'name_admin_bar'     => esc_html__( 'Shortcodes',             $this->domain ),
				'add_new'            => esc_html__( 'New Shortcode',          $this->domain ),
				'add_new_item'       => esc_html__( 'Add new Shortcode',      $this->domain ),
				'new_item'           => esc_html__( 'New Shortcode',          $this->domain ),
				'edit_item'          => esc_html__( 'Edit Shortcode',         $this->domain ),
				'view_item'          => esc_html__( 'View Shortcode',         $this->domain ),
				'all_items'          => esc_html__( 'All Shortcodes',         $this->domain ),
				'search_items'       => esc_html__( 'Search Shortcode',       $this->domain ),
				'parent_item_colon'  => esc_html__( 'Parent Shortcode',       $this->domain ),
				'not_found'          => esc_html__( 'Shortcode not found',    $this->domain ),
				'not_found_in_trash' => esc_html__( 'No Shortcodes in trash', $this->domain ),

			);

			$args = array(

				'labels'             => $labels,
		        'description'        => esc_html__( 'Shortcode Description', $this->domain ),
		        'menu_position'		 => 5,
		        'menu_icon'			 => 'dashicons-editor-code',
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'show_in_nav_menus'  => false,
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => 'ensc-shortcodes' ),
				'capability_type'    => 'page',
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'revisions' ),
				'delete_with_user'   => false

			);

			register_post_type( $this->pType, $args );

		} // end posttype
	} // end class
} // end if
