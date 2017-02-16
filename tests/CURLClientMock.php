<?php

namespace AdButler;

require_once(__DIR__ . '/../lib/CURLClient.php');

class CURLClientMock extends CURLClient
{
    public static $result = array();
    public static $curlError = false;
    
    public static $curlErrorNumber = CURLE_OK; // 0
    public static $curlErrorMessage = 'Network (CURL) error.';

    public static function request($method, $url, $id = null, $data = null, $params = array(), $opts = array()) {

        if ( $method === 'PUT' ) {
            return json_encode(array_merge( json_decode(self::$result, true), $data));
        }
        
        return parent::request($method, $url, $id, $data, $params, $opts);
    }

    /**
     * @param $url
     * @param $curlOptions
     *
     * @return array
     */
    public static function _makeRequest( $url, $curlOptions ) {
        return array(
            'error_number'  => self::$curlErrorNumber,
            'error_message' => self::$curlErrorMessage,
            'response'      => self::$curlError ? false : self::$result,
        );
    }

}