<?php
/**
 * The page template
 * 
 * This is the  template for about page.
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
      <section class="intro">
        <div class="intro-bg bg-center">
          <h2><?php the_title(); ?></h2>
        </div>
        <p><?php the_content(); ?></p>
      </section>
      <section class="team">
        <h2>Team</h2>
        <div class="container">
          <div class="row">
            <div class="col-md">
              <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/jeffrey.jpg'; ?> " alt="Jeffrey image">
              <div class="service-content">
                <h3>Jerry Keenan</h3>
                <p>Recording Engineer</p>
                <a href="#" class="btn">Learn more</a>
              </div>
            </div>
            <div class="col-md">
              <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/pp.jpg'; ?> " alt="Penny image">
              <div class="service-content">
                <h3>Kely Pyankov</h3>
                <p>Video Editor</p>
                <a href="#" class="btn">Learn more</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php get_sidebar(); ?>
    </main>
<?php get_footer(); ?>