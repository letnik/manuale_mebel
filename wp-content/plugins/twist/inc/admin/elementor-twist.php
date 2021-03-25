<?php

// This file is pretty much a boilerplate WordPress plugin.
// It does very little except including wp-widget.php
namespace ElementorTwist;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class PluginElementorTwist
{

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var PluginElementorTwist The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return PluginElementorTwist An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts()
    {
        do_action('elementor_twist_preview_scripts');
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files()
    {
        require_once(__DIR__ . '/twist-widget.php');
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets()
    {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Twist_Widget());
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        // Register widget scripts
        add_action('elementor/preview/enqueue_styles', [ $this, 'widget_scripts' ]);

        // Register widgets
        add_action('elementor/widgets/widgets_registered', [ $this, 'register_widgets' ]);
    }
}

// Instantiate Plugin Class
PluginElementorTwist::instance();
