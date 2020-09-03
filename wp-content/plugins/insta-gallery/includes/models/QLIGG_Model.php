<?php

class QLIGG_Model {

  private $cache = array();
  protected $table = null;

  function save_all($data = null) {

    if (!$this->table) {
      error_log('Model can\'t be accesed directly');
      die();
    }

    $this->cache[$this->table] = $data;

    return update_option($this->table, $data);
  }

  function get_all() {

    if (!$this->table) {
      error_log('Model can\'t be accesed directly');
      die();
    }

    if (!isset($this->cache[$this->table])) {
      $this->cache[$this->table] = get_option($this->table, $this->get_defaults());
    }

    return $this->cache[$this->table];
  }

}
