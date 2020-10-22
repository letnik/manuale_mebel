<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

/**
 * Enfold - Nested Shortcodes - Autoloader
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'enscControllerAutoloader' ) )
{

	class enscControllerAutoloader
	{

		/**
		 * Define Properties
		 *
		 * @since	1.0.0
		 */
		private $file;

		private $prefix;

		private $suffix;

		private $folder;

		/**
		 * Constructor
		 *
		 * @since	1.0.0
		 */
		public function __construct( $file, $prefix, $folder = false )
		{

			/**
			 * Set properties
			 *
			 * @since 1.0.0
			 */
			$this->file   = $file;

			$this->prefix = $prefix;

			$this->folder = $folder ? $folder . '/' : '';

			$this->suffix = '.' . pathinfo( __FILE__, PATHINFO_EXTENSION );

			/**
			 * Initialize
			 *
			 * @since 1.0.0
			 */
			$this->initialize();

		} // end constructor

		/**
		 * Start autoloader
		 *
		 * @since 1.0.0
		 */
		public function initialize()
		{

			try
			{

				spl_autoload_register( array( $this, 'getFile' ), true );

			} // end try

			catch ( Exception $e )
			{

				function __autoload( $class )
				{

					$this->getFile( $class );

				} // end autoload
			} // end catch
		} // end initialize

		/**
		 * Get path and file from classname
		 *
		 * @since 1.0.0
		 */
		public function getFile( $class )
		{

			if ( ! class_exists( $class ) )
			{

				$temp = preg_split( '/(?=[A-Z])/', $class );

				if ( $this->prefix == array_shift( $temp ) )
				{

					$path = $this->folder . strtolower( implode( $temp, '/' ) ) . $this->suffix;

					$file = trailingslashit( dirname( $this->file ) ) . $path;

					if ( is_file( $file ) )
					{

						require_once( $file );

						return true;

					} // end if
				} // end if
			} // end if

			return false;

		} // end getFile
	} // end class
} // end if
