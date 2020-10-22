<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) die( 'Don\'t try to load this file directly!' );

function deInstall()
{

	global $avia;

	if ( ! empty( $avia ) && 'ensc_delete' == get_option( $avia->option_prefix )['avia']['ensc_delete'] )
	{

		global $wpdb;

		$data = get_option( $avia->option_prefix )['avia'];

		unset( $data['ensc_username'] );
		unset( $data['ensc_apikey'] );
		unset( $data['ensc_delete'] );

		update_option( $avia->option_prefix, array( 'avia' => $data ) );

		$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE %s", '%_ensc-%' ) );
		$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->posts   WHERE post_type   LIKE %s", 'ensc_shortcodes' ) );

	} // end if
} // end deInstall

if ( ! is_multisite() )
{

    deInstall();

} // end if

else
{

    global $wpdb;

    $blogs   = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    $current = get_current_blog_id();

    foreach ( $blogs as $blog )
    {

        switch_to_blog( $blog );

        deInstall();

    } // end foreach

    switch_to_blog( $current );

} // end else
