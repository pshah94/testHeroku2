<?php
/*
Plugin Name: BookStore 
*/
function bkst_shortcodes_init()
{
    function bkst_shortcode($atts = [], $content = null)
    {
        $content .= file_get_contents(dirname(__FILE__) . "/index.html");
        
        return $content;
    }
    add_shortcode('bkst-plugin', 'bkst_shortcode');

    wp_register_style('main_stylesheet', 
    plugins_url('main.css', __FILE__));
    wp_enqueue_style('main_stylesheet');
    

    wp_register_script('angular_script',   "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js",   true);
    wp_enqueue_script('angular_script');
    
    wp_register_script('mycontroller_script', plugins_url('indexcontroller.js', __FILE__),  true);
    wp_enqueue_script('mycontroller_script');

    wp_register_style('fontAwesome_script',  "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",   true);
    wp_enqueue_style('fontAwesome_script');
   
    

}
add_action('init', 'bkst_shortcodes_init');

include_once "backend.php";

register_activation_hook( __FILE__, function(){
    global $wpdb, $table_prefix;
    $wpdb->show_errors();
    $stmt = "CREATE TABLE inquiry ('id' INTEGER PRIMARY KEY AUTOINCREMENT , 'mobile' TEXT , 'bookname' TEXT, 'authername' TEXT, 'requesteddate' DATE, 'message' TEXT)";
    $wpdb->query($stmt);
} );