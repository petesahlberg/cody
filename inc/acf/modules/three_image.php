<!-- Three Elements -->
<?php
$omega = get_sub_field('tall_image_alignment');
if($omega === 'Right') :
  $align = 'right_align';
  $omega_1 = 'right';
  $omega_2 = 'none';
  $omega_3 = '';
  else :
    $align = 'left_align';
  $omega_1 = 'left';
  $omega_2 = 'right clear-right';
  $omega_3 = 'right';
endif;
?>
<div class="row three-image <?php echo $align; ?>">
<div class="col-sm-6 image-col <?php echo $omega_3; ?>">
<?php the_sub_field('image_1'); ?>
</div>
<div class="col-sm-6 image-col <?php echo $omega_1; ?>">
<?php the_sub_field('image_2'); ?>
</div>
<div class="col-sm-6 image-col <?php echo $omega_2; ?>">
<?php the_sub_field('image_3'); ?>
</div>
</div>
