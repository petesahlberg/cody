<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cody
 */

get_header();

if(isset($_COOKIE['cat'])) {
	$bool = false;
} else {
	$bool = false;
}

//get_template_part('inc/bottom_fade'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>
			<div>
			<a title="Back to Work" class="index-link" href="/work">Back to Work</a>
			</div>
			<?php

			the_post_navigation(array(
				'in_same_term' => $bool,
				'taxonomy' => 'post_tag',
				'prev_text' => __( '<span>Next</span><img class="arrow" src="/wp-content/themes/cody/assets/img/cp-arrow.png"/>', 'cody' ),
    		'next_text' => __( '< Prev', 'cody' ),
			));

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //}
//get_sidebar();
get_footer();
