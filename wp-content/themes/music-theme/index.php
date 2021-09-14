<?php
/**
 * The main file template
 * 
 * This is the fallback template for the theme.
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
    <section class="bnr">
        <div class="container">
            <div class="row align-items-center">

                <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                    <!-- true part if there are posts and in the loop  -->
                    <div class="col-md ">
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