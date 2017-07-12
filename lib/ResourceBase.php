<?php

namespace AdButler;

abstract class ResourceBase
{
    protected static $curlClient = null;

    protected static $type    = null; // override in sub-class
    protected static $url     = null; // override in sub-class
    protected static $apiKey  = null; // set when instantiating
    protected static $version = "v1";
    protected static $baseURL = "https://api.adbutler.com";

    protected static $objectInstance     = null;
    protected static $collectionInstance = null;

    protected $data = array();
    protected $unsavedValues = array();

    /**
     * @param array $opts
     *
     * @throws Error\UndefinedCURLClientError
     */
    public static function init( $opts = array() ) {
        if ( key_exists('curl_client', $opts) ) {
            self::$curlClient = $opts['curl_client'];
        } else {
            throw new Error\UndefinedCURLClientError(array(
                'object'  => 'error',
                'type'    => 'undefined_curl_client_error',
                'message' => "Please specify a CURL Client for making HTTP requests.",
            ));
        }
    }

    /**
     * Resource constructor.
     * @param array $data
     */
    public function __construct( $data = array(), $opts = array() ) {
        if (!empty($opts) && key_exists('curl-client', $opts)) {
            self::$curlClient = $opts['curl-client'];
        }
        if (!empty($data))
            $this->data = $data; // set data if given
        self::$objectInstance = $this; // cache reference to itself
        return $this; // return the instance
    }

    public function toArray() {
        return $this->data;
    }

    public function getData() {
        return $this->data;
    }

    public function setData( $data ) {
        $this->data = $data;
        return $this;
    }

    protected static function getResourceURL() {
        return self::$baseURL.'/'.self::$version.'/'.static::$url;
    }

    /**
     * @param       $method
     * @param       $url
     * @param null  $id
     * @param null  $bodyParams   POST or PUT  data
     * @param array $queryParams like zoneID when filtering placement by zones
     * @param array $opts   anything that modifies the output response like limit, fields etc.
     *
     * @return array|mixed
     * @throws Error\JSONDecodingError
     * @throws Error\APIConnectionError
     * @throws Error\UndefinedRequestParametersError
     */
    protected static function getDecodedResponse($method, $url, $id = null, $bodyParams = null, $queryParams = array(), $opts = array() ) {
        // make request to url and don't validate data on the client side
        $curlClient = self::$curlClient; /** @var CURLClient $curlClient */
        $response = $curlClient::request($method, $url, $id, $bodyParams, $queryParams, $opts);

        // decode response as associative array
        $result = json_decode( $response, true );

        // decode response as associative array
        if (json_last_error() !== JSON_ERROR_NONE) {
            self::throwJSONError(json_last_error());
        }

        return is_array($result) ? $result : array();
    }

    /**
     * @param $jsonLastError
     *
     * @throws Error\JSONDecodingError
     */
    private static function throwJSONError($jsonLastError) {
        switch ($jsonLastError) {
            case JSON_ERROR_DEPTH:
                throw new Error\JSONDecodingError('The maximum stack depth has been exceeded.');
            case JSON_ERROR_STATE_MISMATCH:
                throw new Error\JSONDecodingError('Invalid or malformed JSON.');
            case JSON_ERROR_CTRL_CHAR:
                throw new Error\JSONDecodingError('Unexpected control character found.');
            case JSON_ERROR_SYNTAX:
                throw new Error\JSONDecodingError('Syntax error.');
        }

        // For PHP version 5.3.3 or greater 
        if (version_compare(PHP_VERSION, '5.3.3') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_UTF8:
                    throw new Error\JSONDecodingError('Malformed UTF-8 characters, possibly incorrectly encoded.');
            }
        }

