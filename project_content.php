<?php

global $post;
// modify content to have a before and after for "Read more"
$content = get_the_content();

//echo $content;

if(strpos($content, '<span id="more') != false) :

$before = explode('<span id="more', $content)[0];

$after = strstr($content, '<span id="more-'.$post->ID.'"></span>');

$before = apply_filters('the_content', $before);

$after = apply_filters('the_content', $after);

$before = '<div class="content-first">'.$before.'</div>';

$after = '<div class="content-more">'.$after.'</div>';

echo $before;
echo $after;

else :

the_content();

echo '<style> .read-more { display:none; } .entry-content { margin-bottom:.5em !important; } </style>';

endif;

//the_content(); ?>
