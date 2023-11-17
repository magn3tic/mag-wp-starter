<?php

// Changes & customizations made to 'Gutenberg' page editor views

// Control which blocks are available to add to a page
add_filter('allowed_block_types', 'mag_allowed_block_types');
function mag_allowed_block_types($allowed_block_types, $post) {
  return array(
    'core/paragraph',
    'core/image',
    'core/heading',
  );
}