<?php

if (!defined('ABSPATH'))
    exit;

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Account.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/models/Feed.php');

class QLIGG_API_Feed
{
    protected static $_instance;
    public $messages = array();
    public $instagram_url = 'https://www.instagram.com';

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function setupMediaItems($data, $last_id = null)
    {

        static $load = false;
        static $i = 1;

        if (!$last_id) {
            $load = true;
        }

        $instagram_items = array();

        if (is_array($data) && !empty($data)) {

            foreach ($data as $item) {

                if ($load) {

                    preg_match_all('/(?<!\S)#([0-9a-zA-Z]+)/', @$item['caption'], $hashtags);

                    $media_url = ($item['media_type'] === 'CAROUSEL_ALBUM') ? @$item['children']['data'][0]['media_url'] : @$item['media_url'];
                    $date = isset($item['timestamp']) ? date_i18n('j F, Y', strtotime(trim(str_replace(array('T', '+', ' 0000'), ' ', $item['timestamp'])))) : false;

                    $test = $instagram_items[] = array(
                        'i' => $i,
                        'id' => $item['id'],
                        'type' => strtolower(str_replace('_ALBUM', '', $item['media_type'])),
                        'media' => $media_url,
                        'images' => array(
                            'standard' => "{$item['permalink']}media?size=l",
                            'medium' => "{$item['permalink']}media?size=m",
                            'small' => "{$item['permalink']}media?size=t",
                        ),
                        'videos' => array(
                            'standard' => "{$item['permalink']}media?size=l",
                            'medium' => "{$item['permalink']}media?size=m",
                            'small' => "{$item['permalink']}media?size=t",
                        ),
                        'likes' => isset($item['like_count']) ? $item['like_count'] : false,
                        'comments' => isset($item['comments_count']) ? $item['comments_count'] : false,
                        'caption' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a href=\"{$this->instagram_url}/explore/tags/$1\">#$1</a>", htmlspecialchars(@$item['caption'])),
                        'hashtags' => @$hashtags[1], //array_map('utf8_encode', (array) @$hashtags[1]), // issue with uft 8 encode breakes json_encode
                        'link' => $item['permalink'],
                        'date' => $date
                    );
                }

                if ($last_id && ($last_id == $i)) {
                    $i = $last_id;
                    $load = true;
                }
                $i++;
            }
        }

        return $instagram_items;
    }    

    // Return messages
    // ---------------------------------------------------------------------------
    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessage($message = '')
    {
        $this->messages[] = $message;
    }
}
