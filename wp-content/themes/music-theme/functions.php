<?php
/**
 * theme functions and definiations, this file loads automatically
 * 
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */
//remove the flush
remove_action('shutdown', 'wp_ob_end_flush_all', 1); add_action ('shutdown', function(){
    while (@ob_end_flush() ); } );

 include_once(get_stylesheet_directory().'/inc/customizer-reg.php');
 add_action('customize_register', 'music_record_customizer_registration_all');

add_theme_support('post-thumbnails');

/**
 * Register top nav menus  
 */
function music_record_music_menus_init(){

    //register 
    register_nav_menus(
        array(
            'navbar-menu' => __('Navbar Menu', 'music-record-studio'),
        )
        
    );
}

//hook up the action
add_action('init', 'music_record_music_menus_init');

/**
 * add additional class to navbar menu
 */
function add_menu_item_classes($classes, $item, $args){

    if(isset($arg->add_li_class)){

        if(in_array('current-menu-item'. $classes)){
            $classes[] ='active' . $args->add_li_class;
        }
        else {
            $classes[] = $args->add_li_class;
        }
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'add_menu_item_classes', 1, 3);

/**
 * add additional class to anchor by attribute
 */

function add_class_to_all_menu_anchors($atts, $item, $args){
    $atts['class'] = $args->add_link_class;

    return $atts;

}

add_filter('nav_menu_link_attributes', 'add_class_to_all_menu_anchors', 10, 3);



/**
 * Register our two sidebars
 */
function music_record_music_widgets_init(){
   
    //shared arguments
    $shared_args = array(
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'before_widget' => '<div class="widget-copy">',
        'after_widget' => '</div>'
    );

     //register the two sidebars
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Footer Left', 'music-record-studio'),
                'id'   => 'left-foot-sidebar',
                'description' => __('widgets in this area will be displayed in the left column in the footer', 'music-record-studio')
            )
        )

    );

    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Footer Right', 'music-record-studio'),
                'id'   => 'right-foot-sidebar',
                'description' => __('widgets in this area will be displayed in the right column in the footer', 'music-record-studio')
            )
        )

    );

}

//this will add the action hook
add_action('widgets_init', 'music_record_music_widgets_init');

/**
 * Compose a description tag
 * 
 */
 function music_record_set_meta_decription(){
    if(is_front_page()){
        //use the decription
        echo '<meta name="description" content="'. get_bloginfo('description') .'" />' . "\n\n";
    }
    else if(is_home()){
        echo '<meta name="description" content="Introduction for our Blog" />' . "\n\n";

    }
    else if (is_page() || is_single()){
        //give the excerpt, but need to strip it of html
        $post_excerpt = wp_strip_all_tags(get_the_excerpt(), true);
        $post_excerpt = str_replace('[&hellip]', '', $post_excerpt);
        echo '<meta name="description" content="'. $post_excerpt .'" />' . "\n\n";

    }
    else{
        //site decription
        echo '<meta name="description" content="'. get_bloginfo('description') .'" />' . "\n\n";

    }
 }

 add_action('wp_head', 'music_record_set_meta_decription');

/**
 * Function and hook for external files
 */

 function music_record_set_external_files(){
     //enqueue the four stylesheets from the the theme assets folder

    wp_enqueue_style('assets-reset', get_stylesheet_directory_uri() . '/assets/css/reset.css' , array(), '2.0.0');

    wp_enqueue_style('assets-bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css' , array(), '4.5.2');

    wp_enqueue_style('assets-common', get_stylesheet_directory_uri() . '/assets/css/common.css' , array(), null);

    wp_enqueue_style('template-root', '/style.css', array(), null);

    //enqueue an embedded css
    wp_enqueue_style('theme-styles', get_stylesheet_uri());

    //get the code
    $custom_css = music_record_create_customizer_css();

    //add the code to the embed
    wp_add_inline_style('theme-styles', $custom_css);

    //enqueue an embedded font css
    wp_enqueue_style('font-styles', get_stylesheet_uri());

    //get the code
    $custom_font_css = music_record_create_customizer_font_css();

    //add the code the embed  closed, because the errow at top for every page
    // wp_add_inline_style('font-styles', $custom_font_css, 'after');

    //enqueue the scripts, use the last param to force to the bottom
    wp_enqueue_script('assets-bootstrap', get_stylesheet_directory_uri().'/assets/js/bootstrap.bundle.min.js', array('assets-jquery'), '4.5.2',true);
   
    wp_enqueue_script('assets-jquery', get_stylesheet_directory_uri().'/assets/js/jquery-3.5.1.slim.min.js' , null, '3.5.1', true);

    //wp_enqueue_script('webfontloader', get_stylesheet_directory_uri().'/assets/js/webfont.js' , null, '1.6.28', true);

    
 }

 add_action('wp_head', 'music_record_set_external_files',1);

/**
 * kill admin bar
 */
function music_record_admin_bar(){
    return false;
};

add_filter('show_admin_bar', 'music_record_admin_bar');
 
/**
 * remove emojis and un-needed style files
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_script', 'print_empji_detection_script');
remove_action('wp_print_styles','print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * create embedded css based on the customizer settings
 */
function music_record_create_customizer_css(){

    //open buffer, think of it like a pending output stream
    //echo output buffer, and use buffer afterwards
    ob_start();

    //while ob_start ie the buffer all echos will go to the buffer
    if(get_theme_mod('banner_background_color', '') != ''){
        echo '.bnr {background-color: '. get_theme_mod('banner_background_color').'}';
    }

    if(get_theme_mod('service_background_color', '') != ''){
        echo '.service {background-color: '. get_theme_mod('service_background_color').'}';
    }

    if(get_theme_mod('featuredImg_background_color', '') != ''){
        echo '.gallery {background-color: '. get_theme_mod('featuredImg_background_color').'}';
    }
    //get and return the buffered content
    $css = ob_get_clean();
    return $css;
}


function music_record_create_customizer_font_css(){

    ob_start();

    if(get_theme_mod('heading_font_embed') && get_theme_mod('heading_font_family') && get_theme_mod('heading_font_fallback')){

        ?>
        <style>
          @import url('https://fonts.googleapis.com/css2?family=<?php echo get_theme_mod('heading_font_embed') ?>&display=swap');

          h1{
            font-family: '<?php echo get_theme_mod('heading_font_family') ?>', <?php echo get_theme_mod('heading_font_fallback') ?>;
          }
        </style>
        <?php
    }
    else{
        
        //echo 'h1 {font-family: 'Tahoma', sans-serif}';

        ?>
        <style>
          h1{
            font-family: 'Tahoma', sans-serif;
          }
        </style>
        <?php
      }

      //get and return the buffered content
      $css = ob_get_clean();
      return $css;
}
