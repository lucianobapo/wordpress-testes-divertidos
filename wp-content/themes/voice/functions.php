<?php
/*-----------------------------------------------------------------------------------*/
/*	Define Theme Vars
/*-----------------------------------------------------------------------------------*/

define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THEME_NAME', 'Voice' );
define( 'THEME_SLUG', 'voice' );
define( 'THEME_VERSION', '1.1' );
define( 'THEME_OPTIONS', 'vce_settings' );
define( 'JS_URI', THEME_URI . 'js' );
define( 'CSS_URI', THEME_URI . 'css' );
define( 'IMG_DIR', THEME_DIR . 'images' );
define( 'IMG_URI', THEME_URI . 'images' );

if ( !isset( $content_width ) ) {
	$content_width = 730;
}


/*-----------------------------------------------------------------------------------*/
/*	After Theme Setup
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'vce_theme_setup' );

function vce_theme_setup() {

	/* Load frontend scripts and styles */
	add_action( 'wp_enqueue_scripts', 'vce_load_scripts' );

	/* Load admin scripts and styles */
	add_action( 'admin_enqueue_scripts', 'vce_load_admin_scripts' );

	/* Register sidebars */
	add_action( 'widgets_init', 'vce_register_sidebars' );

	/* Register menus */
	add_action( 'init', 'vce_register_menus' );

	/* Register widgets */
	add_action( 'widgets_init', 'vce_register_widgets' );

	/* Add thumbnails support */
	add_theme_support( 'post-thumbnails' );


	/* Add image sizes */
	$image_sizes = vce_get_image_sizes();
	$image_sizes_opt = vce_get_option( 'image_sizes' );
	foreach ( $image_sizes as $id => $size ) {
		if ( isset( $image_sizes_opt[$id] ) && $image_sizes_opt[$id] ) {
			add_image_size( $id, $size['w'], $size['h'], $size['crop'] );
		}
	}

	/* Add post formats support */
	add_theme_support( 'post-formats', array(
			'audio', 'gallery', 'image', 'video'
		) );

	/* Support for HTML5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery' ) );

	/* Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

}








/*-----------------------------------------------------------------------------------*/
// Inicio Area Inserir Imagens na criação do post, single.php
/*-----------------------------------------------------------------------------------*/
$sp_boxes = array (
    'Informações do Jogo' => array (
    array( 'howto2', 'URL Imagem usuário deslogado', 'textarea' ),
    array( 'howto1', 'URL imagem 1', 'textarea' ),
    array( 'howto3', 'URL imagem 2', 'textarea' ),
    array( 'howto4', 'URL imagem 3', 'textarea' ),
    array( 'howto5', 'URL imagem 4', 'textarea' ),
    array( 'howto6', 'URL imagem 5', 'textarea' ),
    array( 'howto7', 'URL imagem 6', 'textarea' ),
    array( 'howto8', 'URL imagem 7', 'textarea' ),
    array( 'howto9', 'Tamanho da foto', 'textarea' ),
    array( 'howto10', 'Posição da foto - top-left (default)', 'textarea' ),
    array( 'howto11', 'Valor eixo X - Margem Lateral da esquerda para direita', 'textarea' ),
    array( 'howto12', 'Valor eixo Y - Margem Superior de cima para baixo', 'textarea' ),
    array( 'howto13', 'Tamnho Nome do Usuário', 'textarea' ),
    array( 'howto14', 'Valor eixo X - Margem Lateral da esquerda para direita', 'textarea' ),
    array( 'howto15', 'Valor eixo Y - Margem Superior de cima para baixo', 'textarea' ),
    array( 'howto16', 'Cor do Nome - Em codigo RGB', 'textarea' ),
    ),
);



// Do not edit past this point.

// Use the admin_menu action to define the custom boxes
add_action( 'admin_menu', 'sp_add_custom_box' );

