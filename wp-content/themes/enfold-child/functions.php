<?php

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




// function sl_header() {

//     $phone_1 = get_field('phone_1', 'options');

//     $output = '<div class="header-right d-flex ai-center jc-between">sdfsdfsdfsdf';


//     $output .= '</div>';

//     echo $output;
// }

// add_action('ava_search_after_get_header', 'sl_header');


// add_shortcode( 'phone', 'show_phone' );
// function show_phone() {

//     $phone_1 = the_field('sd_phone_1', 'options');

//     $output = '<span class="phone">'. $phone_1 .'</span>';

//     return $output;
// }


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
?>

    <div id="access-1" class="page-navigation">

        <?php
            wp_nav_menu( [
                'container_class' => 'menu',
                'menu'  => '29',
            ]);
        ?>
   </div>
   <div id="access-2" class="navigation-accaunt">
        <?php
            $output = '<div class="phone header-phone"><span>';
            $output .= $phone_1;
            $output .= '</span>' . do_shortcode("[ti_wishlist_products_counter]") . '</div>';
            echo $output;
        ?>
        <?php
            wp_nav_menu( [
                'container_class' => 'menu',
                'menu'  => '34',
            ]);
        ?>
   </div>

<?php
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


function popup_inline() { ?>
<script type="text/javascript">
jQuery(window).load(function(){
  jQuery('.open-popup-link').magnificPopup({
    type:'inline',
    midClick: true
  });
});
</script>
<?php }

add_action('wp_head', 'popup_inline');