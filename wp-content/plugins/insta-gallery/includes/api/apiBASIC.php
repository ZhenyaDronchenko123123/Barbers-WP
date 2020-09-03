<?php

if (!defined('ABSPATH'))
    exit;

class QLIGG_API_Basic
{

    protected static $_instance;
    protected $instagram;
    public $message;
    public $instagram_url = 'https://www.instagram.com';
    private $api_url = 'https://api.instagram.com';

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get_create_account_link()
    {

        $admin_url = admin_url('admin.php?page-qligg_token');
        $client_id = '6e628e63145746bcb684912009514665';

        return "{$this->instagram_url}/oauth/authorize/?client_id={$client_id}&scope=basic&redirect_uri=https://instagram.quadlayers.com/index.php?return_uri={$admin_url}&response_type=token&state={$admin_url}&hl=en";
    }

    // API generate code generation url
    // ---------------------------------------------------------------------------
    /* public function get_access_code($client_id = null) {

          $args = array(
          'client_id' => $client_id,
          'response_type' => 'code',
          'scope' => 'public_content',
          'redirect_uri' => urlencode(admin_url('admin.php?page=qligg_token&igigresponse=1'))
          );

          return add_query_arg($args, "{$this->api_url}/oauth/authorize/");
          } */

    // API call to get access token using authorization code
    // ---------------------------------------------------------------------------
    public function get_access_token($client_id, $client_secret, $redirect_uri, $code)
    {

        $args = array(
            'body' => array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'scope' => 'public_content'
            )
        );

        $response = $this->validate_response(wp_remote_post("{$this->api_url}/oauth/access_token", $args));

        if (isset($response['access_token'])) {
            return $response['access_token'];
        }

