<?php

/**
 * The Load Theme.
 */
add_action('after_setup_theme', 'after_setup_theme_function');
function after_setup_theme_function() {
	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'post-thumbnails' ); // To add Custom Thumbnail Sizes
	add_theme_support( 'title-tag' );
};

/**
 * The Head Cleanup - clean up of WordPress head, taken from Bones Theme.
 */
add_action('init', 'init_function');
function init_function() {

	//give editors permissions
	$role_object = get_role( 'editor' );
	// to change menus
	$role_object->add_cap( 'edit_theme_options' );

	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// index link
	remove_action('wp_head', 'index_rel_link'); 
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	
	// Remove WordPress version from css
	add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);
	// Remove WordPress version from scripts
	add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);

	// Uncomment when need Custom Post Type for a webiste.
	// require_once 'post-types/custom-post-type.php';

}

/**
 * Remove WordPress version from RSS.
 */
add_filter('the_generator', function() { 
	return ''; 
});

/**
 * Remove WordPress version from scripts.
 */
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/**
 * To enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'enqueue_scripts_function');
function enqueue_scripts_function() {

	// Add CSS/JS only in Front-end.
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		wp_enqueue_style ( 'bootstrapcss', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );
		wp_enqueue_style ( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
		wp_enqueue_style ( 'style', get_stylesheet_directory_uri() . '/css/style.css' );
	}

    // This also removes some inline CSS variables for colors since 5.9 - global-styles-inline-css
    wp_dequeue_style( 'global-styles' );
    // WooCommerce - you can remove the following if you don't use Woocommerce
    wp_dequeue_style( 'wc-blocks-vendors-style' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'wp-webfonts' );

}

/**
 * Remove Emoji Styles and JS.
 * Default Load by WordPress.
 * Author: ETS.
 */
