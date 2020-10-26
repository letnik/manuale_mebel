<div id="access-1" class="page-navigation">

        <?php
            wp_nav_menu( [
                'container_class' => 'menu',
                'menu'  => '29',
                'items_wrap'      => '<ul id="%1$s" class="%2$s d-flex">%3$s</ul>',
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