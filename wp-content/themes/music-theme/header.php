<?php
/**
 * The header  template
 * 
 * This is the header common to all pages.
 * 
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
      <?php 
        //blog name is site title
        if(is_front_page()){
          echo 'Welcome to ';
          bloginfo('name'); 
        }
        else{
          echo wp_title('|', true, 'right');
          bloginfo('name');
        }
      ?>
    </title>
    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Asap+Condensed:ital,wght@0,400;0,600;0,700;1,400&display=swap">
    <?php wp_head(); ?>

    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(). '/assets/images/logo.png'; ?>"> 
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand company-name" href="#">
                <img class="logo" src="<?php echo get_stylesheet_directory_uri(). '/assets/images/logo.png'; ?>" alt="" width="30" height="24" alt="logo">
                Cool Recording
                </p>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <!-- add dynamic nav and its css -->
              <?php
                wp_nav_menu(array(
                  'theme_location' => 'navbar-menu',
                  'container_id' => 'navbarSupportedContent',
                  'container_class' => 'collapse navbar-collapse nav-left',
                  'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                  'add_li_class' => 'nav-item',
                  'add_link_class' => 'nav-link'

                ));
              ?>
            </div>
          </nav>
    </header>