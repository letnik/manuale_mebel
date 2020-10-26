<?php

?>

<div class="top-nav">
    <div class="container d-flex jc-between">    
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

                function my_account_loginout_link() {    

                    if (is_user_logged_in() ) {  
                        global $wp; 
                        $current_user = get_user_by( 'id', get_current_user_id() ); 
                        // echo '<a class="nav-link" href="'. wp_logout_url( get_permalink( wc_get_page_id( 'shop' ) ) ) .'">выйти</a>'; 
                        
                        echo '<strong><a class="nav-link" href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">'.$current_user->display_name.'</a></strong>';    
                    }   
                    elseif (!is_user_logged_in() ) {        
                        echo '<a class="nav-link" href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">Авторизация/Регистрация</a>';   
                    }
                    
                }
                
                my_account_loginout_link();   
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
        </div>
   </div>
</div>