remove_action( 'wp_head', 'wp_resource_hints', 2, 99 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script', 7 );

/**
 * Add/Load CSS and JS files in Footer.
 * Author: ETS.
 */
add_action( 'wp_footer', 'add_js_footer_function' );
function add_js_footer_function() {
	// Load CSS/JS only on Frontend.
	if (!is_admin()) {
		wp_enqueue_script( 'bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js' );

		wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js' );
		// wp_enqueue_style ( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style ( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css' );
	}
}

/**
 * Register WordPress Nav Menus.
 * Author: ETS.
 */
register_nav_menus(
	array(
		'primary-navigation' => __( 'Primary Navigation' ),
	)
); 

/**
 * Add Extra dimmenssion for Image library.
 * Author: ETS.
 */
add_image_size( 'large-thumbnail', 300, 300, true );
add_image_size( 'full-width', 1200, 9999, false );

/**
 * Add Option Page with ACF Plugin.
 * ACF Paid Plugin.
 * Author: ETS.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * register an API key for google maps to work in ACF backend. also add to wp_register_script above.
 * https://developers.google.com/maps/documentation/javascript/get-api-key
 * Author: ACF Plugin.
 */
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
 function my_acf_google_map_api( $api ){
	$api['key'] = '';
	return $api;	
}

/**
 * set gallery link default to media file instead of attachment page
 * Author: ETS.
 */
add_filter( 'media_view_settings', function ( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
	//$settings['galleryDefaults']['columns'] = '5';
    return $settings;
});

/**
 * remove some sections of admin
 * Author: ETS.
 */
add_action('admin_menu', 'remove_admin_menu_function');
function remove_admin_menu_function() { 
	//lower than admin
	if(!current_user_can('activate_plugins')) {
		remove_menu_page('tools.php');
	}

	// Remove Posts Menu from admin - comment this line if no need of posts.
	// remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}

/**
 * make yoast appear at bottom of edit screens
 * Author: ETS.
 */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

/**
 * HELPER FUNCTION
 * Author: ETS.
 */
if(!function_exists('is_blog')){
	// is_blog();
	// @link https://gist.github.com/wesbos/1189639
	function is_blog() {
	    global $post;
	    //Post type must be 'post'.
	    $post_type = get_post_type($post);
	    //Check all blog-related conditional tags, as well as the current post type, 
	    //to determine if we're viewing a blog page.
	    return (
	        ( is_home() || is_archive() || is_single() )
	        && ($post_type == 'post')
	    ) ? true : false ;

	}
}

/**
 * Register Widgets.
 * Author: ETS.
 */
add_action('widgets_init','flexibond_widgets_init');
function flexibond_widgets_init() {
	register_sidebar(array(	
		'name'          => esc_html__('Page Sidebar', 'flexibond'),
		'id'            => 'page-sidebar',
		'description'   => esc_html__('Page Sidebar', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget page_sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 1 Widget Area', 'flexibond'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Footer 1', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget col-lg-3 col-md-6 col-sm-12 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 2 Widget Area', 'flexibond'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Footer 2', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget col-lg-3 col-md-6 col-sm-12 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 3 Widget Area', 'flexibond'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Footer 3', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget col-lg-3 col-md-6 col-sm-12 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 4 Widget Area', 'flexibond'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Footer 4', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget col-lg-3 col-md-6 col-sm-12 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Copyrights Widget Area', 'flexibond'),
		'id'            => 'copyrights',
		'description'   => esc_html__('Copyrights Widget', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}

/**
 * Breadcrumb.
 * Author: ETS.
 */
function ah_breadcrumb() {

	// Check if is front/home page, return
	if ( is_front_page() ) {
		return;
	}

	// Define
	global $post;
	$custom_taxonomy  = ''; // If you have custom taxonomy place it here
  
	$defaults = array(
	  'seperator'   =>  '',
	  'id'          =>  'ah-breadcrumb',
	  'classes'     =>  'ah-breadcrumb',
	  'home_title'  =>  esc_html__( 'Home', '' )
	);
  
	$sep  = '';
  
	// Start the breadcrumb with a link to your homepage
	echo '<ul id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';
  
	// Creating home link
	echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;
  
	if ( is_single() ) {
  
	  // Get posts type
	  $post_type = get_post_type();
  
	  // If post type is not post
	  if( $post_type != 'post' ) {
  
		$post_type_object   = get_post_type_object( $post_type );
		$post_type_link     = get_post_type_archive_link( $post_type );
  
		echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;
  
	  }
  
	  // Get categories
	  $category = get_the_category( $post->ID );
  
	  // If category not empty
	  if( !empty( $category ) ) {
  
		// Arrange category parent to child
		$category_values      = array_values( $category );
		$get_last_category    = end( $category_values );
		// $get_last_category    = $category[count($category) - 1];
		$get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
		$cat_parent           = explode( ',', $get_parent_category );
  
		// Store category in $display_category
		$display_category = '';
		foreach( $cat_parent as $p ) {
		  $display_category .=  '<li class="item item-cat">'. $p .'</li>' . $sep;
		}
  
	  }
  
	  // If it's a custom post type within a custom taxonomy
	  $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
  
	  if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
  
		$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
		$cat_id         = $taxonomy_terms[0]->term_id;
		$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
		$cat_name       = $taxonomy_terms[0]->name;
  
	  }
  
	  // Check if the post is in a category
	  if( !empty( $get_last_category ) ) {
  
		echo $display_category;
		echo '<li class="item item-current">'. get_the_title() .'</li>';
  
	  } else if( !empty( $cat_id ) ) {
  
		echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }
  
	} else if( is_archive() ) {
  
	  if( is_tax() ) {
		// Get posts type
		$post_type = get_post_type();
  
		// If post type is not post
		if( $post_type != 'post' ) {
  
		  $post_type_object   = get_post_type_object( $post_type );
		  $post_type_link     = get_post_type_archive_link( $post_type );
  
		  echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;
  
		}
  
		$custom_tax_name = get_queried_object()->name;
		echo '<li class="item item-current">'. $custom_tax_name .'</li>';
  
	  } else if ( is_category() ) {
  
		$parent = get_queried_object()->category_parent;
  
		if ( $parent !== 0 ) {
  
		  $parent_category = get_category( $parent );
		  $category_link   = get_category_link( $parent );
  
		  echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;
  
		}
  
		echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';
  
	  } else if ( is_tag() ) {
  
		// Get tag information
		$term_id        = get_query_var('tag_id');
		$taxonomy       = 'post_tag';
		$args           = 'include=' . $term_id;
		$terms          = get_terms( $taxonomy, $args );
		$get_term_name  = $terms[0]->name;
  
		// Display the tag name
		echo '<li class="item-current item">'. $get_term_name .'</li>';
  
	  } else if( is_day() ) {
  
		// Day archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month link
		echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a></li>' . $sep;
  
		// Day display
		echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('F'). '</li>';
  
	  } else if( is_month() ) {
  
		// Month archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month Display
		echo '<li class="item-month item-current item">'. get_the_time('F') .'</li>';
  
	  } else if ( is_year() ) {
  
		// Year Display
		echo '<li class="item-year item-current item">'. get_the_time('Y') .'</li>';
  
	  } else if ( is_author() ) {
  
		// Auhor archive
  
		// Get the author information
		global $author;
		$userdata = get_userdata( $author );
  
		// Display author name
		echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';
  
	  } else {
  
		echo '<li class="item item-current">'. post_type_archive_title() .'</li>';
  
	  }
  
	} else if ( is_page() ) {
  
	  // Standard page
	  if( $post->post_parent ) {
  
		// If child page, get parents
		$anc = get_post_ancestors( $post->ID );
  
		// Get parents in the right order
		$anc = array_reverse( $anc );
  
		// Parent page loop
		if ( !isset( $parents ) ) $parents = null;
		foreach ( $anc as $ancestor ) {
  
		  $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;
  
		}
  
		// Display parent pages
		echo $parents;
  
		// Current page
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		// Just display current page if not parents
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }
  
	} else if ( is_search() ) {
  
	  // Search results page
	  echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';
  
	} else if ( is_404() ) {
  
	  // 404 page
	  echo '<li class="item-current item">' . 'Error 404' . '</li>';
  
	}
  
	// End breadcrumb
	echo '</ul>';
  
  }
  