<?php
/**
 * Bootstrap Basic theme
 * 
 * @package bootstrap-basic
 */


/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
    $content_width = 1170;
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






if (!function_exists('bootstrapBasicSetup')) {
    /**
     * Setup theme and register support wp features.
     */
    function bootstrapBasicSetup() 
    {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // add support custom background
        add_theme_support(
            'custom-background', 
            apply_filters(
                'bootstrap_basic_custom_background_args', 
                array(
                    'default-color' => 'ffffff', 
                    'default-image' => ''
                )
            )
        );
    }// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {
    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() 
    {
        register_sidebar(array(
            'name'          => __('Header right', 'bootstrap-basic'),
            'id'            => 'header-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));

        register_sidebar(array(
            'name'          => __('Navigation bar right', 'bootstrap-basic'),
            'id'            => 'navbar-right',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        ));

        register_sidebar(array(
            'name'          => __('Sidebar left', 'bootstrap-basic'),
            'id'            => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));

        register_sidebar(array(
            'name'          => __('Sidebar right', 'bootstrap-basic'),
            'id'            => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));

        register_sidebar(array(
            'name'          => __('Footer left', 'bootstrap-basic'),
            'id'            => 'footer-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));

        register_sidebar(array(
            'name'          => __('Footer right', 'bootstrap-basic'),
            'id'            => 'footer-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
    }// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {
    /**
     * Enqueue scripts & styles
     */
    function bootstrapBasicEnqueueScripts() 
    {
        global $wp_scripts;

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.6');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.6', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
    }// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
    $bbsc_adminhelp = new BootstrapBasicAdminHelp();
    add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
    unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

