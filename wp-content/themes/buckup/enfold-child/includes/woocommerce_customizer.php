<?php

// add attribut catalog

function my_after_shop_loop_item_title(){
    global $product;

    // $dimensions = $product->get_dimensions();

    $length = $product->get_length();
    $width = $product->get_width();
    $height = $product->get_height();
    $lengthArrt = $product->get_attribute('razmer-mesta-dlinna');

    $custom_attribute  = '<div class="product-attributes-wrap">';
    $custom_attribute .= '<div class="product-attributes-list">';
    $custom_attribute .= '<div class="product-attributes-item">';
    $custom_attribute .= '<div class="product-attributes-title"><span>Размер</span></div>';
    $custom_attribute .= '<div class="product-size-table d-flex">';
    $custom_attribute .= '<div class="product-size product-length">';
    $custom_attribute .= '<div class="product-size-title">длина</div>';
    $custom_attribute .= '<div class="product-size-value">'. $length .'</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '<div class="product-size product-width">';
    $custom_attribute .= '<div class="product-size-title">ширина</div>';
    $custom_attribute .= '<div class="product-size-value">'. $width .'</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '<div class="product-size product-height">';
    $custom_attribute .= '<div class="product-size-title">высота</div>';
    $custom_attribute .= '<div class="product-size-value">'. $height .'</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '<div class="product-attributes-item">';
    $custom_attribute .= '<div class="product-attributes-title"><span>Размер спального места</span></div>';
    $custom_attribute .= '<div class="product-size-table d-flex">';
    $custom_attribute .= '<div class="product-size product-length">';
    $custom_attribute .= '<div class="product-size-title">длина</div>';
    $custom_attribute .= '<div class="product-size-value">12</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '<div class="product-size product-width">';
    $custom_attribute .= '<div class="product-size-title">ширина</div>';
    $custom_attribute .= '<div class="product-size-value">13</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';

    $custom_attribute .= '</div>';
    
    $custom_attribute .= '</div>';
    $custom_attribute .= '<div><a href="'.esc_url( $product->get_permalink( $product->id )).'" class="button product_type_simple add_to_cart_button">Подробнее</a></div>';

    $custom_attribute .= '</div>';
    $custom_attribute .= '<div class="product-box-shasow"></div>';

    echo  $custom_attribute;

}
add_action( 'woocommerce_after_shop_loop_item', 'my_after_shop_loop_item_title', 10 );




function my_shop_loop_item_title(){
    global $product;

    $category = get_queried_object();
    $current_cat_id = $category->term_id;
    $current_cat_name = $category->name;

    $custom_category  = '<div class="category-name">';
    $custom_category .= $current_cat_name;
    $custom_category .= '</div>';

    echo  $custom_category;

}

add_action( 'woocommerce_shop_loop_item_title', 'my_shop_loop_item_title', 1 );

function my_shop_loop_item_title_price(){
    global $product;

    $category = get_queried_object();
    $current_cat_id = $category->term_id;
    $current_cat_name = $category->name;

    $custom_category  = '<div class="attribut-title">';
    $custom_category .= 'Цена';
    $custom_category .= '</div>';

    echo  $custom_category;

}
add_action( 'woocommerce_shop_loop_item_title', 'my_shop_loop_item_title_price', 10 );

// END add attribut catalog




// add percent in cataloc

add_action( 'woocommerce_sale_flash', 'pancode_echo_sale_percent' );

/**
 * Echo discount percent badge html.
 *
 * @param string $html Default sale html.
 *
 * @return string
 */
function pancode_echo_sale_percent( $html ) {
  global $product;

  /**
   * @var WC_Product $product
   */

  $regular_max = 0;
  $sale_min    = 0;
  $discount    = 0;

  if ( 'variable' === $product->get_type() ) {
    $prices      = $product->get_variation_prices();
    $regular_max = max( $prices['regular_price'] );
    $sale_min    = min( $prices['sale_price'] );
  } else {
    $regular_max = $product->get_regular_price();
    $sale_min    = $product->get_sale_price();
  }

  if ( ! $regular_max && $product instanceof WC_Product_Bundle ) {
    $bndl_price_data = $product->get_bundle_price_data();
    $regular_max     = max( $bndl_price_data['regular_prices'] );
    $sale_min        = max( $bndl_price_data['prices'] );
  }

  if ( floatval( $regular_max ) ) {
    $discount = round( 100 * ( $regular_max - $sale_min ) / $regular_max );
  }

  return '<span class="onsale"><span class="onsale_text">Sale</span><span class="percent">-&nbsp;' . esc_html( $discount ) . '%</span></span>';
  // return '<span class="onsale"><span>Акция</span><br>-&nbsp;' . esc_html( $discount ) . '%</span>';
}


// END add percent in cataloc


// /* Add to cart */
// add_filter( 'woocommerce_product_single_add_to_cart_text', 'tb_woo_custom_cart_button_text' );


// add_filter( 'woocommerce_product_add_to_cart_text', 'tb_woo_custom_cart_button_text' );   
// function tb_woo_custom_cart_button_text() {
//         return __( 'Купить', 'woocommerce' );
// }



// переносимо вішліст

function my_sdfsdfdsf(){
    global $product;

    echo do_shortcode('[ti_wishlists_addtowishlist]');
 
}
add_action( 'woocommerce_after_add_to_cart_form', 'my_sdfsdfdsf', 10 );


// add_theme_support( 'wc-product-gallery-slider' );


// add_filter( 'woocommerce_single_product_carousel_options', 'truemisha_product_gallery_arrows' );
 
// function truemisha_product_gallery_arrows( $options ) {
 
//     $options[ 'animation' ] = fade;
// 	return $options;
 
// }


// забираєм артикул з карточки товару
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// удаляем описание категории на странице категорий
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
// выводим описание категории под товарами
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );


// переносим опис
add_action('init', 'avf_move_product_output');
function avf_move_product_output() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1 );
    add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 5 );
}

