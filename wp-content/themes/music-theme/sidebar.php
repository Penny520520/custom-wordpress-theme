<?php
/**
 * The main sidebar template
 * 
 * This is the fallback template for siderbar.
 * 
 * @link URL
 * 
 * @package WordPress
 * @subpackage lab-theme
 * @since lab-theme v1.0
 */

?>

<!-- siderbar -->
    <section class="siderb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php if(is_active_sidebar('left-foot-sidebar')) :?>
                        <div>
                            <?php dynamic_sidebar('left-foot-sidebar'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php if(is_active_sidebar('right-foot-sidebar')) : ?>
                        <div>
                            <?php dynamic_sidebar('right-foot-sidebar'); ?>
                        </div>
                    <?php endif; ?>
                    <ul>
                        <li>
                            
                            <?php if(get_theme_mod('footer_fb_link', '') != ''): ?>
                                <a href="<?php echo get_theme_mod('footer_fb_link') ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/facebook-icon.png'; ?>" alt="Facebook Icon">
                                </a>
                            <?php endif; ?>

                        </li>
                        <li>
                            
                            <?php if(get_theme_mod('footer_ig_link', '') != ''): ?>
                                <a href="<?php echo get_theme_mod('footer_ig_link') ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/instagram-icon.png'; ?>" alt="instagram Icon">
                                </a>
                            <?php endif; ?>

                        </li>
                        <li>

                            <?php if(get_theme_mod('footer_pt_link', '') != ''): ?>
                                <a href="<?php echo get_theme_mod('footer_pt_link') ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/pinterest-icon.png'; ?>" alt="pinterest Icon">
                                </a>
                            <?php endif; ?>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>