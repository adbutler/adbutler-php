<?php

namespace AdButler;

use \AdButler\Error\APIException;

/**
 * @property-read int id
 * @property-read string object
 * @property-read string self
 * @property-read string name
 * @property-read array tags
 */
class ZoneTag extends ReadOnlyResource
{
    protected static $type = 'zone_tag';
    protected static $zoneID = null;

    public static $setterFields = array();

    /**
     * @param int $id
     * @param null $queryQueryParams
     *
     * @return $this|ZoneTag
     * @throws APIException
     */
    public static function retrieve($id, $queryQueryParams = null)
    {
        if (!empty($queryQueryParams)) {
            // TODO: validate Query Parameters

            // stringify booleans
            foreach ($queryQueryParams as $key => $val) {
                if (is_bool($val)) {
                    $queryQueryParams[$key] = \AdButler\Utils\stringifyBool($val);
                }
            }
        }

        $queryParamsStringified = empty($queryQueryParams) ? '' : '?' . http_build_query($queryQueryParams); // join query params: 'key1=val1&key2=val2&key3=val3'
        $zoneTagsURLWithQueryParamsIfPresent = self::getResourceURL($id) . $queryParamsStringified;
        $data = self::getDecodedResponse('GET', $zoneTagsURLWithQueryParamsIfPresent, null, array());

        // inspect response if it has the correct type
        $isCorrectObjectType = key_exists('object', $data) && $data['object'] === self::$type;
        if (!$isCorrectObjectType) { // throw an error if it doesn't
            throw new APIException($data);
        }

        return is_null(self::$objectInstance) // check if the object is already instantiated or not
            ? new ZoneTag($data) // Not instantiated: static method call to instantiate an advertiser object with data
            : self::$objectInstance->setData($data); // Already instantiated: member method call to set data on the existing object and return it
    }

    /*
     * Overridden Methods
     */

    protected static function getResourceURL($resourceID = null)
    {
        return self::$baseURL . '/' . self::$version . "/zones/banner/$resourceID/tags";
    }

    /*
     * Resource specific methods
     */

//    /**
//     * Takes a query parameters associative array and an array of keys to URL encode.
//     * @param  array $params
//     * @param  array $keys
//     * @return array
//     */
//    private static function encodeFields( $params, $keys ) {
//        foreach($keys as $key)
//            $params[$key] = rawurlencode( $params[$key] );
//        return $params;
//    }

}