        // For PHP version 5.5.0 or greater 
        if (version_compare(PHP_VERSION, '5.5.0') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_RECURSION:
                    throw new Error\JSONDecodingError('One or more recursive references in the value to be encoded.');
                case JSON_ERROR_INF_OR_NAN:
                    throw new Error\JSONDecodingError('One or more NAN or INF values in the value to be encoded.');
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    throw new Error\JSONDecodingError('A value of a type that cannot be encoded was given.');
            }
        }

        // For PHP version 7.0.0 or greater 
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_INVALID_PROPERTY_NAME:
                    throw new Error\JSONDecodingError('A property name that cannot be encoded was given.');
                case JSON_ERROR_UTF16:
                    throw new Error\JSONDecodingError('Malformed UTF-16 characters, possibly incorrectly encoded.');
            }
        }

        throw new Error\JSONDecodingError('Unknown error occurred while decoding the JSON response.');
    }

    /**
     * @param $response
     *
     * @throws Error\APIError
     * @throws Error\InvalidAPIKeyError
     * @throws Error\InvalidAccountError
     * @throws Error\InvalidRequestError
     * @throws Error\InvalidRequestParametersError
     * @throws Error\InvalidResourceError
     * @throws Error\JSONDecodingError
     * @throws Error\JSONEncodingError
     * @throws Error\MethodNotSupportedError
     * @throws Error\MissingResponseError
     * @throws Error\ResourceCreateError
     * @throws Error\ResourceNotFoundError
     * @throws Error\UndefinedAPIKeyError
     * @throws Error\UndefinedRequestParametersError
     * @throws Error\UndefinedResponseError
     * @throws \Exception
     */
    protected static function throwRequestError($response) {
        if (!is_array($response)) {
            throw new \Exception('Unknown error occurred.');
        }

        $type = key_exists('type', $response) ? $response['type'] : '';

        switch ($type) {
            case 'invalid_request_error':
                throw new Error\InvalidRequestError($response);

            case 'invalid_account_error':
                throw new Error\InvalidAccountError($response);

            case 'invalid_api_key_error':
                throw new Error\InvalidAPIKeyError($response);

            case 'undefined_api_key_error':
                throw new Error\UndefinedAPIKeyError($response);

            case 'api_error':
                throw new Error\APIError($response);

            case 'resource_create_error':
                throw new Error\ResourceCreateError($response);

            case 'resource_not_found_error':
                throw new Error\ResourceNotFoundError($response);

            case 'invalid_resource_error':
                throw new Error\InvalidResourceError($response);

            case 'undefined_response_error':
                throw new Error\UndefinedResponseError($response);

            case 'undefined_request_parameters_error':
                throw new Error\UndefinedRequestParametersError($response);

            case 'invalid_request_parameters_error':
                throw new Error\InvalidRequestParametersError( $response );

            case 'json_decoding_error':
                throw new Error\JSONDecodingError($response);

            case 'json_encoding_error':
                throw new Error\JSONEncodingError($response);

            case 'missing_response_error':
                throw new Error\MissingResponseError($response);

            case 'method_not_supported_error':
                throw new Error\MethodNotSupportedError($response);

            default:
                throw new \Exception('Unknown error occurred.');
        }
    }

    /**
     * @param $k
     *
     * @return mixed
     * @throws Error\InvalidPropertyException
     */
    public function __get($k) {
        if (!empty($this->data) && array_key_exists($k, $this->data)) {
            return $this->data[$k];
        } else {
            throw new Error\InvalidPropertyException(array(
                'object'  => 'error',
                'type'    => 'invalid_property_exception',
                'status'  => 400,
                'message' => "Invalid Property $k. This object only supports these properties: " . join(', ', $this->data) . ".\n",
            ));
        }
    }

    /**
     * @param $k
     * @param $v
     */
    public function __set($k, $v) {
        if ($v === "") {
            throw new \InvalidArgumentException(
                'You cannot set \''.$k.'\'to an empty string. '
                .'We interpret empty strings as NULL in requests. '
                .'You may set obj->'.$k.' = NULL to delete the property'
            );
        }
        // Storing new values in a different array instead of changing `$this->data`
        $this->unsavedValues[$k] = $v;
    }

    /**
     * @return string
     */
    public function toJSON() {
        return Utils\toJSON( $this->data, 4, API::getIndentation() );
    }

    /**
     * @return string
     */
    public function __toString() {
        return get_class($this) . ' JSON: ' . $this->toJSON();
    }
}
