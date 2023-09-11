<?php
require_once ( get_stylesheet_directory() . '/inc/cutom-theme-customize-settings.php'); 
function theme_scripts() {
  wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css' );
  wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );;
  wp_enqueue_style( 'fancybox-css','https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
  wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );
  wp_enqueue_style( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css' );
  wp_enqueue_style( 'font-awesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css' );
  wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/css/custom-style.css' );
  wp_enqueue_style( 'theme-style', get_stylesheet_uri());
  wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/assets/css/woo-style.css' );
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css' );  
	
  wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), false, true );
  wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js', array(), '1.0.0', true );  
  wp_enqueue_script( 'jquery.fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '1.0.0', true ); 
  wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '1.0.0', true );
  wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true );
  wp_localize_script('theme-js', 'the_ajax_script', array('ajaxurl' =>admin_url('admin-ajax.php')));
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );




function twentysixteen_widgets_init() {

  register_sidebar(
    array(
      'name'          => __( 'Footer Two', 'twentysixteen' ),
      'id'            => 'footer-two',
      'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
      'before_widget' => '<div class="footer-col-1">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>',
    )
  );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

add_theme_support( 'post-thumbnails' );
add_filter( 'use_block_editor_for_post_type', '__return_false' );


add_action( 'after_setup_theme', 'register_custom_nav_menus' );
function register_custom_nav_menus() {
  register_nav_menus( array(
    'header_menu' => 'Header Menu',
    'header_menu_reponsive' => 'Header Menu Reponsive',
    
        'footer_menu' => 'Footer Menu',
    'my_account_menu' => 'My Account Menu',
  ) );
}

add_action( 'init', 'custom_post_type_restaurant', 0 );
function custom_post_type_restaurant() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Restaurants', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Restaurant', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Restaurants', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Restaurant', 'twentytwentyone' ),
        'all_items'           => __( 'All Restaurants', 'twentytwentyone' ),
        'view_item'           => __( 'View Restaurant', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Restaurant', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Restaurant', 'twentytwentyone' ),
        'update_item'         => __( 'Update Restaurant', 'twentytwentyone' ),
        'search_items'        => __( 'Search Restaurant', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'restaurants', 'twentytwentyone' ),
        'description'         => __( 'Restaurant news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        //'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'restaurant', $args );
  
}



add_filter( 'rest_endpoints', function( $endpoints ) {
  // Get the endpoints that you want to allow.
  $allowed_endpoints = array(
    '/custom/v1/get-access-token',
    '/wp/v2/posts',
    '/wp/v2/pages',
    '/wp/v2/users',
    '/wp/v2/restaurant',
    '/custom/v1/view-restaurant',
  );

  // Remove all other endpoints.
  foreach ( $endpoints as $endpoint => $data ) {
    if ( ! in_array( $endpoint, $allowed_endpoints ) ) {
      unset( $endpoints[$endpoint] );
    }
  }

  return $endpoints;
} );


// Register a custom REST API endpoint for token retrieval
function custom_rest_api_endpoint_get_access_token() {
  register_rest_route('custom/v1', '/get-access-token', array(
      'methods' => 'POST',
      'callback' => 'get_access_token',
  ));
}
add_action('rest_api_init', 'custom_rest_api_endpoint_get_access_token');

// Register a custom REST API endpoint for token retrieval
function custom_rest_api_endpoint_get_view_restaurant() {
  register_rest_route('custom/v1', '/view-restaurant', array(
      'methods' => 'GET',
      'callback' => 'get_view_restaurant',
  ));
}
add_action('rest_api_init', 'custom_rest_api_endpoint_get_view_restaurant');


function get_view_restaurant( $request ){
  $headers = getallheaders();
  if (isset($headers['Authorization'])) { 
    $authorization = explode(' ', $headers['Authorization']);
    //return $authorization;
    switch ($authorization[0]) {
      case 'Basic':
        // Handle basic authentication.
        break;
      case 'Bearer':
        // Handle bearer authentication.
        $access_code = $authorization[1];
        $decoded_code = decoding_access_code($access_code);

        return $decoded_code;

        break;
      default:
        // Handle other authentication schemes.
    }
  }

}


// Callback function for generating and returning an access token
function get_access_token($request) {

  $username_param = $request->get_param('username');
  $password_param = $request->get_param('password');
  // Implement your authentication logic here to validate the user's credentials
  $authentication_result  = your_custom_authentication_logic($username_param, $password_param);

  if ( $authentication_result['authenticated'] ) {

      // Authentication was successful, extract the user data
      $user_data = $authentication_result['user_data'];

      // generate or get Access Token from function generate_or_get_access_token()
      $access_token = generate_or_get_access_token($username_param, $password_param);

      // Generate an access token (for example, a random string)
      //$access_token = bin2hex(random_bytes(16));

      // Calculate the expiration time (2 days from now)
      //$expiration_time = strtotime('+2 days');

      // Return the access token in the API response
      return array(
        'access_token' => $access_token,
        'user_data' => $user_data
      );

  } else {
      return new WP_Error(
          'rest_authentication_failed',
          __('Authentication failed.'),
          array('status' => 401)
      );
  }
}

// Replace this function with your actual authentication logic
function your_custom_authentication_logic($username, $password) {

 // Attempt to authenticate the user
 $user = wp_authenticate($username, $password);

 // Check if the authentication was successful
 if (is_wp_error($user)) {

    return array(
      'authenticated' => false
    );
     // Authentication failed
     //return false;
 } else {

      // Authentication successful, extract user information
      $user_data = array(
          'username' => $user->user_login,  // User's username
          'email' => $user->user_email     // User's email
      );


      // Return the user data along with authentication success
      return array(
        'authenticated' => true,
        'user_data' => $user_data
      );

     // Authentication successful
     //return true;
 }

}

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generate_or_get_access_token($username, $password) {

  // Check if an access token and its expiration timestamp are stored in options
  $access_token = get_option('custom_access_token', '');
  $expiration_timestamp = get_option('custom_access_token_expiration', 0);

  // Get the current timestamp
  $current_timestamp = time();

  // If the access token is empty or it has expired, generate a new one
  // if (empty($access_token) || $current_timestamp > $expiration_timestamp) { }

      // Generate a new access token
      $key = '2511ad';
      $payload = [
          'iss' => 'localhost',
          'aud' => 'localhost',
          'username' => $username,
          'password' => $password
      ];
    
      $access_token = JWT::encode($payload, $key, 'HS256');

      // Calculate the expiration time (1 days from now)
      $expiration_timestamp = strtotime('+1 days');

      // Store the new access token and its expiration timestamp in options
      update_option('custom_access_token', $access_token);
      update_option('custom_access_token_expiration', $expiration_timestamp);


  $expiration_human_readable = date('Y-m-d H:i:s', $expiration_timestamp);

  //Returning Both access token and Expiry Date
  $access_token_details = array(
    'access_token' => $access_token,
    //'expiration_timestamp' => $expiration_timestamp,
    'expiration_timestamp' => $expiration_human_readable,
  );
  return $access_token_details;

  // Return the access token
  //return $access_token;
}

function decoding_access_code($access_token_details){
  $key = '2511ad';
  $decoded = JWT::decode($access_token_details, new Key($key, 'HS256'));
  return $decoded; 
}
 
// API with Parameters
// http://localhost/wpAPI/wp-json/custom/v1/get-access-token?username=admin&password=admin