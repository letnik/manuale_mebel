<?php

function my_template_loop_product_title(){
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
add_action( 'woocommerce_after_shop_loop_item_title', 'my_template_loop_product_title', 10 );

