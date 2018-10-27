<?php
add_action('post_content','blocks');
add_action('after_content','home_blocks');

function blocks() {
  if(is_singular('project') || is_page('about')) {
    include 'row_layouts.php';
  }
}

function home_blocks() {
  if(is_front_page()) {
    include 'row_layouts.php';
  }
}
?>
