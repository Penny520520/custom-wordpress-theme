<?php
/**
 * registration for customizer UI.
 * 
 * CONTENTS:
 *  - customoizer_registration
 * - sanatization method
 * - valid methods
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */

/**
  * Includes for custom controls as each is in their own file
  */

include_once(get_stylesheet_directory().'/classes/class-guide-control.php');

 /**
  * calls to various reg function
  */

  function music_record_customizer_registration_all($wp_customize){

    music_record_add_to_site_identity($wp_customize);
    music_record_add_content_display_section($wp_customize);
    music_record_add_social_icon_section($wp_customize);
    music_record_add_to_color($wp_customize);
    music_record_add_to_font($wp_customize);
  }

  /**
   * Site identity section (aka title_tagline)
   */

   function music_record_add_to_site_identity($wp_customize){

       //register the setting
        $wp_customize->add_setting('copyright_text',
            array(
                'transport' => 'refresh',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'validate_callback' => '',
                'sanitize_callback' => ''
            )
        );

       //register the control to use the setting
       //esc_html???????????????????????????
       $wp_customize->add_control('copyright_text',
            array(
                'label' => __('Copyright Text'),
                'description' => esc_html__('The text following the @ sign in the footer'),
                'section' => 'title_tagline',
                'priority' =>10,
                'type' => 'text',
                'capability' => 'edit_theme_options',
                'input_attrs' => array(
                    'class' => 'copyright',
                    'placeholder' => __('Enter the copyright name...')
                ),
            )
        );
   }

   /**
 * New section Content Options and two controls
 */
function music_record_add_content_display_section($wp_customize){
    $wp_customize->add_section( 'content_display_section',
        array(
            'title' => __( 'Content Options' ),
            'description' => esc_html__( 'Blog and post options' ),
            'priority' => 160,
            'capability' => 'edit_theme_options', 
        )
    );

    $wp_customize->add_setting( 'show_post_date',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => ''
        )
    );
        
    $wp_customize->add_control( 'show_post_date',
        array(
            'label' => __( 'Show Post Date', 'ephemeris' ),
            'description' => esc_html__( 'Show the date with post titles.' ),
            'section' => 'content_display_section',
            'priority' => 10, 
            'type' => 'checkbox',
            'capability' => 'edit_theme_options', 
        )
    );

    $wp_customize->add_setting( 'home_grid_size',
        array(
            'default' => 12,
            'transport' => 'refresh',
            'sanitize_callback' => ''
        )
    );
        
    $wp_customize->add_control( 'home_grid_size',
        array(
            'label' => __( 'Blog page layout' ),
            'description' => esc_html__( 'How many posts should display per row on the blog page.' ),
            'section' => 'content_display_section',
            'priority' => 10, 
            'type' => 'radio',
            'capability' => 'edit_theme_options', 
            'choices' => array( 
                '12'    => __( 'One post per row' ),
                '6'     => __( 'Two posts per row' ),
                '4'     => __( 'Three posts per row' ),
                '3'     => __( 'Four posts per row' )
            )
        )
    );

}

