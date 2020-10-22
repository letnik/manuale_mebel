<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Tinymce
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerTinymce' ) )
{

	class enscControllerTinymce
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $name;

		private $global;

		private $domain;

		private $prefix;

		private $suffix;

		private $assetsURL;

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
			$this->global    = $enscInstanceObj;

			$this->name      = $this->global->getName();

			$this->domain    = $this->global->getDomain();

			$this->prefix    = $this->global->getPrefix();

			$this->suffix    = $this->global->getSuffix();

			$this->assetsURL = $this->global->getAssetsURL();

			/**
			 * Start TinyMCE
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Define the button and script
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			if ( ! current_user_can( 'edit_posts' ) ) return;

			add_filter( 'mce_buttons', array( $this, 'mceButtons' ) );

			add_filter( 'mce_external_plugins', array( $this ,'mcePlugin' ) );

			foreach ( array( 'post-new.php', 'post.php' ) as $hook )
			{

				add_action( "admin_head-{$hook}", function() { $this->mceLocalize(); });

			} // end foreach
		} // end initialize

		/**
		 * Add tinymce button to editor
		 *
		 * @since	1.0.0
		 */
		public function mceButtons( $buttons )
		{

			array_push( $buttons, 'ensc_button' );

			return $buttons;

		} // end mceButtons

		/**
		 * Add tinymce script to plugin-array
		 *
		 * @since	1.0.0
		 */
		public function mcePlugin( $plugins )
		{

			$url = $this->assetsURL . 'js/ensc-tinymce' . $this->suffix . '.js';

			$plugins['ensc_shortcodes'] = $url;

			return $plugins;

		} // end mcePlugin

		/**
		 * Check title to exclude from title list
		 *
		 * @since	1.0.0
		 */
		public function checkTitle()
		{

			global $post;

			if ( 'ensc_shortcodes' == $post->post_type )
			{

				$title = $post->post_title;

			} // end if

			return isset( $title ) ? $title : false;

		} // end checkTitle

		/**
		 * Localize tinymce script
		 *
		 * @since	1.0.0
		 */
		public function mceLocalize()
		{

			$title  = $this->checkTitle();
			$titles = ( new enscModelGetdata )->shortcodeTitleTransient();

			if ( $title )
			{

				if ( is_int( $key = array_search( $title, $titles ) ) )
				{

					unset( $titles[$key] );

				} // end if
			} // end if

			$enscPHPtmce = array(

				'header' => $this->name,
				'desc'   => esc_html__( 'Simply choose your shortcode from dropdown and hit ok.', $this->domain ),
				'value'  => esc_html__( 'Nothing Selected', $this->domain ),
				'empty'  => esc_html__( 'No shortcodes available', $this->domain ),
				'image'  => $this->assetsURL . 'img/tinymce.png',
				'titles' => json_encode( array_values( $titles ) ),
				'prefix' => $this->prefix,

			);

			?>

				<script type='text/javascript'>var enscPHPtmce = <?php echo json_encode( $enscPHPtmce ) ?>;</script>

			<?php

		} // end mceLocalize
	} // end class
} // end if
