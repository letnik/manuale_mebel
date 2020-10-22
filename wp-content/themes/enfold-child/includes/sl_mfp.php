<?php

function init_popups()
{
    $args = array(
        'post_type' => 'sl_popup',
        'numberposts' => -1,
    );
    $popups = get_posts($args);

    foreach ($popups as $popup) {
        $title = get_field('custom_title', $popup->ID) ? get_field('custom_title', $popup->ID) : $popup->post_title;
        $content = $popup->post_content;
        $id = get_field('id', $popup->ID);
        $show_title = get_field('show_title', $popup->ID);

        $output = '<div id="' . $id . '-popup" class="popup-class">';
        $output .= '<div class="d-center">';
        $output .= '<div class="popup-wrapper">';
        if ($show_title) {
            $output .= "<h3 class='popup__title'>{$title}</h3>";
        }

        $output .= "<div class='popup__content'><div class='popup_close-link js-popup-close'></div>{$content}</div>";
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="js-popup-close popup-close-bg"></div>';
        $output .= '</div>';

        echo do_shortcode($output);
    }
}
add_action('wp_footer', 'init_popups');