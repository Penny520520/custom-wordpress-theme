<?php
/**
 * a control to display guide for font settings
 *
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */

 if(class_exists('WP_Customize_Control')){

    if(!class_exists('Music_Record_Font_Guide_customize_control')){

        class Music_Record_Font_Guide_customize_control extends WP_Customize_Control {

            public $type = 'message';

            public function render_content(){

                ?>
                    <span class='customize-control-title'>Help with this setting</span>
                    <p>To set your font you'll need to set three values which you should be able to see in the sidepanel of the Google Font UI</p>
                    <ol>
                        <li>The embed name:  This will usually have plus characters to replace spaces.  It might also have the weight.</li>
                        <li>The family name:  This will typically be the plain text version of the name.</li>                
                        <li>The fallback font: in the event that the Google font doesn't load.</li>
                    </ol>
                    <div>
                        <img style="max-width: 90%" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/font-guide.png'; ?>" >
                    </div>

                <?php
            }
        }
    }
 }

 ?>