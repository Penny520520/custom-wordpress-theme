<?php
/**
 * @package ws3_meta_tags
 * @version 1.0.0
 */
/*
 Plugin Name: WS3 - Meta Tags
 Description: This tag will add the ga code sippet and og tags to the head of every template
 Author: Penny Li
 Version: 1.0.0
 */

 //check to see if class WS3_Meta_Tags already exist
 if(!class_exists('WS3_Meta_Tags')){
    
    class WS3_Meta_Tags{

        //CONSTRUCTOR
        public function __construct(){

            //hook for the public schos
            add_action('wp_head', array($this, 'add_selected_tags'));

            //hook to show the mnu item at admin ui
            add_action('admin_menu', array($this, 'create_plug_settings_page'));

            //hook to reg sections to page
           add_action('admin_init', array($this, 'setup_sections'));

            //hook to reg fields
           add_action('admin_init', array($this, 'setup_fields'));

        }

        function add_selected_tags(){
            if(get_option('ws3_meta_ga_check')) {

                $this->add_ga_block();
            } 
            
            if(get_option('ws3_meta_og_check')) {
                $this->add_og_block();
             }
            
            
        }

        //**********PUBLIC METHODS 
        //add google analysis  at the header
        public function add_ga_block(){

            $ga_id = get_option('ws3_meta_ga_id');

            ?>
                <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id ?>"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '<?php echo $ga_id ?>');
                </script>

            <?php
        }
        //add dynamic open graph at the header
        public function add_og_block(){

            echo '<meta property="og:title" content="'. get_the_title() .'"  />' . PHP_EOL;
            echo '<meta property="og:url" content="'. get_permalink() .'" />' . PHP_EOL;
            echo '<meta property="og:type" content="' . ((is_page())? 'page' : 'article') .'" />' . PHP_EOL;
            echo '<meta property="og:description" content="'. get_the_excerpt() .'" />' . PHP_EOL;

            //check if a single page
            if(is_single()){

                //check to see if they've assigned a featured image
                if(has_post_thumbnail()){
                    //use the featured image
                    echo '<meta property="og:image" content="'. get_the_post_thumbnail_url() .'" />' . PHP_EOL;
                }
                else{
                    echo '<meta property="og:image" content="'. get_stylesheet_directory_url() .'/assets/images/no-image.png" />' . PHP_EOL;

                }
            }

            
        }



        //*************ADMIN METHODS 
        // add meta tags control to admin ui
        public function create_plug_settings_page(){

            $page_title = 'WS3 Meta Tags Plugin';  
            $menu_title = 'WS3 Meta'; 
            $capability = 'manage_options';  
            $menu_slug = 'ws3_meta_tags';  
            $function = array($this, 'plugin_settings_page_content');
            $icon_url = 'dashicons-admin-plugins'; 
            $position = 100;   


            //changed to sub-menu of settings
           add_submenu_page('options-general.php', $page_title, $menu_title, $capability, $menu_slug, $function, $position);

        }
        // add content to the meta tags plug 
        public function plugin_settings_page_content(){

            ?>
                <div class="wrap">
                    <h2>WS3 - Meta Tag Plugin Settings</h2>

                    <!-- fields setting -->
                    <form method="POST" action="options.php">
                        <?php
                            settings_fields('ws3_meta_tags');
                            do_settings_sections('ws3_meta_tags');
                            submit_button();

                        ?>

                    </form>

                
                </div>

            <?php
        }
        // laready register by admin init, now add section.
        public function setup_sections(){
            add_settings_section('plugin_about', 'About this plugin', array($this, 'section_callback'), 'ws3_meta_tags');
            add_settings_section('plugin_options', 'Options', array($this, 'section_callback'), 'ws3_meta_tags');

        }

        //add "about" for two plugins
        public function section_callback($arguments){

            switch($arguments['id']){
                case 'plugin_about':
                    echo 'This plugin allows you to add the Google Analytics script as well as automatically generate og tags for your page or post';
                    break;
                case 'plugin_options':
                    echo 'Check the options you\'d like to apply';
                    break;
            }
        }

        //add fields for three options
        public function setup_fields(){

            $fields = array(
                array(
                    'uid' => 'ws3_meta_og_check',
                    'label' => 'Add OG Tags',
                    'section' => 'plugin_options',
                    'type' => 'checkbox',
                    'placeholder' => '',
                    'supplemental' => '',
                    'helper' => '',
                    'default' => ''  
                ),
                array(
                    'uid' => 'ws3_meta_ga_check',
                    'label' => 'Add GA Tracking sNIPPET',
                    'section' => 'plugin_options',
                    'type' => 'checkbox',
                    'placeholder' => '',
                    'supplemental' => '',
                    'helper' => '',
                    'default' => ''
                ),
                array(
                    'uid' => 'ws3_meta_ga_id',
                    'label' => 'GA Tracking ID',
                    'section' => 'plugin_options',
                    'type' => 'text',
                    'placeholder' => 'UA-XXXXXXXXX-X',
                    'supplemental' => 'You can find this from admin page -> property -> tracking',
                    'helper' => '',
                    'default' => ''  
                )
            );
            //loop the above fields 
            foreach($fields as $field) {

                // field, label, callback function,  page-slug, section-sluf, args
                add_settings_field($field['uid'], $field['label'], array($this, 'field_callback'), 'ws3_meta_tags', $field['section'], $field);

                register_setting('ws3_meta_tags', $field['uid']);
            }

            
        }
            //callback field content
            public function field_callback($arguments){

                $value = get_option($arguments['uid']);
    
                if(! $value) {
                    $value = $arguments['default'];
                }
    
                switch($arguments['type']){
                    case 'text':
                        printf(
                            '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', 
                            $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value);
                        break;
                    case 'checkbox':
                        printf(
                            '<input name="%1$s" id="%1$s" type="%2$s" %3$s />', 
                            $arguments['uid'], $arguments['type'], checked($value, 'on', false) );
                        break;
                }
    
                //helper is build in element at fields
                if($helper = $arguments['helper']){
                    printf('<span class="helper" >%s</span>', $helper);
                }
    
                if($supplemental = $arguments['supplemental']){
                    printf('<p class="description" >%s</p>', $supplemental);
                }
    
            }
            
    }

    //INSTANTIATE THE CLASS
    new WS3_Meta_Tags;


 }

?>

