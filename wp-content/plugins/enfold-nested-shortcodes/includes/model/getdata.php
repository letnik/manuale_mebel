<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Model Getdata
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscModelGetdata' ) )
{

	class enscModelGetdata
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $prefix;

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

			$this->prefix = $this->global->getPrefix();

			$this->pType  = $this->global->getPosttype();

		} // end constructor

		/**
		 * Get post type by ID
		 *
		 * @since 1.0.0
		 */
		public function getPostByID( $id )
		{

			return get_post( (int) $id );

		} // end getPostByID

		/**
		 * Get transient
		 *
		 * @since 1.0.0
		 */
		public function getTransient( $transient )
		{

			return get_transient( sanitize_text_field( $transient ) );

		} // end getTransient

		/**
		 * Get shortcode transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTransient( $title )
		{

			$transient = $this->prefix . '-' . strtolower( str_replace( ' ', '-', trim( $title ) ) );

			return ( $t = get_transient( sanitize_key( $transient ) ) )
				   ? $t : $this->shortcode( $title );

		} // end shortcodeTransient

		/**
		 * Get shortcode content
		 *
		 * @since 1.0.0
		 */
		public function shortcode( $title )
		{

			global $wpdb;

			$sql = $wpdb->prepare("

				SELECT post_content
				FROM   $wpdb->posts
				WHERE  ( post_status = 'publish' OR post_status = 'draft' )
				AND    post_type  = %s
				AND    post_title = %s

				", $this->pType, sanitize_text_field( trim( $title ) )

			);

			$result = $wpdb->get_results( $sql )[0]->post_content;

			if ( $result ) ( new enscModelSetdata )->shortcodeTransient( $title, $result );

			return $result;

		} // end shortcode

		/**
		 * Get shortcode transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTitleTransient()
		{

			$transient = $this->prefix . '-shortcode-titles';

			return ( $t = get_transient( sanitize_key( $transient ) ) )
				   ? $t : $this->shortcodeTitles();

		} // end shortcodeTitleTransient

		/**
		 * Get shortcode titles
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTitles()
		{

			global $wpdb;

			$sql = $wpdb->prepare("

				SELECT   post_title
				FROM     $wpdb->posts
				WHERE    ( post_status = 'publish' OR post_status = 'draft' )
				AND      post_type  = %s
				ORDER BY post_title ASC

				", $this->pType

			);

			$titles = array();

			foreach( $wpdb->get_results( $sql, OBJECT_K ) as $k => $v )
			{

				$titles[] = sanitize_text_field( trim( $k ) );

			} // end foreach

			if ( $titles ) ( new enscModelSetdata )->shortcodeTitlesTransient( $titles );

			return $titles;


		} // end shortcodeTitles

		/**
		 * Get Credentials
		 *
		 * @since 1.0.0
		 */
		public function getCredentials()
		{

			if ( avia_get_option( 'ensc_username' ) && avia_get_option( 'ensc_apikey' ) )
			{

				return (object) $creds = array(

					'name' => trim( avia_get_option( 'ensc_username' ) ),
					'key'  => trim( avia_get_option( 'ensc_apikey' ) ),

				);

			} // end if

			if ( avia_get_option( 'updates_username' ) && avia_get_option( 'updates_api_key' ) )
			{

				return (object) $creds = array(

					'name' => trim( avia_get_option( 'updates_username' ) ),
					'key'  => trim( avia_get_option( 'updates_api_key' ) ),

				);

			} // end if

			return false;

		} // end getCredentials

		/**
		 * Get post meta
		 *
		 * @since 1.0.0
		 */
		public function getPostMeta( $id, $key, $single = true )
		{

			return get_post_meta( (int) $id, $key, $single );

		} // end getPostMeta

		/**
		 * Check if plugin is global enabled
		 *
		 * @since 1.0.0
		 */
		public function issetPbGlobal()
		{

			return 'yes' == get_option( 'dawp_global_enabled' ) ? true : false;

		} // end issetPbGlobal
	} // end class
} // end if
