<?php



// In your theme's functions.php file

    function enqueue_header_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css');
	wp_enqueue_style('banner-css', get_template_directory_uri() . '/custom/banner/banner.css');
	wp_enqueue_style('home-banner-css', get_template_directory_uri() . '/custom/homeBanner/homeBanner.css');
	wp_enqueue_style(
		'current-offers-css',
		get_template_directory_uri() . '/custom/currentOffers/current-offers.css',
		array(),
		filemtime( get_template_directory() . '/custom/currentOffers/current-offers.css' )
	);
	wp_enqueue_style('topDestinations-css', get_template_directory_uri() . '/custom/topDestinations/topDestinations.css');
	wp_enqueue_style('tourPackages-css', get_template_directory_uri() . '/custom/tourPackages/tourPackages.css');
	wp_enqueue_style('experience-css', get_template_directory_uri() . '/custom/experienceSection/experience.css');
	wp_enqueue_style('experienceSlider-css', get_template_directory_uri() . '/custom/experienceSlider/experienceSlider.css');
	wp_enqueue_style('aboutSection-css', get_template_directory_uri() . '/custom/aboutSection/aboutSection.css');
    // Set the title tag
    add_theme_support('title-tag');

    // Enqueue Google Fonts
    // wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=block');

    // Enqueue Swiper CSS
    // wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/css/vendors/swiper-bundle.min.css');
	// wp_enqueue_style('header-css', get_template_directory_uri() . '/assets/css/header.css');
	// wp_enqueue_style('footer-css', get_template_directory_uri() . '/assets/css/footer.css');
	// wp_enqueue_style('banner-css', get_template_directory_uri() . '/assets/css/homebanner.css');
}

add_action('wp_enqueue_scripts', 'enqueue_header_assets');




function enqueue_scripts() {
    // Enqueue jQuery from WordPress core
    wp_enqueue_script('jquery');
    
    // Enqueue custom JS
    wp_enqueue_script(
        'tourPackages-js',
        get_template_directory_uri() . '/custom/tourPackages/tourPackages.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
    // Enqueue custom JS
    wp_enqueue_script(
        'script-js',
        get_template_directory_uri() . '/assets/js/script.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );

}

add_action('wp_enqueue_scripts', 'enqueue_scripts');






// function create_our_services_post_type() {
//     $labels = array(
//         'name' => 'Our Services',
//         'singular_name' => 'Our Service',
//         'add_new' => 'Add New',
//         'add_new_item' => 'Add New Our Service',
//         'edit_item' => 'Edit Our Service',
//         'new_item' => 'New Our Service',
//         'view_item' => 'View Our Service',
//         'search_items' => 'Search Our Services',
//         'not_found' => 'No Our Services found',
//         'not_found_in_trash' => 'No Our Services found in Trash',
//         'parent_item_colon' => '',
//         'menu_name' => 'Our Services'
//     );

//     $args = array(
//         'labels' => $labels,
//         'public' => true,
//         'publicly_queryable' => true,
//         'show_ui' => true,
//         'show_in_menu' => true,
//         'query_var' => true,
//         'rewrite' => array('slug' => 'service', 'with_front' => false), // Change the 'slug' value here
//         'capability_type' => 'post',
//         'has_archive' => true,
//         'hierarchical' => false,
//         'menu_position' => 20,
//         'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
//         'menu_icon' => 'dashicons-networking',
//     );

//     register_post_type('our_service', $args);
// }
// add_action('init', 'create_our_services_post_type');







if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'theme-footer-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-editor-alignleft', // Custom icon
        'position'      => 4 // Position at the top
    ));

    acf_add_options_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'menu_slug'     => 'theme-header-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-generic', // Custom icon
        'position'      => 3 // Position below Footer
    ));

    acf_add_options_page(array(
        'page_title'    => 'Faq',
        'menu_title'    => 'Faq',
        'menu_slug'     => 'faq',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-editor-help', // Custom icon
        'position'      => 5 // Position below Header
    ));

}


?>
