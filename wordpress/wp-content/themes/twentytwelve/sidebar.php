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

<form role="search" method="get" id="searchform" class="searchform" action="http://shoucaihuo.com/wp/wordpress/">
				<div>
					<label class="screen-reader-text" for="s">搜索：</label>
					<input type="text" value="" name="s" id="s">
					<input type="submit" id="searchsubmit" value="搜索">
				</div>
			</form>


						<aside id="recent-posts-2" class="widget widget_recent_entries">		<h3 class="widget-title">近期活动</h3>		<!--<ul>-->
						<?php  query_posts('limit 0,10 order by id');
						$flag = 0;
						while(have_posts()):the_post();
						?>
						<li>
						<a href="/wp/wordpress/?p=<?php the_id();?>"><?php the_title();?></a>
						</li>
						<?php
						if($flag==4)
						{
							break;
						}
						$flag++;
						endwhile;
						?>
				<!--</ul>-->
		</aside>

<aside id="recent-posts-2" class="widget widget_recent_entries">
<h3 class="widget-title">热门分类</h3>
<?php  
$args=array(  
  'orderby' => 'name',  
  'order' => 'ASC'  
  );  
$categories=get_categories($args);  
//get_category_link( $category->term_id )
  foreach($categories as $category) {  
    echo '<li><a href="http://shoucaihuo.com/wp/wordpress/?cat=' .$category->term_id. '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li>';  
}  
?>  
</aside>

<aside id="recent-posts-2" class="widget widget_recent_entries">
<h3 class="widget-title">网站介绍</h3>
<li><a href="http://shoucaihuo.com/wp/wordpress/?page_id=30'">老鹅要说</a></li>
</aside>
								</div>

<!--
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>-->
		<!-- #secondary -->
<!--	<?php endif; ?> -->