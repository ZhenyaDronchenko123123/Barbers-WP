<?php

if (!defined('ABSPATH'))
    exit;

include_once(QLIGG_PLUGIN_DIR . 'includes/api/apiBusiness.php');

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Account.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/models/Feed.php');

abstract class QLIGG_API
{
    protected static $_instance;
    public $messages = array();

    function setupMediaItems($data, $last_id = null)
    {
        global $qliggAPI;

        return $qliggAPI->FEED->setupMediaItems($data, $last_id);
    }

    function validateResponse($json = null)
    {
        global $qliggAPI;

        if (!($response = json_decode(wp_remote_retrieve_body($json), true)) || 200 !== wp_remote_retrieve_response_code($json)) {

            if (is_wp_error($json)) {
                $response = array(
                    'error' => 1,
                    'message' => $json->get_error_message()
                );
            } elseif (isset($response['error']['message'])) {
                $response = array(
                    'error' => 1,
                    'message' => $response['error']['message']
                );
            } else {
                $response = array(
                    'error' => 1,
                    'message' => esc_html__('Unknow error occurred, please try again', 'insta-gallery')
                );
            }

            $qliggAPI->FEED->setMessage($response['message']);
        }
        
        return $response;
    }

    public function remoteGet($url = null, $args = array())
    {

        $url = add_query_arg($args, trailingslashit($url));

        $response = $this->validateResponse(wp_remote_get($url, array('timeout' => 29)));

        return $response;
    }
}
