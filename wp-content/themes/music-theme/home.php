<?php
/**
 * The home file template
 * 
 * This is the template for blog page.
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
            <!-- true part if there are posts and in the loop  -->
            <div class="row">

        <!-- loop the posts -->
        <?php if(have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="col-md-<?php echo get_theme_mod('home_grid_size', 6); ?> postDistance">
                    <!-- check if there have feature image attached -->
                    <?php 
                        if(has_post_thumbnail()){
                            //show image

                            $thumb_size = (get_theme_mod('home_grid_size', 6) == 12) ? 'full' : 'medium-large';
                            the_post_thumbnail($thumb_size, ['class' => 'img-banner']);
                        }
                        else{
                            //show default
                            echo '<img class="img-banner" src="'.get_stylesheet_directory_uri().'/assets/images/no-image.png">';
                        }
                    
                    ?>

                    <h1><?php the_title(); ?></h1>

                    <?php if(get_theme_mod('show_post_date', true)) : ?>
                    <h4>Posted on <?php the_time('F jS Y'); ?></h4>
                    <?php endif; ?>
                    
                    
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php echo get_permalink(); ?>" class="btn btn-primary">Learn more</a>

                </div>

        <?php endwhile; else: ?>

            <!-- false part, there are no posts -->
            <p><?php _e('sorry, no posts matched your criteria.'); ?></p>

        <?php endif; ?>
        
        </div>

    </section>
      <?php get_sidebar(); ?>
    </main>
<?php get_footer(); ?>