<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cody
 */
//var_dump($_SESSION);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?><?php if(is_singular('project') ||is_page()) { if(get_field('page_background')) { ?> style='background-color:<?php the_field('page_background'); ?>'<?php } } ?>>
<?php if(is_front_page() || is_archive()) : ?>
	<span id="widthCalc" style="visibility:none;pointer-events:none;position:fixed;width:0;"><span class='width-inner'></span></span>
<span style="display:none" id="counter">0</span>
<?php endif; ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cody' ); ?></a>

	<header id="masthead" class="site-header <?php if(is_page('info')) : echo 'about'; endif; ?>">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php elseif (is_archive('project') && !is_tag()) : ?>
				<p class="site-title"><!--<a style="margin-right:-5px" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> -->Work<!--</a>--><?php if (is_tax()) {
						echo '&mdash;';
						$cat = get_queried_object();
						//echo '<a href="'.$cat->term_link.'">'.$cat->name.'</a>, <a class="view-all" href="/work">View All</a>';
						echo '<span>'.$cat->name.'</span>, <a class="view-all" href="/work">View All</a>';
					} ?>
				</p>
			<?php elseif(is_page('info') || is_singular('project')) : ?>
				<h1><?php echo get_the_title(); ?></h1>

			<?php elseif(is_tag()) : ?>
				<?php echo 'Tag&mdash;';single_tag_title(); ?>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'cody' ); ?></button>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">

			<div class="archive-bg"></div>

			<ul id="secondary-navigation">
				<?php wp_nav_menu( array(
 					'theme_location' => 'menu-1',
 				) );



				 ?>
			</ul>

			<?php
			 /*wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) ); */
			?>

			<div id="primary-menu">

				<?php
				// get background images for main nav
				$images = get_field('home_images', 2);

				if( $images ):
        foreach( $images as $image ): ?>

                <img class="home-image" style="display:none" src="<?php echo $image['url']; ?>"/>

				<?php endforeach; endif;
				// page content
					$my_id = 2;
					$post_id_5369 = get_post($my_id);
					$content = $post_id_5369->post_content;
					echo $content;
				?>
			</div>
			<?php if(is_front_page() || is_archive()) :
				// hacky way to get the percentage loader to count to 100
		//		echo '<div style="display:none">';
			//	for ($k = 0 ; $k < 40; $k++){ echo '<img style="display:none" data="Test" src='.get_stylesheet_directory_uri().'/assets/img/img-placeholder.jpg" class="home-image-load"/>'; }
			//	echo '</div>';
			endif; ?>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
