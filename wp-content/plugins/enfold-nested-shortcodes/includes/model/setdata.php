<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Model Setdata
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscModelSetdata' ) )
{

	class enscModelSetdata
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
		 * Validation and set transient
		 *
		 * @since 1.0.0
		 */
		public function createTransient( $post )
		{

			if ( $this->validate( $post ) )
			{

				$this->shortcodeTransient( $post->post_title, $post->post_content );

			} // end if
		} // end createTransient

		/**
		 * Validation before setting the transient
		 *
		 * @since 1.0.0
		 */
		private function validate( $post )
		{

			if ( ! defined( 'DOING_AUTOSAVE' ) || false === wp_is_post_revision( $post->ID ) || false === wp_is_post_autosave( $post->ID ) )
			{

				if ( in_array( $post->post_status, array( 'publish', 'draft' ) ) )
				{

					if ( ! empty( $post->post_title ) )
					{

						if ( current_user_can( 'edit_post', $post->ID ) )
						{

							return true;

						} // end if
					} // end if
				} // end if
			} // end if

			return false;

		} // end validate

		/**
		 * Set shortcode transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTransient( $title, $content, $expire = YEAR_IN_SECONDS )
		{

			$transient = $this->prefix . '-' . strtolower( str_replace( ' ', '-', trim( $title ) ) );

			return set_transient( sanitize_key( $transient ), wp_kses( $content, wp_kses_allowed_html( 'post' ) ), $expire );

		} // end shortcodeTransient

		/**
		 * Set shortcode titles transient
		 *
		 * @since 1.0.0
		 */
		public function shortcodeTitlesTransient( $titles, $expire = YEAR_IN_SECONDS )
		{

			$transient = $this->prefix . '-shortcode-titles';

			return set_transient( sanitize_key( $transient ), array_map( array( $this, 'sanitizeArrayTitle' ), $titles ), $expire );

		} // end shortcodeTitlesTransient

		/**
		 * Sanitize the titles from array
		 *
		 * @since 1.0.0
		 */
		public function sanitizeArrayTitle( $title )
		{

			return sanitize_text_field( trim( $title ) );

		} // end sanitizeArrayTitle

		/**
		 * Set option
		 *
		 * @since 1.0.0
		 */
		public function option( $option, $value )
		{

			update_option( $option, $value );

		} // end option
	} // end class
} // end if
