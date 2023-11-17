<?php

// Home for everything svg - icons, logos, etc.

// commonly used icons
$mag_icons = array(
  'chevron_right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>',
);

// use icons in templates
function mag_get_icon($name) {
  global $mag_icons;
  return $sw_icons[$name];
}
function mag_do_icon($name) {
  echo gcGetIcon($name);
}

// svg logos here
function mag_brand_logo() {

}
