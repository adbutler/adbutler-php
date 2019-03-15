<?php

namespace AdButler;

class API
{
    private static $config = array(
        'api_key'     => null,
        'indentation' => 2,
    );

    private static $baseURL = "https://api.adbutler.com";
    private static $version = "v1";

    /**
     * @var RouterInterface
     */
    private static $router;

    /**
     * @param array $config
     * @throws Error\UndefinedAPIKeyError
     */
    public static function init($config = array())
    {
        // Don't display errors twice
        ini_set('log_errors', 1);
        ini_set('display_errors', 0);

        if (array_key_exists('router', $config)) {
            self::$router = $config['router']['class'];
            $_router = self::$router;
            $_router::init($config['router']['config']);

        } else {
            // default to using cURL
            self::$router = CURLClient::getInstance();
            $curlConfig = [
                'api_key'  => isset($config['api_key']) ? $config['api_key'] : null,
                'base_url' => isset($config['base_url']) ? $config['base_url'] : self::$baseURL,
                'version' => isset($config['version']) ? $config['version'] : self::$version,
            ];
            CURLClient::init($curlConfig);
        }

        self::$config = array_merge(self::$config, $config);
    }

    public static function getRouter()
    {
        return self::$router;
    }

    public static function setRouter($router)
    {
        self::$router = $router;
    }

    public static function setKey($apiKey)
    {
        self::$config['api_key'] = $apiKey;
    }

    public static function getKey()
    {
        return self::$config['api_key'];
    }

    public static function setIndentation($indentation)
    {
        self::$config['indentation'] = $indentation;
    }

    public static function getIndentation()
    {
        return self::$config['indentation'];
    }
    
    public static function getBaseURL()
    {
        return self::$baseURL;
    }
    
    public static function getVersion()
    {
        return self::$version;
    }
}