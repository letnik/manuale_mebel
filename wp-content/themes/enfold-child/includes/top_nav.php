<?php

?>

<div class="top-nav d-flex jc-between">    
    <div id="access-1" class="page-navigation">

        <?php
            wp_nav_menu( [
                'container_class' => 'menu',
                'menu'  => '29',
                'items_wrap'      => '<ul id="%1$s" class="%2$s d-flex">%3$s</ul>',
            ]);
        ?>
   </div>
   <div id="access-2" class="navigation-accaunt d-flex">
        <div class="navigation-accaunt-item header-phone">

            <!-- header-phone -->
            <?php
                $phone_1 = get_field('sd_phone_1', 'options');
                $phone = '<a href="tel:' . sl_tel($phone_1) . '">' . $phone_1 . '</a>';
                echo $phone;
            ?>

        </div>

        <div class="navigation-accaunt-item header-wishlist">

            <?php echo do_shortcode("[ti_wishlist_products_counter]"); ?>

        </div>

        <div class="navigation-accaunt-item header-cart">

            <!-- cart -->
            <?php
                do_action('ava_inside_main_menu'); // todo: replace action with filter, might break user customizations
                //output the whole menu    
                echo $output;    
            ?>

        </div>

        <?php
            // wp_nav_menu( [
                // 'container_class' => 'menu',
                // 'menu'  => '34',
            // ]);
        ?>
      
   </div>
</div>