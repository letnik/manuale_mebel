<?php
// main      
//Set builder mode to debug
function builder_set_debug()
{
    return 'debug';
}

add_action('avia_builder_mode', 'builder_set_debug');

add_filter('show_admin_bar', '__return_false');

function sl_add_scripts() 
{
    //Custom JS
    wp_enqueue_script('all', get_stylesheet_directory_uri() . '/js/all.js', array('jquery'), null, true );

    wp_enqueue_style('all', get_stylesheet_directory_uri() . '/css/all.css', [], null);

    //Run custom JS
    wp_enqueue_script('all');
}
add_action('wp_enqueue_scripts', 'sl_add_scripts', 20);


function sl_tel($tel) {
    return preg_replace('/[^0-9+]/', '', $tel);
}

// add_shortcode logo
add_shortcode('avs_avia_logo', 'callback_avia_logo');
function callback_avia_logo() {
    $logo = avia_get_option('logo');
    $logo = !empty( $logo ) ? $logo : AVIA_BASE_URL.'images/layout/logo.svg';
    return  avia_logo($logo, '', 'strong', true);
}


// Дозволяєм SVG
function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);



// top nav start

add_action( 'ava_after_main_container', 'add_top_menu' );

function add_top_menu() {

    $phone_1 = get_field('sd_phone_1', 'options');

    //Includes
    require_once 'includes/top_nav.php';
}


// top nav end

//Adding ACF settings page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Site Data',
        'menu_title' => 'Site Data',
        'menu_slug' => 'site-data',
    ));
}


function popup_inline() {
    ?>

        <script type="text/javascript">
        jQuery(window).load(function(){
        jQuery('.open-popup-link').magnificPopup({
            type:'inline',
            midClick: true
        });
        });
        </script>
    
    <?php
}

add_action('wp_head', 'popup_inline');




add_shortcode( 'dp_phone_1', 'show_phone_1' );
function show_phone_1() {

    $phone_1 = get_field('sd_phone_1', 'options');

    $output = '<a href="tel:'.sl_tel($phone_1).'">'.$phone_1.'</a>';

    return $output;
}

