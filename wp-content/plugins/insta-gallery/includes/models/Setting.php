<?php

include_once 'QLIGG_Model.php';

class QLIGG_Setting extends QLIGG_Model {

  protected $table = 'insta_gallery_settings';

  function get_args() {
    return array(
        'insta_flush' => 0,
        'insta_reset' => 8,
        'insta_spinner_image_id' => 666666
    );
  }

  function get_defaults() {
    return $this->get_args();
  }

  function get_settings() {
    return $this->get_all();
  }

  function save($settings) {
    wp_parse_args($settings, $this->get_settings());
    return update_option($this->table, $settings);
  }

  function save_settings($settings_data = null) {
    return $this->save_all($settings_data);
  }

}
