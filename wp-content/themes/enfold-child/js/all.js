jQuery(document).ready(function() {
    let inner_product =  jQuery('.inner_product');
        inner_product_h = jQuery('.inner_product .product-attributes-wrap').height();
        inner_product.find('.product-box-shasow').css( "height", "calc(100% + " + inner_product_h +  "px)");  
        return;
});

