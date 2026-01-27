<?php
function zarsa_assets() {
    wp_enqueue_style('zarsa-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'zarsa_assets');
