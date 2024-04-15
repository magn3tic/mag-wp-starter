<?php



// Buttons
function mag_button($text, $options) {
  $defaults = array(
    'id' => null,
    'anchor' => true,
    'size' => 'md',
    'variant' => 'default',
    'href' => '#0',
    'type' => 'button',
    'attrs' => array(),
  );
  $settings = wp_parse_args($options, $defaults);

  $label = $text ? $text : 'Learn More';
  $baseclass = 'gc-btn';
  $classname = $baseclass . ' ' . $baseclass . '--' . $settings['size'] . ' ' . $baseclass . '--' . $settings['variant'];
  if ($settings['doticon']) {
    $classname .= ' gc-btn--icon';
  }

  $attributes = '';
  $attributes .= 'class="' . $classname . '" ';
  if ($settings['id']) {
    $attributes .= 'id="' . $settings['id'] . '" ';
  }
  if ($settings['anchor']) {
    $href = $settings['href'] ? $settings['href'] : '#0';
    $attributes .= 'href="' . $href . '" ';
  }
  if (!$settings['anchor']) {
    $attributes .= 'type="' . $settings['type'] . '" ';
  }
  if (count($settings['attrs']) > 0) {
    $attributes .= mag_element_attrs($settings['attrs']);
  }

  $tag = $settings['anchor'] ? 'a' : 'button';
  
  echo '<' . $tag . ' ' . $attributes . '>';
  echo $label;
  echo '</' . $tag . '>';
}



// Headings
function mag_heading($text, $size = 'lg', $color = 'light', $tag = 'h2', $id = null) {
  $defaults = array(
    'size' => 'lg',
    'color' => 'light',
    'tag' => 'h3',
    'id' => null,
  )
  $baseclass = 'gc-heading';
  $classname = $baseclass . ' ' . $baseclass . '--' . $size . ' ' . $baseclass . '--' . $color;
  $attributes = '';
  $attributes .= 'class="' . $classname . '" ';
  if ($id) {
    $attributes .= 'id="' . $id . '" ';
  }
  echo '<' . $tag . ' ' . $attributes . '>' . $text . '</' . $tag . '>';
};