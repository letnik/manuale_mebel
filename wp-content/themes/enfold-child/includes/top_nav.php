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
        ob_start();
        do_action('ava_inside_main_menu'); // todo: replace action with filter, might break user customizations
        $main_nav .= ob_get_clean();
        
        if($icon_beside)
        {
            $main_nav .= $icons; 
        }
            
        $main_nav .= '</nav>';
        
        /**
         * Allow to modify or remove main menu for special pages
         * 
         * @since 4.1.3
         */
        $output .= apply_filters( 'avf_main_menu_nav', $main_nav );
    
        /*
        * Hook that can be used for plugins and theme extensions
        */
        ob_start();
        do_action('ava_after_main_menu'); // todo: replace action with filter, might break user customizations
        $output .= ob_get_clean();

 /* inner-container */
$output .= "</div>";
    
/* end container */
$output .= " </div> ";


//output the whole menu     
echo $output; 
            // wp_nav_menu( [
            //     'container_class' => 'menu',
            //     'menu'  => '34',
            // ]);
        ?>
   </div>