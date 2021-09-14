<?php
/**
 * @package ws3_shortcode_test
 * @version 1.0.0
 */
/*
 Plugin Name: WS3 - shortcode_test
 Description: This plugin will test the addition of a short code in three forms
 Author: Penny Li
 Version: 1.0.0
 */

 //check if class WS3_ShortCode_Test exist
 if(!class_exists('WS3_ShortCode_Test')){


    class WS3_ShortCode_Test{

        //constructor
        public function __construct(){

            //register the shortcode
            add_shortcode('ws3_scode_alpha', array($this, 'get_test_alpha_shortcode'));
            add_shortcode('ws3_scode_beta', array($this, 'get_test_beta_shortcode'));
            add_shortcode('ws3_scode_gamma', array($this, 'get_test_gamma_shortcode'));
        }

        //************************************* PUBLIC METHODS
        //add author name
        function get_test_alpha_shortcode($atts, $content=null){


            //just a static block
            $message = '<h3>Alex Lee</h3>';

            //returnto the hook point
            return $message;
        }
        //add author name's style
        function get_test_beta_shortcode($atts, $content=null){

            //we can use shortcode_atts() to merge with defaults
            $a = shortcode_atts( array(
                'fore_color' => 'green',
                'back_color' => '#000000'
            ), $atts);

            $message =  '<h3 style="color:'. $a['fore_color'] . '; background-color:'. $a['back_color'] .'">Alex Lee | Enterperuership </h3>';
            return $message;
        }

        function get_test_gamma_shortcode($atts, $content=null){

            //we'll use output buffer since we are adding quite a bit of html
            ob_start();

            ?>
                <div style="margin-top: 25px; padding: 15px; border: 1px solid white; color: white;">
                    <h3 style="color: green;">Enterperuership |  <?php echo $content;  ?></h3>

                    <p style="font-size:18px;">Alex is a person who love her career. beside her work, she loves hiking and natures.</p>

                </div>

            <?php

            return ob_get_clean();
        }


        //************************************* ADMIN METHODS
    }

    //INstantiate the plugin
    new WS3_ShortCode_Test();
 }


 ?>