<?php

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
    $custom_attribute .= '<div class="product-size product-height">';
    $custom_attribute .= '<div class="product-size-title">высота</div>';
    $custom_attribute .= '<div class="product-size-value">14</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';
    $custom_attribute .= '</div>';

    echo  $custom_attribute;

}
add_action( 'woocommerce_after_shop_loop_item_title', 'my_after_shop_loop_item_title', 10 );




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

