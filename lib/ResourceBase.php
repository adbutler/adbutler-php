<?php

namespace AdButler;

abstract class ResourceBase
{
    protected static $curlClient = null;

    protected static $type = null; // override in sub-class
    protected static $url = null; // override in sub-class
    protected static $apiKey = null; // set when instantiating

    protected static $objectInstance = null;
    protected static $collectionInstance = null;

    protected $data = array();
    protected $unsavedValues = array();

    protected static $objectToResourceMap = array(
        'advertiser'          => '\AdButler\Advertiser',
        //'list'              => '\AdButler\Banner',
        'banner_campaign'     => '\AdButler\BannerCampaign',
        'banner_zone'         => '\AdButler\BannerZone',
        'bidder'              => '\AdButler\Bidder',
        //'list'              => '\AdButler\Campaign',
        'campaign_assignment' => '\AdButler\CampaignAssignment',
        'channel'             => '\AdButler\Channel',
        //'list'              => '\AdButler\Creative',
        'custom_html_banner'  => '\AdButler\CustomHTMLBanner',
        'custom_html_popup'   => '\AdButler\CustomHTMLPopup',
        'email_zone'          => '\AdButler\EmailZone',
        'flash_banner'        => '\AdButler\FlashBanner',
        'flash_creative'      => '\AdButler\FlashCreative',
        'flash_popup'         => '\AdButler\FlashPopup',
        'geo_target'          => '\AdButler\GeoTarget',
        'image_banner'        => '\AdButler\ImageBanner',
        'image_creative'      => '\AdButler\ImageCreative',
        'image_popup'         => '\AdButler\ImagePopup',
        'isp_target'          => '\AdButler\ISPTarget',
        'manager'             => '\AdButler\Manager',
        'media_group'         => '\AdButler\MediaGroup',
        'placement'           => '\AdButler\Placement',
        'platform_target'     => '\AdButler\PlatformTarget',
        //'list'              => '\AdButler\Popup',
        'publisher'           => '\AdButler\Publisher',
        'rich_media_banner'   => '\AdButler\RichMediaBanner',
        'rich_media_creative' => '\AdButler\RichMediaCreative',
        's2s_banner'          => '\AdButler\S2SBanner',
        'schedule'            => '\AdButler\Schedule',
        'stats'               => '\AdButler\Stats',
        'text_ad'             => '\AdButler\TextAd',
        'text_campaign'       => '\AdButler\TextAdCampaign',
        'text_zone'           => '\AdButler\TextZone',
        'video_creative'      => '\AdButler\VideoCreative',
        //'list'              => '\AdButler\Zone',
        'zone_tag'            => '\AdButler\ZoneTag',
    );

    /**
     * @param array $opts
     *
     * @throws Error\UndefinedCURLClientError
     */
    public static function init($opts = array())
    {
        //
    }

    /**
     * Resource constructor.
     * @param array $data
     */
    public function __construct($data = array(), $opts = array())
    {
        if (!empty($opts) && key_exists('curl-client', $opts)) {
            self::$curlClient = $opts['curl-client'];
        }
        if (!empty($data)) {
            $this->data = $data;
        } // set data if given
        self::$objectInstance = $this; // cache reference to itself
        return $this; // return the instance
    }

    public function toArray()
    {
        return $this->data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    protected static function getResourceURL($id = null)
    {
        $router = API::getRouter();
        return '/' . $router::getVersion() . '/' . static::$url . ($id ? '/' . $id : '');
    }

    /**
     * @param       $method
     * @param       $url
     * @param null $bodyParams POST or PUT  data
     * @param array $queryParams like zoneID when filtering placement by zones
     * @return array|mixed
     * @throws Error\JSONDecodingError
     */
    protected static function getDecodedResponse($method, $url, $bodyParams = null, $queryParams = array())
    {
        // retrieve the router used (curl or custom) and use the request interface
        $router = API::getRouter();
        $response = $router::request($method, $url, $bodyParams, $queryParams);

        // decode response as associative array
        $result = json_decode($response, true);

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
    private static function throwJSONError($jsonLastError)
    {
        switch ($jsonLastError) {
            case JSON_ERROR_DEPTH:
                throw new Error\JSONDecodingError(['message' => 'The maximum stack depth has been exceeded.']);
            case JSON_ERROR_STATE_MISMATCH:
                throw new Error\JSONDecodingError(['message' => 'Invalid or malformed JSON.']);
            case JSON_ERROR_CTRL_CHAR:
                throw new Error\JSONDecodingError(['message' => 'Unexpected control character found.']);
            case JSON_ERROR_SYNTAX:
                throw new Error\JSONDecodingError(['message' => 'Syntax error.']);
        }

        // For PHP version 5.3.3 or greater 
        if (version_compare(PHP_VERSION, '5.3.3') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_UTF8:
                    throw new Error\JSONDecodingError(['message' => 'Malformed UTF-8 characters, possibly incorrectly encoded.']);
            }
        }

        // For PHP version 5.5.0 or greater 
        if (version_compare(PHP_VERSION, '5.5.0') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_RECURSION:
                    throw new Error\JSONDecodingError(['message' => 'One or more recursive references in the value to be encoded.']);
                case JSON_ERROR_INF_OR_NAN:
                    throw new Error\JSONDecodingError(['message' => 'One or more NAN or INF values in the value to be encoded.']);
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    throw new Error\JSONDecodingError(['message' => 'A value of a type that cannot be encoded was given.']);
            }
        }

        // For PHP version 7.0.0 or greater 
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            switch ($jsonLastError) {
                case JSON_ERROR_INVALID_PROPERTY_NAME:
                    throw new Error\JSONDecodingError(['message' => 'A property name that cannot be encoded was given.']);
                case JSON_ERROR_UTF16:
                    throw new Error\JSONDecodingError(['message' => 'Malformed UTF-16 characters, possibly incorrectly encoded.']);
            }
        }

        throw new Error\JSONDecodingError(['message' => 'Unknown error occurred while decoding the JSON response.']);
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
    protected static function throwRequestError($response)
    {
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
                throw new Error\InvalidRequestParametersError($response);

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
    public function __get($k)
    {
        if (!empty($this->data) && array_key_exists($k, $this->data)) {
            return $this->data[$k];
        } else {
            throw new Error\InvalidPropertyException(array(
                'object'  => 'error',
                'type'    => 'invalid_property_exception',
                'status'  => 400,
                'message' => "Invalid Property $k. This object only supports these properties: " . join(', ',
                        $this->data) . ".\n",
            ));
        }
    }

    /**
     * @param $k
     * @param $v
     */
    public function __set($k, $v)
    {
        if ($v === "") {
            throw new \InvalidArgumentException(
                'You cannot set \'' . $k . '\'to an empty string. '
                . 'We interpret empty strings as NULL in requests. '
                . 'You may set obj->' . $k . ' = NULL to delete the property'
            );
        }
        // Storing new values in a different array instead of changing `$this->data`
        $this->unsavedValues[$k] = $v;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return Utils\toJSON($this->data, 4, API::getIndentation());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . ' JSON: ' . $this->toJSON();
    }
}
