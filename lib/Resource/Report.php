<?php

namespace AdButler;

use AdButler\Error\APIException;

/**
 * @property-read string object
 * @property-read string url
 * @property-read string data
 * @property-read int meta
 */
class Report extends ReadOnlyResource
{
    protected static $type = 'report';
    protected static $url = 'reports';

    /*
     * Overridden Methods
     */

    public static function retrieve($queryParams = null, $id = null)
    {
        if (!empty($queryParams)) {
            // TODO: validate Query Parameters
        } else {
            // TODO: throw error: no query params in the url
        }

        foreach ($queryParams as $param => $value) {
            // stringifying booleans because http_build_query converts false to 0 and true to 1
            $queryParams[$param] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }
        $queryParamsStringified = empty($queryParams) ? '' : '?' . http_build_query($queryParams); // join query params: 'key1=val1&key2=val2&key3=val3'
        $statsURLWithQueryParams = self::getResourceURL() . $queryParamsStringified;
        $data = self::getDecodedResponse('GET', $statsURLWithQueryParams, null, array());

        // inspect response if it has the correct type
        $isCorrectObjectType = key_exists('object', $data) && $data['object'] === self::$type;
        if (!$isCorrectObjectType) { // throw an error if it doesn't
            throw new APIException($data);
        }

        return is_null(self::$objectInstance) // check if the object is already instantiated or not
            ? new Report($data) // Not instantiated: static method call to instantiate an advertiser object with data
            : self::$objectInstance->setData($data); // Already instantiated: member method call to set data on the existing object and return it
    }

    /*
     * Resource specific methods
     */

}
