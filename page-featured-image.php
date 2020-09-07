<?php
/**
 * Template Name: Featured Image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techgnosis-theme
 */

get_header();
?>
<?php 
$img = get_the_post_thumbnail_url();
$img = $img ? "background: url('".$img."') no-repeat;min-height: 230px;display: flex;align-items: center;color: #ffffff":"";
if( !empty($img)){
	?>
	<style>
		.entry-header .entry-title { margin-bottom: 0;}
	</style>
	<?php
}
?>
<header class="entry-header" style="<?php echo $img;?>">
	<div class="container">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div>
</header><!-- .entry-header -->
<div class="container">
	<div class="row">
		<main id="primary" class="site-main <?php echo is_active_sidebar( 'sidebar-1' ) ? 'eight':'ten'?> columns" style="margin-top: 16px">
		
			<?php
			while ( have_posts() ) :
				the_post();
		
				get_template_part( 'template-parts/content', 'featured' );
		
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
		
			endwhile; // End of the loop.
			?>
		
		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div>
</div>


<?php
get_footer();
