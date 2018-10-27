<table>

<?php

 while(the_flexible_field("about_section")): ?>

	<?php if(get_row_layout() == "title_content"): ?>

  <tr>
    <td><?php echo the_sub_field('title'); ?></td>
    <td><?php echo the_sub_field('content');  ?></td>
  </tr>

	<?php elseif(get_row_layout() == "title_date_content"): ?>

    <td><?php echo the_sub_field('title2'); ?></td>

      <?php $events = get_sub_field('event');

      foreach ($events as $e) :
          $i == '';

          echo '<td class="date">';
          echo $e['date'];
          echo '</td> <td class="inner-content">';
          echo $e['inner_content'];
          echo '</td><tr class="empty '.$i.'"><td></td>';

          $i = 'hide';

        endforeach; ?>

  </tr>

<?php elseif(get_row_layout() == "about_image"): ?>

</table>
<table>

<?php if(get_sub_field('dir') == 'right') :

  $float = 'right';
  else :
  $float = 'left';
  endif; ?>

    <img class="about-image" style="margin:0;float:<?php echo $float; ?>" src="<?php the_sub_field('image'); ?>"/>


</table>
<table>

	<?php endif; ?>

<?php endwhile; ?>

</table>
