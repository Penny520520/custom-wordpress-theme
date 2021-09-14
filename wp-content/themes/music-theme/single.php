<?php
/**
 * The single blog template
 * 
 * This is the single blog template .
 * 
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */
?>

<?php get_header(); ?>
<main>
    <section class="blog">
        <div class="intro-bg bg-center">
          <h2><?php single_post_title(); ?></h2>
        </div>
    </section>
    <section class="blog-list">
        <div class="container">
            <div class="row align-items-center">

              <!-- loop posts -->
                <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                  
                    <div class="col-md-6 ">

                      <!-- see if there have featured image -->
                        <?php 
                            if(has_post_thumbnail()){
                                //show image
                                the_post_thumbnail('full', ['class' => 'img-banner']);
                            }
                            else{
                                //show default
                                echo '<img class="img-banner" src="'.get_stylesheet_directory_uri().'/assets/images/no-image.png">';
                            }
                        
                        ?>
                    </div>
                    <div class="col-md-12 ">
                        <h1><?php the_title(); ?></h1>
                        <h4>Posted on <?php the_time('F jS Y'); ?></h4>
                        <p><?php the_content(); ?></p>
                    </div>
                    
            
                <?php endwhile; else: ?>

                    <!-- false part, there are no posts -->
                    <p><?php _e('sorry, no posts matched your criteria.'); ?></p>

                <?php endif; ?>

                
            </div> 
        </div>
    </section>
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>