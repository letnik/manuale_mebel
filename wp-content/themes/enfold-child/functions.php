<?php
//style

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


// top nav startshor

add_action( 'ava_after_main_container', 'add_top_menu' );

function add_top_menu() {

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

add_shortcode( 'dp_phone_2', 'show_phone_2' );
function show_phone_2() {
    $phone_2 = get_field('sd_phone_2', 'options');
    $output = '<a href="tel:'.sl_tel($phone_2).'">'.$phone_2.'</a>';
    return $output;
}

add_shortcode( 'dp_country', 'show_country' );
function show_country() {
    $output = get_field('sd_country', 'options');
    return $output;
}

add_shortcode( 'dp_city', 'show_city' );
function show_city() {
    $output = get_field('sd_city', 'options');
    return $output;
}

add_shortcode( 'dp_street', 'show_street' );
function show_street() {
    $output = get_field('sd_street', 'options');
    return $output;
}

add_shortcode( 'dp_street_bild', 'show_street_bild' );
function show_street_bild() {
    $output = get_field('sd_street_bild', 'options');
    return $output;
}

add_shortcode( 'dp_street_numb', 'show_street_numb' );
function show_street_numb() {
    $output = get_field('sd_street_numb', 'options');
    return $output;
}

add_shortcode( 'dp_mail', 'show_mail' );
function show_mail() {
    $mail = get_field('sd_mail', 'options');
    $output = '<a href="mailto:'.$mail.'">'.$mail.'</a>';
    return $output;
}


// Дозволяєм завантаження усіх файлів
// define( 'ALLOW_UNFILTERED_UPLOADS', true );

// Дозволяєм завантаження SVG
function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);



add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}



add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );

# Формирует данные для отображения SVG как изображения в медиа библиотеке.
function show_svg_in_media_library( $response ) {
	if ( $response['mime'] === 'image/svg+xml' ) {
		// С выводом названия файла
		$response['image'] = [
			'src' => $response['url'],
		];
	}

	return $response;
}

// кастомні атрибути в каталозі/сітці товару
require_once 'includes/woocommerce_customizer.php';



add_filter( 'loop_shop_per_page', 'truemisha_products_per_page', 20 );
 
function truemisha_products_per_page( $per_page ) {
 
	$per_page = 29;
	// по умолчанию wc_get_default_products_per_row() * wc_get_default_product_rows_per_page()
 
	return $per_page;
 
}

// убираем краткое описание
function wplife_filter_woocommerce_short_description( $post_post_excerpt ) {
  return ""; 
};
add_filter( 'woocommerce_short_description', 'wplife_filter_woocommerce_short_description', 10, 1 );



// add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
// function woo_remove_product_tabs( $tabs ) {
 
// unset( $tabs['description'] ); // Убираем вкладку "Описание"
// unset( $tabs['reviews'] ); // Убираем вкладку "Отзывы"
// unset( $tabs['additional_information'] ); // Убираем вкладку "Свойства"
 
// return $tabs;
 
// }

// add_action( 'woocommerce_short_description', 'woocommerce_output_product_data_tabs', 33 );



 
add_action( 'init', 'enfold_customization_change_related_products' );
function enfold_customization_change_related_products() {
	global $avia_config;
	$avia_config['shop_single_column'] = 5;
	$avia_config['shop_single_column_items'] = 5;
}

add_filter('woocommerce_get_image_size_thumbnail','add_thumbnail_size',1,10);
function add_thumbnail_size($size){

    $size['width'] = 300;
    $size['height'] = 300;
    $size['crop']   = 0; //0 - не обрезаем, 1 - обрезка
    return $size;
}


add_filter('woocommerce_get_image_size_single','add_single_size',1,10);
function add_single_size($size){

    $size['width'] = 950;
    $size['height'] = 400;
    $size['crop']   = 0;
    return $size;
}

add_filter( 'woocommerce_output_related_products_args', 'truemisha_rel_products_args', 25 );
 
function truemisha_rel_products_args( $args ) {
	$args[ 'posts_per_page' ] = 5; // сколько штук отображать
	$args[ 'columns' ] = 5; // сколько штук в одном ряду
	return $args;
}


//  убираем quantity inputs
function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {
 
	if ( is_null( $product ) )  {
		return $html;
	}
 
}

function second_logo() {
    $my_url = get_home_url(); 
    $logo = '<div class="logo footer-logo second-logo"><a href="link-url" target="_blank">' ;
    $logo .= '<img src="' . $my_url . '/wp-content/themes/enfold-child/img/logo-white.svg"/>';
    $logo .= '</a></div>';
    return $logo;
    }
add_shortcode('dp_footer_fogo', 'second_logo');


function custom_script(){
    ?>
    <script>
    (function($){
        $(window).load(function(){
            $( 'footer' ).each(function() {
                $( this ).children('.container').append('<a href="<?php echo get_page_link( 3 ); ?>"><?php echo get_the_title(3) ; ?></a>');
            });
        });
    })(jQuery);
  </script>
  <?php
  }
  add_action('wp_footer', 'custom_script');





  