        return false;
    }

    // API call to get user profile information using access token
    // ---------------------------------------------------------------------------
    public function get_user_profile($access_token)
    {

        $args = array(
            'access_token' => $access_token
        );

        $url = "{$this->api_url}/v1/users/self";

        $response = $this->remote_get($url, $args);

        if (empty($response)) {
            return false;
        }

        if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
            $this->message = $response['meta']['error_message'];
            return false;
        }

        return isset($response['data']) ? $response['data'] : false;
    }

    // API call to check if access token is valid
    // ---------------------------------------------------------------------------
    public function validate_token($access_token)
    {

        $args = array(
            'access_token' => $access_token
        );

        $url = "{$this->api_url}/v1/users/self";

        $response = $this->remote_get($url, $args);

        if (isset($response['meta']['code']) && $response['meta']['code'] == 200) {
            return true;
        }

        if (isset($response['meta']['error_message'])) {
            $this->message = $response['meta']['error_message'];
        }

        return false;
    }

    // API call to get user feed using access token
    // ---------------------------------------------------------------------------

    function setup_user_item($data, $next_max_id = null)
    {

        static $load = false;
        static $i = 1;

        if (!$next_max_id) {
            $load = true;
        }

        $instagram_items = array();

        if (is_array($data) && !empty($data)) {

            foreach ($data as $item) {

                if ($load) {

                    preg_match_all('/(?<!\S)#([0-9a-zA-Z]+)/', @$item['caption']['text'], $hashtags);

                    $instagram_items[] = array(
                        'i' => $i,
                        'id' => str_replace("_{$item['user']['id']}", '', $item['id']),
                        'images' => array(
                            'standard' => @$item['images']['standard_resolution']['url'],
                            'medium' => @$item['images']['low_resolution']['url'],
                            'small' => @$item['images']['thumbnail']['url'],
                        ),
                        'videos' => array(
                            'standard' => @$item['videos']['standard_resolution']['url'],
                            'medium' => @$item['videos']['low_resolution']['url'],
                            'small' => @$item['videos']['thumbnail']['url'],
                        ),
                        'likes' => @$item['likes']['count'],
                        'comments' => @$item['comments']['count'],
                        'caption' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a href=\"{$this->instagram_url}/explore/tags/$1\">#$1</a>", htmlspecialchars(@$item['caption']['text'])),
                        'hashtags' => @$hashtags[1], // issue with uft 8 encode breakes json_encode
                        'link' => @$item['link'],
                        'type' => @$item['type'],
                        'user_id' => @$item['user']['id'],
                        'date' => date_i18n('j F, Y', @$item['created_time'])
                    );
                }
                if ($next_max_id && ($next_max_id == $i)) {
                    $i = $next_max_id;
                    $load = true;
                }
                $i++;
            }
        }

        return $instagram_items;
    }

    public function get_user_items($access_token, $max_id = null)
    {

        $args = array(
            'access_token' => $access_token,
            'max_id' => $max_id,
            'count' => 33
        );

        $url = "{$this->api_url}/v1/users/self/media/recent/";

        $response = $this->remote_get($url, $args);

        if (empty($response)) {
            return false;
        }

        if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
            $this->message = $response['meta']['error_message'];
            return false;
        }

        if (!isset($response['data'])) {
            return false;
        }

        return $response;
    }

    // Tag name and return items list array
    // -------------------------------------------------------------------------

    function setup_tag_item($data, $next_max_id = null)
    {

        static $load = false;
        static $i = 1;

        if (!$next_max_id) {
            $load = true;
        }

        $instagram_items = array();

        if (is_array($data) && !empty($data)) {

            foreach ($data as $res) {

                if (!isset($res['node']['display_url'])) {
                    continue;
                }

                //preg_match_all("/#(\\w+)/", @$res['node']['edge_media_to_caption']['edges'][0]['node']['text'], $hashtags);

                if ($load) {
                    $instagram_items[] = array(
                        'i' => $i,
                        'id' => $res['node']['id'],
                        'images' => array(
                            'standard' => $res['node']['display_url'],
                            'medium' => $res['node']['thumbnail_src'],
                            'small' => $res['node']['thumbnail_resources'][0]['src'],
                        ),
                        'likes' => $res['node']['edge_liked_by']['count'],
                        'comments' => $res['node']['edge_media_to_comment']['count'],
                        'caption' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a href=\"{$this->instagram_url}/explore/tags/$1\">#$1</a>", htmlspecialchars(@$res['node']['edge_media_to_caption']['edges'][0]['node']['text'])),
                        //'hashtags' => @$hashtags[1], // issue with uft 8 encode breakes json_encode
                        'link' => "{$this->instagram_url}/p/{$res['node']['shortcode']}/",
                        'type' => 'image', //@$types[$res['node']['__typename']],
                        'user_id' => $res['node']['owner']['id'],
                        'date' => date_i18n('j F, Y', strtotime($res['node']['taken_at_timestamp']))
                    );
                }
                if ($next_max_id && ($next_max_id == $i)) {
                    $i = $next_max_id;
                    $load = true;
                }
                $i++;
            }
        }

        return $instagram_items;
    }

    public function get_tag_items($tag = null, $max_id = null)
    {

        if ($tag) {

            $tag = urlencode((string) $tag);

            $args = array(
                '__a' => 1,
                'max_id' => "{$max_id}="
            );

            $response = $this->remote_get("{$this->instagram_url}/explore/tags/{$tag}/", $args);

            // API updated on Jan 03 17
            // ---------------------------------------------------------------------

            if (!isset($response['graphql']['hashtag']['edge_hashtag_to_media']['edges'])) {
                return false;
            }

            return $response;
        }

        $this->message = esc_html__('Please provide a valid #tag', 'insta-gallery');
    }

    function validate_response($json = null)
    {

        if (!($response = json_decode(wp_remote_retrieve_body($json), true)) || 200 !== wp_remote_retrieve_response_code($json)) {

            if (isset($response['meta']['error_message'])) {
                $this->message = $response['meta']['error_message'];
                return array(
                    'error' => 1,
                    'message' => $this->message
                );
            }

            if (isset($response['error_message'])) {
                $this->message = $response['error_message'];
                return array(
                    'error' => 1,
                    'message' => $this->message
                );
            }

            if (is_wp_error($json)) {
                $response = array(
                    'error' => 1,
                    'message' => $json->get_error_message()
                );
            } else {
                $response = array(
                    'error' => 1,
                    'message' => esc_html__('Unknow error occurred, please try again', 'insta-gallery')
                );
            }
        }

        return $response;
    }

    public function remote_get($url = null, $args = array())
    {

        $url = add_query_arg($args, trailingslashit($url));

        $response = $this->validate_response(wp_remote_get($url, array('timeout' => 29)));

        return $response;
    }

    // Return message
    // ---------------------------------------------------------------------------
    public function get_message()
    {
        return $this->message;
    }

    public function set_message($message = '')
    {
        $this->message = $message;
    }
}
