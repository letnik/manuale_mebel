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


// top nav start

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