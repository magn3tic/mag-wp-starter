<?php

/*
* Customizer Theme Options
* - global fields editable from appearnace > themes > customize theme
* - https://codex.wordpress.org/Theme_Customization_API
* - https://developer.wordpress.org/themes/customize-api/customizer-objects/
*/

add_action('customize_register', 'mag_customize_register');

function mag_customize_register() {
  mag_customize_register_logo();
}

function mag_customize_register_logo($wp_customize) {
   
  $wp_customize->add_setting('brand_logo');

  $wp_customize->add_control(mag_get_image_control(
    $wp_customize,
    'brand_logo',
    'Brand Logo',
    'title_tagline'
  ));
}


function mag_get_image_control($instance, $setting, $label, $section) {
  return new WP_Customize_Image_Control(
    $instance,
    $setting,
    array(
    'label' => $label,
    'section' => $section,
    'settings' => $setting,
    )
  );
}