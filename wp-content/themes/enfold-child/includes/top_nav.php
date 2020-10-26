<?php

?>

<div class="top-nav">    
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
        
        <!-- header-phone -->
        <?php
            $phone_1 = get_field('sd_phone_1', 'options');

            $phone = '<div class="phone header-phone">';
            $phone .= '<a href="tel:' . sl_tel($phone_1) . '">' . $phone_1 . '</a>';
            $phone .= '</div>';
            echo $phone;
        ?>

        <!-- cart -->
        <?php
            do_action('ava_inside_main_menu'); // todo: replace action with filter, might break user customizations
            //output the whole menu    
            echo $output;    
        ?>


        <?php
            // wp_nav_menu( [
                // 'container_class' => 'menu',
                // 'menu'  => '34',
            // ]);
        ?>
      
   </div>
</div>