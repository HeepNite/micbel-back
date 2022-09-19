<?php 

if(!defined('REDIRECT_URL')){

    define("REDIRECT_URL", 'https://heep-nite.com');
}

if(!function_exists('a_custom_redirect')){
    function a_custom_redirect(){
        wp_redirect( REDIRECT_URL, 301 );
        exit;
    }
}

if(!function_exists('a_theme_setup')){
    function a_theme_setup(){
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme','a_theme_setup');
}

if(class_exists('acf')){

    if(function_exists('afc_add_options_page')){

        acf_add_options_page(array(
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug'  => 'Theme Settings',
            'capability' => 'edit_post',
            'redirect'   => true
        ));

        acf_add_options_sub_page(array(
            'page_title' => 'Theme General Settings',
            'menu_title' => 'general',
            'parent_slug'=> 'theme-settings'
        ));
    }
}

 if(!function_exists('a_mime_types')){
    function a_mime_types($mimes){
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    } 
    add_filter('upload_mimes','a_mime_types');
}

if(!function_exists('a_add_image_size')){
    function a_add_image_size(){
        add_image_size('custom-medium', 300, 9999); 
        add_image_size('custom-tablet', 600, 9999); 
        add_image_size('custom-large', 1200, 9999); 
        add_image_size('custom-large-crop', 1200, 1200, true); 
        add_image_size('custom-desktop', 1600, 9999); 
        add_image_size('custom-full', 2560, 9999); 
    }
    add_action('after_setup_theme', 'a_add_image_size');
}

 if(!function_exists('a_custom_image_size_names')){
    function a_custom_image_size_names($size){
        return array_merge($size, array(
            'custom-medium' => __('Custom medium', 'micbel'),
            'custom-tablet' => __('Custom tablet', 'micbel'),
            'custom-large' => __('Custom large', 'micbel'),
            'custom-large-crop' => __('Custom large crop', 'micbel'),
            'custom-desktop' => __('Custom desktop', 'micbel'),
            'custom-full' => __('Custom full', 'micbel'),
        ));
    }
    add_filter('image_size_names_choose','a_custom_image_size_names');
}  

if(!function_exists('a_custom_navigation_menu')){
    function a_custom_navigation_menu(){
        $locations = array(
            'header_menu' => __('Cabecera Menu', 'micbel'),
            'footer_menu' => __('Pie Menu', 'micbel')
        );
        register_nav_menus($locations);
    }
    add_action('init', 'a_custom_navigation_menu');
} 


add_filter('use_block_editor_for_post','__return_false',10);
add_filter('use_block_editor_for_post_type', '__return_false',10);