// Use the save_post action to do something with the data entered
// Save the custom fields
add_action( 'save_post', 'sp_save_postdata', 1, 2 );

// Adds a custom section to the "advanced" Post and Page edit screens
function sp_add_custom_box() {
    global $sp_boxes;

    if ( function_exists( 'add_meta_box' ) ) {

        foreach ( array_keys( $sp_boxes ) as $box_name ) {
            add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'post', 'normal', 'high' );
        }
    }
}

function sp_post_custom_box ( $obj, $box ) {
    global $sp_boxes;
    static $sp_nonce_flag = false;

    // Run once
    if ( ! $sp_nonce_flag ) {
        echo_sp_nonce();
        $sp_nonce_flag = true;
    }

    // Genrate box contents
    foreach ( $sp_boxes[$box['id']] as $sp_box ) {
        echo field_html( $sp_box );
    }
}

function field_html ( $args ) {

    switch ( $args[2] ) {

        case 'textarea':
            return text_area( $args );

        case 'checkbox':
            // To Do

        case 'radio':
            // To Do

        case 'text':
        default:
            return text_field( $args );
    }
}

function text_field ( $args ) {
    global $post;

    // adjust data
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );

    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<input style="width: 95%%;" type="text" name="%1$s" value="%3$s" /><br /><br />';

    return vsprintf( $label_format, $args );
}

function text_area ( $args ) {
    global $post;

    // adjust data
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );

    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';

    return vsprintf( $label_format, $args );
}

/* When the post is saved, saves our custom data */
function sp_save_postdata($post_id, $post) {
    global $sp_boxes;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post->ID ))
            return $post->ID;

    } else {
        if ( ! current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
    }

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    // The data is already in $sp_boxes, but we need to flatten it out.
    foreach ( $sp_boxes as $sp_box ) {
        foreach ( $sp_box as $sp_fields ) {
            $my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
        }
    }

    // Add values of $my_data as custom fields
    // Let's cycle through the $my_data array!
    foreach ($my_data as $key => $value) {
        if ( 'revision' == $post->post_type  ) {
            // don't store custom data twice
            return;
        }

        // if $value is an array, make it a CSV (unlikely)
        $value = implode(',', (array)$value);

        if ( get_post_meta($post->ID, $key, FALSE) ) {

            // Custom field has a value.
            update_post_meta($post->ID, $key, $value);


        } else {

            // Custom field does not have a value.
            add_post_meta($post->ID, $key, $value);
        }

        if (!$value) {

            // delete blanks
            delete_post_meta($post->ID, $key);
        }
    }
}

function echo_sp_nonce () {

    // Use nonce for verification ... ONLY USE ONCE!
    echo sprintf(
        '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
        'sp_nonce_name',
        wp_create_nonce( plugin_basename(__FILE__) )
    );
}

// A simple function to get data stored in a custom field
if ( !function_exists('get_custom_field') ) {
    function get_custom_field($field) {
       global $post;
       $custom_field = get_post_meta($post->ID, $field, true);
       echo $custom_field;
    }
}
/*-----------------------------------------------------------------------------------*/
// Fim Area Inserir Imagens na criação do post, single.php
/*-----------------------------------------------------------------------------------*/










