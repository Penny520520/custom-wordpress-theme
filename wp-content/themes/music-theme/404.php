<?php
/**
 * The 404 template
 * 
 * This is the 404 template for pages.
 * 
 * @link URL
 * 
 * @package WordPress
 * @subpackage music-record-studio
 * @since music-record-studio v1.0
 */
?>
<!-- will automatically work once load wrong link -->
<?php get_header(); ?>
<main>
    <section class="error">
        <div class="error-page">
            <h2>404 PAGE NOT FOUND</h2>
            <p>Sorry, we can't find that page! Don't worry though, everything is STILL AWESOME!</p>
            <a href="#" class="btn">Back home</a>
        </div>
    </section>        
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>