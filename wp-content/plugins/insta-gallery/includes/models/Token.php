<?php

include_once 'QLIGG_Model.php';

class QLIGG_Token extends QLIGG_Model {

  protected $table = 'insta_gallery_token';

  function get_args() {
    return array();
  }

  function get_defaults() {
    return array(
        '3617511663' => '3617511663.6e628e6.07625a349d1742a0815aca2f0654d4a4'
    );
  }

  function get_tokens() {
    return $this->get_all();
  }

  function add_token($token = null, $id = null) {
    $tokens = $this->get_tokens();
    // Fix compatibility between PHP 7.0 and 5.2
    if (is_array($tokens) && count($tokens) && class_exists('QLIGG_PRO')) {
      $tokens += $token;
    } else {
      $tokens = $token;
    }
    $this->save_token($tokens);
  }

  function delete_token($token_id) {
    $tokens = $this->get_tokens();
    unset($tokens[$token_id]);
    $this->save_token($tokens);
  }

  function save_token($tokens) {
    $this->save_all($tokens);
    delete_transient('insta_gallery_user_profile');
  }

}