/* Load frontend styles */
function vce_load_styles() {

	//Load fonts
	$fonts = vce_generate_font_links();
	if ( !empty( $fonts ) ) {
		foreach ( $fonts as $k => $font ) {
			wp_register_style( 'vce_font_'.$k, $font, false, THEME_VERSION, 'screen' );
			wp_enqueue_style( 'vce_font_'.$k );
		}
	}

	//Load main css file
	wp_register_style( 'vce_style', THEME_URI . '/style.css', false, THEME_VERSION, 'screen, print' );
	wp_enqueue_style( 'vce_style' );

	//Enqueue font awsm icons if css is not already included via plugin
	if ( !wp_style_is( 'mks_shortcodes_fntawsm_css', 'enqueued' ) ) {
		wp_register_style( 'vce_font_awesome', CSS_URI . '/font-awesome.min.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( 'vce_font_awesome' );
	}

	//Load responsive css
	if ( vce_get_option( 'responsive_mode' ) ) {
		wp_register_style( 'vce_responsive', CSS_URI . '/responsive.css', array('vce_style'), THEME_VERSION, 'screen' );
		wp_enqueue_style( 'vce_responsive' );
	}

	//Load RTL css
	if ( vce_get_option( 'rtl_mode' ) ) {
		wp_register_style( 'vce_rtl', CSS_URI . '/rtl.css', array('vce_style'), THEME_VERSION, 'screen' );
		wp_enqueue_style( 'vce_rtl' );
	}

	//Append dynamic css
	$vce_dynamic_css = vce_generate_dynamic_css();
	wp_add_inline_style( 'vce_style', $vce_dynamic_css );
}


/* Load frontend scripts */
function vce_load_scripts() {

	vce_load_styles();

	wp_enqueue_script('vce_images_loaded', JS_URI . '/imagesloaded.pkgd.min.js', array('jquery'), THEME_VERSION, true);
	wp_enqueue_script( 'vce_owl_slider', JS_URI . '/owl.carousel.min.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'vce_affix', JS_URI . '/affix.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'vce_match_height', JS_URI . '/jquery.matchHeight.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'vce_fitvid', JS_URI . '/jquery.fitvids.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'vce_responsivenav', JS_URI . '/jquery.sidr.min.js', array( 'jquery' ), THEME_VERSION, true );

	if ( is_singular() ) {
		wp_enqueue_script( 'vce_magnific_popup', JS_URI . '/jquery.magnific-popup.min.js', array( 'jquery' ), THEME_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'vce_custom', JS_URI . '/custom.js', array( 'jquery' ), THEME_VERSION, true );
	$vce_js_settings = vce_get_js_settings();
	wp_localize_script( 'vce_custom', 'vce_js_settings', $vce_js_settings );
}

/* Load admin scripts and styles */
function vce_load_admin_scripts() {

	global $pagenow, $typenow;

	//Load amdin css
	wp_register_style( 'vce_admin_css', CSS_URI . '/admin.css', false, THEME_VERSION, 'screen' );
	wp_enqueue_style( 'vce_admin_css' );

	//Load category JS
	if ( $pagenow == 'edit-tags.php' && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'vce_category', JS_URI.'/metaboxes-category.js', array( 'jquery', 'wp-color-picker' ), THEME_VERSION );
	}

	//Load post & page metaboxes css and js
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		if ( $typenow == 'post' ) {
			wp_enqueue_script( 'vce_post_metaboxes', JS_URI.'/metaboxes-post.js', array( 'jquery' ), THEME_VERSION );
		} elseif ( $typenow == 'page' ) {
			wp_enqueue_script( 'vce_post_metaboxes', JS_URI.'/metaboxes-page.js', array( 'jquery' ), THEME_VERSION );
		}
	}

}

/* Support localization */
load_theme_textdomain( THEME_SLUG, THEME_DIR . '/languages' );


/*-----------------------------------------------------------------------------------*/
/*	Theme Includes
/*-----------------------------------------------------------------------------------*/


/* Helpers and utility functions */
require_once 'include/helpers.php';

/* Menus */
require_once 'include/menus.php';

/* Sidebars */
require_once 'include/sidebars.php';

/* Widgets */
require_once 'include/widgets.php';

/* Add custom metaboxes for standard post types */
require_once 'include/metaboxes.php';

/* Snippets (modify/add some special features to this theme) */
require_once 'include/snippets.php';

/* Simple mega menu solution */
require_once 'include/mega-menu.php';

/* Include AJAX action handlers */
require_once 'include/ajax.php';

/* Include plugins (required or recommended for this theme) */
require_once 'include/plugins.php';

/* Theme Options */
require_once 'include/options.php';



?>