/**
 * add new section for social and options for social icons in the footer
 */

 function music_record_add_social_icon_section($wp_customize) {

    //add a section to the default panel
    $wp_customize->add_section('social_icon_section',
        array(
            'title' => __('Social Icons'),
            'description' => esc_html__('Selected social icons in the footer'),
            'priority' => 160,
            'capability' => 'edit_theme_options'
        )
    );

    //icon type: 0=square, 1=no-square version
    // $wp_customize->add_setting('footer_social_icon_type',
    //     array(
    //         'transport' => 'refresh',
    //         'default' => 0,
    //         'type' => 'theme_mod',
    //         'validate_callback' => '',
    //         'sanitize_callback' => ''
    //     )
    // );

    // $wp_customize->add_control('footer_social_icon_type')

    //links for the four icons (if null won;t show in footer)
    $wp_customize->add_setting('footer_fb_link',
        array(
            'transport' => 'refresh',
            'type' => 'theme_mod',
            'validate_callback' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
        
    );

    //fb control
    $wp_customize->add_control('footer_fb_link',
        array(
            'label' => __('Facebook'),
            'section' => 'social_icon_section',
            'type' => 'url'
        )
    );

    // ig setting    
    $wp_customize->add_setting( 'footer_ig_link',
        array(
            'transport' => 'refresh', 
            'type' => 'theme_mod', 
            'validate_callback' => '', 
            'sanitize_callback' => 'esc_url_raw'  // should work with standard url
        )
    );

    // ig control
    $wp_customize->add_control( 'footer_ig_link',
        array(
            'label' => __( 'Instagram' ),
            'section' => 'social_icon_section',
            'type' => 'url', 
        )
    );

     // pinterest setting    
     $wp_customize->add_setting( 'footer_pt_link',
     array(
         'transport' => 'refresh', 
         'type' => 'theme_mod', 
         'validate_callback' => '', 
         'sanitize_callback' => 'esc_url_raw'  // should work with standard url
     )
    );

    // pinterest control
    $wp_customize->add_control( 'footer_pt_link',
        array(
            'label' => __( 'Pinterest' ),
            'section' => 'social_icon_section',
            'type' => 'textarea', 
        )
    );

 }

 /**
  * add background colours to specific template parts
  */

  function music_record_add_to_color($wp_customize){
    
    //colors section exists, just need to add a control

    //the banner bg setting
    $wp_customize->add_setting('banner_background_color',
        array(
            'default' => '#000000',
            'transport' => 'refresh',
            'sanitize_call' => 'sanitize_hex_color'
        )
    );

    //the banner bg control, background control is a complex object version
    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'banner_background_color',
            array(
                'label' => 'Home banner Background Color',
                'section' => 'colors',
                'settings' => 'banner_background_color'
            )
        )

    );

    //the service bg setting
    $wp_customize->add_setting('service_background_color',
        array(
            'default' => '#FFFFFF',
            'transport' => 'refresh',
            'sanitize_call' => 'sanitize_hex_color'
        )
    );

    //the service bg control, background control is a complex object version
    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'service_background_color',
            array(
                'label' => 'Home service Background Color',
                'section' => 'colors',
                'settings' => 'service_background_color'
            )
        )

    );

     //the featuredImg bg setting
     $wp_customize->add_setting('featuredImg_background_color',
        array(
            'default' => '#000000',
            'transport' => 'refresh',
            'sanitize_call' => 'sanitize_hex_color'
        )
    );

    //the featuredImg bg control, background control is a complex object version
    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'featuredImg_background_color',
            array(
                'label' => 'Home featured Image Background Color',
                'section' => 'colors',
                'settings' => 'featuredImg_background_color'
            )
        )

    );
  }

  /**
   * add google font options to h1, h2
   */

  function music_record_add_to_font($wp_customize){

    //add a section to the default panel
    $wp_customize->add_section('font_section',
        array(
            'title' => __('Typography'),
            'description' => esc_html__('Selected Google Fonts for Heading H1'),
            'priority' => 50,
            'capability' => 'edit_theme_options'
        )
    );

    // ***********  CG: the embed name EG: 'Open+Sans:wght@300'
    //add setting inside section
    // don't understand why ?????????????????????????
    $wp_customize->add_setting('heading_font_embed',
        array(
            'transport' => 'refresh',
            'type' => 'theme_mod',
            'validate_callback' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
        
    );    
    
    $wp_customize->add_control('heading_font_embed',
        array(
            'label' => __('Embed Font Slug'),
            'section' => 'font_section',
            'type' => 'text'
        )
    );

    //add font family setting inside section
    $wp_customize->add_setting('heading_font_family',
        array(
            'transport' => 'refresh',
            'type' => 'theme_mod',
            'validate_callback' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
        
    );

    //title h1 control
    $wp_customize->add_control('heading_font_family',
        array(
            'label' => __('Google Font Family for Heading'),
            'section' => 'font_section',
            'type' => 'text'
        )
    );

    //add font weight setting inside section
    // $wp_customize->add_setting('heading_font_weight',
    //     array(
    //         'transport' => 'refresh',
    //         'type' => 'theme_mod',
    //         'validate_callback' => '',
    //         'sanitize_callback' => 'sanitize_text_field'
    //     )
        
    // );

    // //title font weight h1 control
    // $wp_customize->add_control('heading_font_weight',
    //     array(
    //         'label' => __('Google Font Weight for Heading'),
    //         'section' => 'font_section',
    //         'type' => 'text'
    //     )
    // );

    //add font fallback setting inside section
    $wp_customize->add_setting('heading_font_fallback',
        array(
            'transport' => 'refresh',
            'type' => 'theme_mod',
            'validate_callback' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
        
    );

    //title font fallback h1 control
    $wp_customize->add_control('heading_font_fallback',
        array(
            'label' => __('Google Font fallback for Heading'),
            'section' => 'font_section',
            'type' => 'select',
            'capability' => 'edit_theme_options',
            'choices' => array( 
                'serif'    => __( 'Serif' ),
                'sans-serif'     => __( 'Sans Serif' ),
                'monospace'     => __( 'Monospace' ),
                'cursive'     => __( 'Cursive' ),
                'fantasy'     => __( 'Fantasy' ),
            )
        )
    );

    //our custom message control example
    //for the message you still need a setting even if it doesn;t set anything
    $wp_customize->add_setting('front_guide', 
    
        array(
            'default' => '',
            'sanitize_callback' => ''
        )
    );

    $wp_customize->add_control( new Music_Record_Font_Guide_customize_control(
        $wp_customize, 'front_guide',
        array(
            'label' => esc_html__('NOTE'),
            'description' => '',
            'settings' => 'front_guide',
            'section' =>'font_section',
            'priority' => 20
        )

        )

    );

  }