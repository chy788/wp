<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
require_once 'depart.php';
get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			echo '<div class="entry-content">';
				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				//get_template_part( 'content', get_post_format() );
				?>
				<h3 class="entry-title"><a href="http://www.shoucaihuo.com/wp/wordpress/?p=<?php the_id();?>" rel="bookmark"><?php the_title();?></a></h3>
				<?php
				$content = get_the_content();
				$content = str_replace("\n","",$content);
				$content=preg_replace('/<img[^>]+>/i','',$content);
				$content=preg_replace('/<br[^>]+>/i','',$content);
				echo blog_summary(str_replace("\n","",$content), 150);
				?>
				<a href="http://www.shoucaihuo.com/wp/wordpress/?p=<?php the_id();?>" rel="bookmark" style="text-decoration:none;">...</a>
				<?php
				echo '<br>';
				echo '</div>';
				?>
			<hr width='100%' size='3' color='#00ffff'>
			<?php
			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>