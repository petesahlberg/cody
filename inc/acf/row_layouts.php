<section id="content-rows">
<?php
if( have_rows('content_rows') ):
while ( have_rows('content_rows') ) : the_row();
if(get_row_layout() == 'single_image'):
  get_template_part('inc/acf/modules/one_image');
elseif(get_row_layout() == 'two_image'):
  get_template_part('inc/acf/modules/two_image');
elseif(get_row_layout() == 'three_image'):
  get_template_part('inc/acf/modules/three_image');
elseif(get_row_layout() == 'wysiwyg'):
  get_template_part('inc/acf/modules/editor');
endif;
endwhile;
endif;
?>
</section>
