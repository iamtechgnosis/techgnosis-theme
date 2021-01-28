<?php
/**
 * Template Name: Full-width
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techgnosis-theme
 */

get_header();
?>
<main id="primary" class="site-main container-fluid px-0">
		
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'home' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
