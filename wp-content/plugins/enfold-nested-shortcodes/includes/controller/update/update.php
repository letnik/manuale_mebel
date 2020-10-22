<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Controller Update Update
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerUpdateUpdate' ) )
{

	class enscControllerUpdateUpdate
	{

		/**
		 * Define properties
		 *
		 * @since	1.0.0
		 */
		private $id;

		private $zip;

		private $file;

		private $path;

		private $data;

		private $name;

		private $items;

		private $global;

		private $prefix;

		private $domain;

		private $update;

		private $logCred;

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

			$this->file    = $this->global->getFile();

			$this->name    = $this->global->getName();

			$this->id      = $this->global->envatoID();

			$this->domain  = $this->global->getDomain();

			$this->path    = plugin_basename( $this->file );

			if ( defined( 'AV_FRAMEWORK_VERSION' ) )
			{

				$this->logCred = $this->getCredentials();

				/**
				 * Initialize Updater
				 *
				 * @since 1.0.0
				 */
				$this->initialize();

			} // end if
		} // end constructor

		/**
		 * Initialize
		 *
		 * @since 1.0.0
		 */
		private function initialize()
		{

			if ( $this->logCred && is_object( $this->logCred ) )
			{

				add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'checkUpdates' ) );

			} // end if
		} // end initialize

		/**
		 * check for updates and add this plugin to the update list
		 *
		 * @since 1.0.0
		 */
		public function checkUpdates( $plugins )
		{

			$this->getEnvatoItems();

			if ( isset( $plugins->checked ) && is_array( $this->items ) )
			{

				$version = $plugins->checked[$this->path];

				if ( $version )
				{

					foreach( $this->items as $k => $v )
					{

						if ( $this->id == $v->item_id )
						{

							$new = $v->version;

							break;

						} // end if
					} // end foreach
				} // end if

				if ( $version != $new )
				{

					$this->getUpdate();

					if ( $this->zip )
					{

						$this->data = get_plugin_data( $this->file );

						if ( is_array( $this->data ) && ! empty( $this->data['Name'] ) )
						{

							$note = 'Please check the plugin homepage for update details and the changelog.';
							$name = str_replace( ' ', '-', trim( $this->data['Name'] ) );

							$args = array(

								'id'             => $this->id,
								'slug'           => $name,
								'plugin'         => $this->path,
								'new_version'    => $new,
								'url'            => $this->data['PluginURI'],
								'package'        => $this->zip,
								'upgrade_notice' => esc_html__( $note, $this->domain ),

							);

							$plugins->response[$this->path] = (object) $args;

							if ( $errors = $this->update->api_errors() )
							{

								$message = esc_html__( ' There were errors: ', $this->domain );

								error_log( '[' . $this->name . ']' . $message . var_export( $errors, 1 ) );

							} // end if
						} // end if
					} // end if
				} // end if
			} // end if

			return $plugins;

		} // end checkUpdates

		/**
		 * Get update zip
		 *
		 * @since 1.0.0
		 */
		private function getUpdate()
		{

			$this->zip = $this->update->wp_download( $this->id );

		} // end getUpdate

		/**
		 * Get envato items
		 *
		 * @since 1.0.0
		 */
		private function getEnvatoItems()
		{

			$this->update = ( new enscControllerUpdateEnvato )->initialize( $this->logCred->name, $this->logCred->key );

			$this->items = $this->update->private_user_data( 'wp-list-plugins', $this->logCred->name, '', true, 300 );

		} // end getEnvatoItems

		/**
		 * Get the user credentials
		 *
		 * @since 1.0.0
		 */
		private function getCredentials()
		{

			return ( new enscModelGetdata )->getCredentials();

		} // end getCredentials

		/**
		 * Remove this plugin updates on deactivation
		 *
		 * @since 1.0.0
		 */
		public function removeFilter()
		{

			remove_filter( 'pre_set_site_transient_update_plugins', array( $this, 'checkUpdates' ) );

		} // end removeFilter
	} // end class
} // end if
