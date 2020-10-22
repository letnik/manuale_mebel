<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Model Deletedata
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscModelDeletedata' ) )
{

	class enscModelDeletedata
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $global;

		private $prefix;

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
			$this->global  = $enscInstanceObj;

			$this->prefix  = $this->global->getPrefix();

		} // end constructor

		/**
		 * Validation and deleting the transient
		 *
		 * @since 1.0.0
		 */
		public function deleteTransient( $post )
		{

			if ( $this->validate( $post->ID ) )
			{

    			$title = isset( $post->post_title ) && ! empty( $post->post_title ) ? $post->post_title : '';

				if ( $title ) $this->shortcodeTransient( $title );

			} // end if
		} // end deleteTransient

		/**
		 * Validation before setting the transient
		 *
		 * @since 1.0.0
		 */
		private function validate( $postID )
		{

			if ( current_user_can( 'edit_post', $postID ) )
			{

				return true;

			} // end if

			return false;

		} // end validate

		/**
		 * Delete shortcode transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTransient( $title )
		{

			$transient = $this->prefix . '-' . strtolower( str_replace( ' ', '-', sanitize_text_field( trim( $title ) ) ) );

			return delete_transient( sanitize_key( $transient ) );

		} // end shortcodeTransient

		/**
		 * Delete shortcode titles transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTitleTransient()
		{

			$transient = $this->prefix . '-shortcode-titles';

			delete_transient( sanitize_key( $transient ) );

		} // end shortcodeTitleTransient

		/**
		 * Delete option
		 *
		 * @since 1.0.0
		 */
		public function option( $option )
		{

			delete_option( $option );

		} // end option
	} // end class
} // end if
