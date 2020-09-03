<?php

if (!defined('ABSPATH'))
  exit;

include_once(QLIGG_PLUGIN_DIR . 'includes/api/api.php');

class QLIGG_API_Personal extends QLIGG_API
{

  protected static $_instance;
  public $client_id = '504270170253170';
  public $graph_url = 'https://graph.instagram.com';
  public $redirect_uri = 'https://socialfeed.quadlayers.com/instagram.php';

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  function getAccessTokenLink()
  {

    $state = admin_url('admin.php');
    $scope = 'user_profile,user_media';

    return "https://www.instagram.com/oauth/authorize?app_id={$this->client_id}&redirect_uri={$this->redirect_uri}&response_type=code&scope={$scope}&state={$state}";
  }

  function getUserProfile($access_token)
  {

    $response = $this->remoteGet("{$this->graph_url}/me", array(
      'fields' => 'id,media_count,username,account_type',
      'access_token' => $access_token
    ));

    return (array) $response;
  }

  function getUserMedia($access_token, $after = null)
  {

    $limit = 50; //$num = min( $num, 200 );

    $response = $this->remoteGet("{$this->graph_url}/me/media", array(
      'after' => $after,
      'limit' => $limit,
      'fields' => 'media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}',
      'access_token' => $access_token
    ));

    return (array) $response;
  }
}
