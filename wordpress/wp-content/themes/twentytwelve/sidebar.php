<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div id="secondary" class="widget-area" role="complementary">

<form role="search" method="get" id="searchform" class="searchform" action="http://wp.com/">
				<div>
					<label class="screen-reader-text" for="s">搜索：</label>
					<input type="text" value="" name="s" id="s">
					<input type="submit" id="searchsubmit" value="搜索">
				</div>
			</form>


						<aside id="recent-posts-2" class="widget widget_recent_entries">		<h3 class="widget-title">近期文章</h3>		<ul>
						<?php  query_posts('limit 0,10 order by id');
						while(have_posts()):the_post();
						?>
						<li>
						<a href="/?p=<?php the_id();?>"><?php the_title();?></a>
						</li>
						<?php
						endwhile;
						?>
				</ul>
		</aside>
								</div>

<!--
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>-->
		<!-- #secondary -->
<!--	<?php endif; ?> -->