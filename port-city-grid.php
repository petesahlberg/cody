
<?php

if ( have_posts() ) : ?>

<section id="port-city-grid">

 <?php $i = 1;  while ( have_posts() ) : the_post(); ?>

<?php // for loop
 $type = get_post_mime_type($post->ID);
 if(strpos($type, 'jpeg')) {
	 $ext = '.jpg';
 } elseif(strpos($type, 'gif')) {
	 $ext = '.gif';
 } elseif(strpos($type, 'png')) {
	 	$ext = '.png';
 } elseif(strpos($type, 'tiff')) {
	 	$ext = '.tiff';
 } else {
	 $ext = '';
 }?>
	<!-- grid item -->
	<a data-title="<?php echo the_title(); ?>" index="<?php echo $i; ?>" href="<?php echo the_post_thumbnail_url('port-city'); ?>" class="port-image">
			<img data-image="<?php echo the_post_thumbnail_url('medium'); ?>"/>
	</a>
  <?php //get_template_part('grid-test');  // test bunch more images?>
	<!-- end grid item -->

<?php $i++; endwhile; ?>

</section>

<?php endif; ?>


<div id="lightbox">
  <a href="#" class="close">Close</a>
  <a href="#">Buy Print</a>
  <p class="title"></p>
  <div class='carousel notrans'>
  </div>
</div>

<div id="lightbox-details"></div>
