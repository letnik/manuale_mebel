<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Initialize
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerInitialize' ) )
{

	class enscControllerInitialize
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $file;

		private $folder;

		private $version;

		private $domain;

		private $prefix;

		private $itemID;

		private $request;

		private $notice;

		private $plName;

		private $pType;

		private $suffix;

		private $include;

		private $assets;

		private $assetsURL;

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct()
		{

			/**
			 * Set properties
			 *
			 * @since 1.0.0
			 */
			$this->notice    = array();

			$this->request   = $_REQUEST;

			$this->suffix    = WP_DEBUG ? '' : '-min';

			$this->file      = enscPluginInitialize::FILE;

			$this->domain    = enscPluginInitialize::DOMAIN;

			$this->prefix    = enscPluginInitialize::PREFIX;

			$this->itemID    = enscPluginInitialize::ITEMID;

			$this->version   = enscPluginInitialize::VERSION;

			$this->pType     = $this->prefix . '_shortcodes';

			$this->plName    = esc_html__( 'Enfold - Nested Shortcodes', $this->domain );

			$this->folder    = trailingslashit( plugin_dir_path( $this->file ) );

			$this->include   = $this->folder . 'includes/';

			$this->assets    = $this->folder . 'assets/';

			$this->assetsURL = trailingslashit( plugin_dir_url( $this->file ) ) . 'assets/';

			/**
			 * Let the magic happens
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Check requirements
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			add_action( 'plugins_loaded', array( $this, 'checkPHP' ) );

			add_action( 'admin_init', array( $this, 'checkRequired' ) );

			register_activation_hook( $this->file, array( $this, 'activate' ) );

			register_deactivation_hook( $this->file, array( $this, 'deactivate' ) );

		} // end initialize

		/**
		 * PHP Version Check
		 *
		 * @since 1.0.0
		 */
		public function checkPHP()
		{

			if ( version_compare( PHP_VERSION, '5.4' ) < 0 )
			{

				$this->notice[] = esc_html__( 'The PHP version must be at least 5.4 for this plugin to work.', $this->domain );

				$this->deactivatePlugin();

			} // end if

			else
			{

				new enscControllerTranslation();

				add_action( 'init', array( $this, 'setClasses' ) );

				if ( isset( $this->request['page'] ) && 'avia' == $this->request['page'] )
				{

					new enscControllerOptiontab();

				} // end if

			} // end else
		} // end checkPHP

		/**
		 * Checking Requirements
		 *
		 * @since 1.0.0
		 */
		public function checkRequired()
		{

			if ( ! defined( 'AV_FRAMEWORK_VERSION' ) )
			{

				$this->notice[] = esc_html__( 'The Enfold Theme must be active for this plugin to work.', $this->domain );

			} // end if

			if ( ! empty( $this->notice ) )
			{

				array_unshift( $this->notice, $this->plName . esc_html__( ' Error(s): ', $this->domain ) );

				$this->notice[] = esc_html__( 'The plugin has been disabled. Please fix the error(s) and try again.', $this->domain );

				$this->adminNotice();

				$this->deactivatePlugin();

			} // end if
		} // end checkRequired

		/**
		 * Add admin notice
		 *
		 * @since 1.0.0
		 */
		public function adminNotice()
		{

			add_action( 'admin_notices', function()
			{

				echo '<div class="error"><p>' . implode( ' ', $this->notice ) . '</p></div>';

			}); // end add_action

		} // end adminNotice

		/**
		 * Deactivate the plugin
		 *
		 * @since 1.0.0
		 */
		public function deactivatePlugin()
		{

			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			deactivate_plugins( plugin_basename( $this->file ) );

		} // end deactivatePlugin

		/**
		 * Flush rewrite rules
		 *
		 * @since 1.0.0
		 */
		public function activate()
		{

			new enscControllerPosttype();

			flush_rewrite_rules();

		} // end activate

		/**
		 * Flush rewrite rules
		 *
		 * @since 1.0.0
		 */
		public function deactivate()
		{

			flush_rewrite_rules();

			( new enscControllerUpdateUpdate )->removeFilter();

		} // end deactivate

		/**
		 * Set the classes where needed
		 *
		 * @since 1.0.0
		 */
		public function setClasses()
		{

			if ( is_admin() )
			{

				global $pagenow;

				new enscControllerTinymce();

				new enscControllerPosttype();

				new enscControllerUpdateUpdate();

				$actions = array( 'save_post', 'untrashed_post', 'trashed_post' );

				foreach( $actions as $action )
				{

					add_action( $action, function( $postID )
					{

						$post = ( new enscModelGetdata )->getPostByID( $postID );

						if ( $this->pType == $post->post_type )
						{

							$titles = ( new enscModelGetdata )->shortcodeTitles();

							if ( 0 === count( $titles ) ) ( new enscModelDeletedata )->shortcodeTitleTransient();

							if ( in_array( current_filter(), array( 'save_post', 'untrashed_post' ) ) )
							{

								( new enscModelSetdata )->createTransient( $post );

							} // end if

							else
							{

								( new enscModelDeletedata )->deleteTransient( $post );

							}

						} // end if
					});

				} // end foreach

				if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) )
				{

					new enscControllerShortcodebox();

				} // end if

				add_action( 'current_screen', function( $screen )
				{

					if ( 'ensc_shortcodes' == $screen->id )
					{

						new enscControllerMetabox();

						new enscControllerPagebuilder();

						new enscControllerAdminscript();

					} // end if

					if ( 'edit-ensc_shortcodes' == $screen->id )
					{

						new enscControllerAdminscript( true );

					} // end if
				}); // end add_action
			} // end if

			else
			{

				add_action( 'wp', array( $this, 'setFrontend' ) );

			} // end else

		} // end setClasses

		/**
		 * Set Frontend
		 *
		 * @since 1.0.0
		 */
		public function setFrontend() { new enscControllerShortcodes(); } // end setFrontend

		/**
		 * Get version
		 *
		 * @since 1.0.0
		 */
		public function getVersion() { return $this->version; } // end getVersion

		/**
		 * Get name
		 *
		 * @since 1.0.0
		 */
		public function getName() { return $this->plName; } // end getName

		/**
		 * Get file
		 *
		 * @since 1.0.0
		 */
		public function getFile() { return $this->file; } // end getFile

		/**
		 * Get text domain
		 *
		 * @since 1.0.0
		 */
		public function getDomain() { return $this->domain; } // end getDomain

		/**
		 * Get post type
		 *
		 * @since 1.0.0
		 */
		public function getPosttype() { return $this->pType; } // end getDomain

		/**
		 * Get prefix
		 *
		 * @since 1.0.0
		 */
		public function getPrefix() { return $this->prefix; } // end getPrefix

		/**
		 * Get envato id
		 *
		 * @since 1.0.0
		 */
		public function envatoID() { return $this->itemID; } // end envatoID

		/**
		 * Get suffix
		 *
		 * @since 1.0.0
		 */
		public function getSuffix() { return $this->suffix; } // end getSuffix

		/**
		 * Get includes path
		 *
		 * @since 1.0.0
		 */
		public function getInclude() { return $this->include; } // end getInclude

		/**
		 * Get assets path
		 *
		 * @since 1.0.0
		 */
		public function getAssets() { return $this->assets; } // end getAssets

		/**
		 * Get assets url
		 *
		 * @since 1.0.0
		 */
		public function getAssetsURL() { return $this->assetsURL; } // end getAssetsURL

	} // end class
} // end if
