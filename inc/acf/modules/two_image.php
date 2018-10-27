<!-- Two Elements -->
<div class="row two-image">
  <?php $image = get_sub_field('image_1');
    if(strpos($image, '<img')) {
          $img = 'has-image';
    }
    $image2 = get_sub_field('image_2');
      if(strpos($image2, '<img')) {
            $img2 = 'has-image';
      }
   ?>
  <div class="col-sm-6 image-col <?php echo $img; ?>"><?php the_sub_field('image_1'); ?></div>
  <div class="col-sm-6 image-col <?php echo $img2; ?>"><?php the_sub_field('image_2'); ?></div>
</div>
