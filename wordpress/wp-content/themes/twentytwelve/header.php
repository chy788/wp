<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php //wp_title( '|', false, 'right' ); ?>收才伙--专注选秀比赛信息！</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<style type="text/css">
<!--
body {
 background-image: url(/1402642038408.jpg);
 background-attachment: fixed;
 background-size:cover; 
}
-->
</style>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><center><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></center></h1>
			<h2 class="site-description"><center><?php /*bloginfo( 'description' );*/ echo '收集有才艺的小伙伴！'; ?></center></h2>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
		<?php
$args=array(  
  'orderby' => 'name',  
  'order' => 'DESC'  
  );  
$categories=get_categories($args);
?>
<nav class='cat-list' style="margin:10px 0px 0px 0px;">
			<div><ul>
<?php
$length = count($categories);
$i = 0;
foreach($categories as $category) {
	  //var_dump($category);
	  echo '<li class="current_page_item" style="display:inline; margin: 0px 20px 10px 0px;"><a href="' . get_category_link( $category->term_id ) . '" style="text-decoration:none;color: #636363;">' . $category->name.'</a></li>';
	  if($i == $length-1)
		{
		  break;
		}
	  echo '<li class="current_page_item" style="display:inline; margin: 0px 20px 10px 0px;"><a>|</a></li>';
	  $i++;
}

?>
</ul>
<hr size='3' color='#00ffff'>
</div>
		</nav>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">