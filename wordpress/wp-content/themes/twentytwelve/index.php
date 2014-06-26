<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 

$con = mysql_connect('localhost', 'root', '');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("SET NAMES 'utf8'");
mysql_query("use wordpresst;");
mysql_query("insert into wp_hits value('".$_SERVER['REMOTE_ADDR']."','".time()."');");
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		<?php  
$args=array(  
  'orderby' => 'name',  
  'order' => 'DESC'  
  );  
$categories=get_categories($args);  
  foreach($categories as $category) {
	  //var_dump($category);
    echo '<h1><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></h1>';  
	?>
	<hr width='100%' size='3' color='#00ffff'> 
			<?php query_posts('cat='.$category->term_id);
						while(have_posts()):the_post();  ?>
			<h3 class="entry-title"><a href="http://112.126.72.168/wp/wordpress/?p=<?php the_id();?>"><?php the_title();?></a>
			<?php
			if(get_the_id() == 27)
		{
			?>
			<img src='/hot.gif' >
			<?php
		}
			?>
			</h3>
			</br>
			
				<?php //get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<hr width='100%' size='3' color='#00ffff'>
	<?php
}  
?>  

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>