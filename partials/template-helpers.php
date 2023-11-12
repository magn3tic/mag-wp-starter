<?php

// converts array to string of html attributes
function mag_element_attrs($array) {
  $attrs = '';
  foreach($array as $key=>$value) {
    if ($array[$key]) {
      $attrs .= $key . '="' . $value . '" ';
    }
  }
  return $attrs;
}

// get info for an image attachment by ID & optionally size
function mag_get_image_by_id($stringID, $imageSize = false) {
  if (!is_string($stringID)) {
    return false;
  }
  $id = intval($stringID);
  $crop = $imageSize ? $imageSize : 'full';
  $image = wp_get_attachment_image_src($id, $crop);
  $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
  return array(
    'src' => $image[0],
    'width' => $image[1],
    'height' => $image[2],
    'alt' => $alt
  );
}