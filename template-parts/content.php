<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cody
 */

?>

<!-- POST TYPE PROJECT ARCHIVE CONTENT -->

<?php if(get_post_type() === 'project' && is_archive()) { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<input type="hidden" class="archive-bg-color" value="<?php global $post; echo get_field('archive_background_color', $post->ID); ?>"/>
	<div class="bg-image" style="background-image: url(
		<?php
		$post_id = get_the_ID();
		$img = get_the_post_thumbnail();
	 	$size = 'full';
		$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post_ID, $size) );
		$thumb = get_field('project_thumbnail', $post_id);
		$thumb2 = wp_get_attachment_image_src( $thumb, $size );
		$thumb_image = $thumb2[0];
		if($thumb && $imgurl || $thumb && !$imgurl) {
			echo $thumb_image;
			} elseif($imgurl && !$thumb) {
				echo $imgurl;
			}	else {
				//	echo get_stylesheet_directory_uri().'/assets/img/img-placeholder.jpg';
				} ?>);
		}>;visibility:hidden;
		position:absolute;"></div>
		<img style="visibility:hidden;height:0;" src="<?php if($thumb_image) : echo $thumb_image; elseif($imgurl) : echo $imgurl; endif; ?>"/>
	<header class="entry-header">
		<?php //cody_entry_footer(); ?>
		<?php
		global $post;
		$cat = get_the_terms($post->ID, 'type');
		if ( ! empty( $cat ) ) {
			//echo $cat;
		//if(!is_tax()) {
		  //echo '<a href="'.get_term_link($cat[0]->term_id).'">';
	  //} else {
		 echo '<a rel="bookmark" href="'.get_the_permalink().'">';
	 // }
		echo '<p>'.$cat[0]->name.'</p>';
		//echo '</a>';
	} else {
		echo '<p>Uncategorized</p>';
	}?>
	</header><!-- .entry-header -->
	<section>
			<a rel="bookmark" href="<?php the_permalink(); ?>">
		<?php
		the_title( '<h2 class="entry-title"></h2>' ); ?>
	</a>
	</section>
	<footer class="entry-footer">
		<a rel="bookmark" href="<?php the_permalink(); ?>">
		<?php
		if (get_field('start_date') || get_field('end_date')) :
			echo '<p>';
			echo the_field('start_date');
			echo '&dash;';
			echo the_field('end_date');
			echo '</p>';
			else : echo '<p>'.get_the_date('Y').'</p>';
		endif; ?>
	</a>
	</footer><!-- .entry-footer -->
	<div class="mobile-image">
		<?php echo the_post_thumbnail('cursor-image'); ?>
	</div>
</article><!-- #post-## -->


<?php } else { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			echo the_post_thumbnail('full');
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php cody_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<div class="content-container">
	<div class="entry-content">
		<?php
		//echo the_post_thumbnail();

			get_template_part('project_content');

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cody' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
			<a class="read-more" href="#"><span>Read More</span></a>
		</div>

		<?php do_action('post_content'); ?>

	<footer class="entry-footer">
		<?php cody_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php } ?>
