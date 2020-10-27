<?php

function my_template_loop_product_title(){
    global $product;

    // $dimensions = $product->get_dimensions();

    $length = $product->get_length();
    $width = $product->get_width();
    $height = $product->get_height();
    $lengthArrt = $product->get_attribute('razmer-mesta-dlinna');

    $custom_attribute = '<div class="d-flex">';
    $custom_attribute .= '<div>' . $lengthArrt . '</div> x ';
    // $custom_attribute .= '<div>' . $width . '</div> x ';
    // $custom_attribute .= '<div>' . $height . '</div>';
    $custom_attribute .= '</div>';

    
    echo  $custom_attribute;

}
add_action( 'woocommerce_after_shop_loop_item_title', 'my_template_loop_product_title', 10 );

