<?php
/**
 * The front-page template
 * 
 * This is the  template for front page.
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
                <div class="col-md ">
                    <h1>Sing Whatever<br>
                        You Love
                    </h1>
                    <a href="#" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                        Watch intro video
                    </a>
                    </div>
                    <div class="col-md-7 bg-center">
                    <div class="row">
                        <div class="col-md ">

                            <!-- if has featured image -->
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
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <section class="service">
        <h2>Our Service</h2>
        <div class="container">
        <div class="row">
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/record.jpg'; ?>">
            <div class="service-content">
                <h3>Recording and Mixing</h3>
                <a href="#" class="btn">Learn more</a>
            </div>
            </div>
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/arrange.jpg'; ?> ">
            <div class="service-content">
                <h3>Recording and Mixing</h3>
                <a href="#" class="btn">Learn more</a>
            </div>
            </div>
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/video.jpg'; ?> ">
            <div class="service-content">
                <h3>Recording and Mixing</h3>
                <a href="#" class="btn">Learn more</a>
            </div>
            </div>
        </div>
        </div>
    </section>
    <section class="gallery">
        <h2>Featured Images</h2>
        <div class="container">
        <div class="row">
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/image-1.jpg'; ?> ">
            </div>
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/arrange.jpg'; ?> ">
            </div>
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/video.jpg'; ?> ">
            </div>
            <div class="col-md">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/image-1.jpg'; ?> ">
            </div>
        </div>
        </div>
        <a href="#" class="btn">Load More</a>
    </section>        
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>