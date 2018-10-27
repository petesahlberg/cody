<?php
add_editor_style( 'editor-style.css' );

define(STYLEDIR, get_stylesheet_directory_uri());

//admin styles
function pete_admin_styles_two() {
  echo '<style>';
  echo file_get_contents(STYLEDIR.'/assets/css/admin-style.css');
  echo '#menu-posts { display:none }';
  echo '</style>';
}

add_action('admin_head','pete_admin_styles_two', 2);


// Body Class

// Add specific CSS class by filter
add_filter( 'body_class', 'my_class_names' );
function my_class_names( $classes ) {
	// add 'class-name' to the $classes array
	$classes[] = 'cody';
	// return the $classes array
	return $classes;
}

// Custom Formats in Wysiwyg Editor

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Button',
			'selector' => 'a',
			'classes' => 'button-custom',
			'wrapper' => false,

		),
		array(
			'title' => 'Button Alt',
			'selector' => 'a',
			'classes' => 'button-custom-alt',
			'wrapper' => true,
		)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


//  CPT

function custom_post_project() {
  $labels = array(
    'name'               => _x( 'Project', 'post type general name' ),
    'singular_name'      => _x( 'Project', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Project' ),
    'edit_item'          => __( 'Edit Project' ),
    'new_item'           => __( 'New Project' ),
    'all_items'          => __( 'All Projects' ),
    'view_item'          => __( 'View Project' ),
    'search_items'       => __( 'Search Projects' ),
    'not_found'          => __( 'No projects found' ),
    'not_found_in_trash' => __( 'No projects found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Projects',
  );
  $args = array(
    'labels'        => $labels,
    'menu_icon' => 'dashicons-format-gallery',
    'description'   => 'Holds our projects and project specific data',
    'public'        => true,
    'menu_position' => 10,
    'taxonomies' => array('type'),
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','custom-fields','author', ),
    'has_archive'   => true,
		'rewrite' => array('slug' => 'work','with_front' => false),
  );
  register_post_type( 'project', $args );
}

add_action( 'init', 'custom_post_project');

// taxonomy

// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Types', 'textdomain' ),
		'all_items'         => __( 'All Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Type', 'textdomain' ),
		'update_item'       => __( 'Update Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Type', 'textdomain' ),
		'new_item_name'     => __( 'New Type Name', 'textdomain' ),
		'menu_name'         => __( 'Type', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category' ),
	);

	register_taxonomy( 'type', array( 'project' ), $args );

	// Port CITY

	function custom_post_images() {
	  $labels2 = array(
	    'name'               => _x( 'Images', 'post type general name' ),
	    'singular_name'      => _x( 'Image', 'post type singular name' ),
	    'add_new'            => _x( 'Add New Image', 'book' ),
	    'add_new_item'       => __( 'Add New Image' ),
	    'edit_item'          => __( 'Edit Image' ),
	    'new_item'           => __( 'New Image' ),
	    'all_items'          => __( 'All Images' ),
	    'view_item'          => __( 'View Image' ),
	    'search_items'       => __( 'Search Images' ),
	    'not_found'          => __( 'No images found' ),
	    'not_found_in_trash' => __( 'No images found in the Trash' ),
	    'parent_item_colon'  => '',
	    'menu_name'          => 'Port City',
	  );
	  $args2 = array(
	    'labels'        => $labels2,
	    'menu_icon' => 'dashicons-camera',
	    'description'   => 'Holds Port City images and their specific data',
	    'public'        => true,
	    'menu_position' => 10,
	    'taxonomies' => array('post_tag'),
	    'supports'      => array( 'title', 'thumbnail', 'author' ),
	    'has_archive'   => true,
			'rewrite' => array('slug' => 'port-city','with_front' => true),
	  );
	  register_post_type( 'image', $args2 );
	}

	add_action( 'init', 'custom_post_images');


//site logo
$args = array(
    'header-text' => array(
        'site-title',
        'site-description',
    ),
    'size' => 'medium',
);

add_theme_support( 'site-logo', $args );

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'news-post', 500, 300, true );
		add_image_size( 'cursor-image', 60, 60, true );
		add_image_size( 'port-city', 1000, 1000 );
}

include ('acf/blocks.php');


/// Disable CachingIterator

function disable_cache() { ?>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<?php }

//add_action('wp_head','disable_cache',10);

function about() {
if(is_page('info')) {
		get_template_part('template-parts/about');
	}
}

add_action('after_content','about');



// columns

//add_image_size( 'admin-list-thumb', 80, 80, false );

// add featured thumbnail to admin post columns
function cody_add_thumbnail_columns( $columns ) {
	  global $post;
    if(get_post_type() == 'image') {
      $columns = array(
          'cb' => '<input type="checkbox" />',
          'featured_thumb' => 'Thumbnail',
          'title' => 'Title',
          'author' => 'Author',
        //  'categories' => 'Categories',
          'tags' => 'Tags',
          'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
          'date' => 'Date'
      );
    } else {
      $columns = array(
          'cb' => '<input type="checkbox" />',
          'featured_thumb' => 'Thumbnail',
          'title' => 'Title',
          'author' => 'Author',
          'categories' => 'Categories',
          //'tags' => 'Tags',
          'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
          'date' => 'Date'
      );
    }
    return $columns;
}

function cody_add_thumbnail_columns_data( $column, $post_id ) {
   switch ( $column ) {
    case 'featured_thumb':
        echo '<a href="' . get_edit_post_link() . '">';
        echo the_post_thumbnail('cursor-image');
        echo '</a>';
        break;
   }
}

if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_edit-image_columns' , 'cody_add_thumbnail_columns' );
    add_action( 'manage_edit-image_column' , 'cody_add_thumbnail_columns_data', 10, 2 );

    add_filter( 'manage_edit-project_columns' , 'cody_add_thumbnail_columns' );
    add_action( 'manage_edit-project_column' , 'cody_add_thumbnail_columns_data', 10, 2 );
		//
    add_filter( 'manage_edit-image_columns' , 'cody_add_thumbnail_columns' );
    add_action( 'manage_image_posts_custom_column' , 'cody_add_thumbnail_columns_data', 10, 2 );

    add_filter( 'manage_edit-project_columns' , 'cody_add_thumbnail_columns' );
    add_action( 'manage_project_posts_custom_column' , 'cody_add_thumbnail_columns_data', 10, 2 );
}


// move metabox for images
if(is_admin() && get_post_type() == 'image') {
	add_action('do_meta_boxes', 'be_rotator_image_metabox' );
}
/**
 * Move Featured Image Metabox on 'rotator' post type
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/move-featured-image-metabox
 */
function be_rotator_image_metabox() {
	remove_meta_box( 'postimagediv', 'rotator', 'side' );
	add_meta_box('postimagediv', __('Custom Image'), 'post_thumbnail_meta_box', 'rotator', 'normal', 'high');
}
