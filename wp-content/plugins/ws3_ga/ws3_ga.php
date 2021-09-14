<?php
/**
 * @package ws3_ga
 * @version 1.0.0
 */
/*
 Plugin Name: WS3 - GA Tag
 Description: This tag will add the ga code sippet to the head of every template
 Author: Penny Li
 Version: 1.0.0
 */
// Do they just look for php file then plugin shows up
function ws3_addGaTag(){

    //later we'll change this so we can set in the admin ui
    $ga_id = "UA-XXXXXXXXX-Y";

    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $ga_id ?>');
    </script>

    <?php



}
// 100 is priority, this should be happend after css conjunction
add_action('wp_head', 'ws3_addGaTag', 100)

?>

