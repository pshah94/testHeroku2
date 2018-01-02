<?php
function coffeecafe_enqueue_styles() {
    // Use the parent theme's stylesheet
    return get_template_directory_uri() . '/style.css';
}

function coffeecafe_styles() {
    $themeVersion = wp_get_theme()->get('Version');

    // Enqueue our style.css with our own version
    wp_enqueue_style('coffeecafe-child-style', get_stylesheet_directory_uri() . '/style.css',
        array(), $themeVersion);
}

// Filter get_stylesheet_uri() to return the parent theme's stylesheet 
add_filter('stylesheet_uri', 'coffeecafe_enqueue_styles');

// Enqueue this theme's scripts and styles (after parent theme)
add_action('wp_enqueue_scripts', 'coffeecafe_styles', 20);

require_once (get_stylesheet_directory() . '/inc/customizer.php'); 
?>