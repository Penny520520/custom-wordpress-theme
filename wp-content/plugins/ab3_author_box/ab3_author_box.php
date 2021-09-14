<?php
/**
 * @package Author Box
 * @version 1.0.0
 */
/*
Plugin Name: Author Box
Plugin URI: 
Description: This plugin will let you write a title, description and an image for an author.
Author: Penny LI
Version: 1.0.0
Author URI: 
*/

// keep from throwing error if class already has been added
if ( ! class_exists( 'AB3_Author_Box_Display' ) ) {

	class AB3_Author_Box_Display {
		
		// constructor
		public function __construct() {		

            if(is_admin()){

				//enqueue fiels
				add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_files'), 1);
                
                // hook for the admin page 
                add_action( 'admin_menu', array( $this, 'create_plug_settings_page' ) );

                // hook to create the sections
                add_action( 'admin_init', array( $this, 'setup_sections' ) );

                // hook to add the fields
                add_action( 'admin_init', array( $this, 'setup_fields' ) );
            }
            else{

				//enqueue fiels
				add_action('wp_enqueue_scripts', array($this, 'enqueue_public_files'), 100);

                // shorcode to public functionality 
				add_shortcode('ab3_author_box', array($this, 'get_author_shortcode'));
            }			
		}

        // ******************************  PUBLIC METHODS ******************************
		//enqueue css 
		function enqueue_public_files(){
			wp_enqueue_style('ab3-public-css', plugins_url('assets/css/ab3-author-box.css', __FILE__), array(), '1.0.0');
		}

		//add shortcode
        function get_author_shortcode($attr, $content=null){

			ob_start();

			?>
				<div class="ab3-author-box-container">
					<div class="ab3-author-box-block">
						<h3 class="ab3-author-box-header">
							<?php echo get_option('ab3_author_box');  ?>
						</h3>

						<div class="ab3-author-box-item">
							<!-- image TBA -->
							<img  src="<?php echo get_option('ab3_media_attachment_id'); ?>" >
						</div>

						<P class="ab3-author-box-caption">
						<?php echo get_option('ab3_author_caption');  ?>
						</P>
					</div>

				</div>


			<?php

			return ob_get_clean();
		}

        // ******************************  ADMIN METHODS ******************************
		//enqueue js file
		function enqueue_admin_files(){
			
			wp_enqueue_media();

			wp_enqueue_script('ab3-media-uploader', plugins_url('assets/js/admin-media-uploader.js', __FILE__), array('jquery'));
		}

		//create setting at admin ui
        public function create_plug_settings_page(){

			$page_title = 'Author Box Display';  
			$menu_title = 'Author Box';  
			$capability = 'manage_options';  
			$menu_slug = 'ab3_author_box_display';	
			$function = array( $this, 'plugin_settings_page_content' ); 
			
			
			add_submenu_page('options-general.php', $page_title, $menu_title, $capability, $menu_slug, $function, null );		

		}

		// add settings on this plugin
		public function plugin_settings_page_content(){
			?>
				<div class="wrap">
					<h2>AB3 - author Box Display Settings</h2>
					<form method="post" action="options.php">
						<?php
							// NOTE: match the menu_slug in the create function
							settings_fields( 'ab3_author_box_display' );  
							do_settings_sections( 'ab3_author_box_display' );
							submit_button();
						?>
					</form>
				</div> 
			<?php
		}
		//add options under setting
		public function setup_sections(){

			add_settings_section( 'plugin_about', 'About this plugin', array( $this, 'section_callback' ), 'ab3_author_box_display' );

			add_settings_section( 'plugin_options', 'Options', array( $this, 'section_callback' ), 'ab3_author_box_display' );
		
		}
		//echo content for each option
		public function section_callback( $arguments ) {
			
			switch( $arguments['id'] ){
				case 'plugin_about':
					echo 'This plugin allow you to select an author box and then use the [ab3_author_box] short code to add it to a page or post ';
					break;
				case 'plugin_options':
					echo 'Options Section';
					break;			
			}
		}
		//set up fields for options
		public function setup_fields() {

			$fields = array(
				array(
					'uid' => 'ab3_author_box',
					'label' => 'Author Box',
					'section' => 'plugin_options',
					'type' => 'text',
					'placeholder' => 'title for the author',
					'supplemental' => 'If you leave this empty no title will be displayed',
					'helper' => '',
					'default' => ''
                ),
                array(

					'uid' => 'ab3_author_caption',
					'label' => 'Author Caption',
					'section' => 'plugin_options',
					'type' => 'textarea',
					'placeholder' => 'caption for the author',
					'supplemental' => 'If you leave this empty no caption will be displayed',
					'helper' => '',
					'default' => ''
				),
				array(
					'uid' => 'ab3_media_attachment_id',
					'label' => 'Selected Media',
					'section' => 'plugin_options',
					'type' => 'media',
					'placeholder' => '',
					'supplemental' => '',
					'helper' => '',
					'default' => ''
                )
			);

			foreach( $fields as $field ){
				// field, label, callback fn, options page, section id, args
				add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'ab3_author_box_display', $field['section'], $field );
				register_setting( 'ab3_author_box_display', $field['uid'] );
            }				
		}

		public function field_callback( $arguments ) {
			$value = get_option( $arguments['uid'] ); // Get the current value, if there is one
			
			if( ! $value ) { // If no value exists
				$value = $arguments['default']; // Set to our default
			}
		
			// Check which type of field we want
			switch( $arguments['type'] ){
				case 'text': 
					printf( 
						'<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', 
						$arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
					break;				
				case 'textarea': 
					printf( 
						'<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', 
						$arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                    break;   
				case 'media':
					//this one needs both an input to hold the path and a button
					?>
					<input id="<?php echo $arguments['uid']; ?>" type="text"
						name="<?php echo $arguments['uid']; ?>"
						value="<?php echo get_option($arguments['uid']); ?>" readonly />
						
					<input id="upload_image_button"
						data-target-textbox="<?php echo $arguments['uid']; ?>"
						type="button" class="button-primary" value="Select Image" />
					
					<?php
					break;
			}
		
			// If there is help text
			if( $helper = $arguments['helper'] ){
				printf( '<span class="helper"> %s</span>', $helper ); // Show it
			}
		
			// If there is supplemental text
			if( $supplimental = $arguments['supplemental'] ){
				printf( '<p class="description">%s</p>', $supplimental ); // Show it
			}
		}
        
	}
	
	// instantiates the plugin
	new AB3_Author_Box_Display();
}

?>



