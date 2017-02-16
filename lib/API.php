<?php

namespace AdButler;

class API
{
    private static $config = array(
        'api_key'     => null,
        'curl_client' => null,
        'indentation' => 2,
    );

    public static function init( $config = array() ) {
        // Don't display errors twice
        ini_set('log_errors'    , 1);
        ini_set('display_errors', 0);

        if ( ! key_exists('curl_client', $config) ) {
            $config['curl_client'] = CURLClient::getInstance();
        }
        self::$config = array_merge(self::$config, $config);     // caching configuration options
        ListOnlyResource::init( $config );   // initializing Resource class
        SingleResource::init( $config ); // initializing Resource class
        CURLClient::init( $config );     // initializing CURLClient class
    }

    public static function getCURLClient() {
        return self::$config['curl_client'];
    }
    public static function setCURLClient( $curlClient ) {
        self::$config['curl_client'] = $curlClient;
    }

    public static function setKey( $apiKey ) {
        self::$config['api_key'] = $apiKey;
    }
    public static function getKey() {
        return self::$config['api_key'];
    }
    
    public static function setIndentation( $indentation ) {
        self::$config['indentation'] = $indentation;
    }
    public static function getIndentation() {
        return self::$config['indentation'];
    }
}