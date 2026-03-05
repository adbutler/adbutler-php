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
class ManualTrackingLinks extends ReadOnlyResource
{
    protected static $type = 'manual_tracking_links';

    public static $setterFields = array();

    public static function retrieve($id, $queryQueryParams = null ) {
        if (!empty($queryQueryParams)) {
            // TODO: validate Query Parameters
        }

        $queryParamsStringified = empty($queryQueryParams) ? '' : '?'.http_build_query($queryQueryParams); // join query params: 'key1=val1&key2=val2&key3=val3'
        $trackingLinksWithQueryParamsIfPresent = self::getResourceURL($id) . $queryParamsStringified;
        $data = self::getDecodedResponse('GET', $trackingLinksWithQueryParamsIfPresent, null, array());

        // inspect response if it has the correct type
        $isCorrectObjectType = key_exists('object', $data) && $data['object'] === self::$type;
        if (!$isCorrectObjectType) { // throw an error if it doesn't
            throw new APIException($data);
        }

        return is_null( self::$objectInstance ) // check if the object is already instantiated or not
            ? new ManualTrackingLinks($data) // Not instantiated: static method call to instantiate an advertiser object with data
            : self::$objectInstance->setData( $data ); // Already instantiated: member method call to set data on the existing object and return it
    }

    /*
     * Overridden Methods
     */

    protected static function getResourceURL( $resourceID = null ) {
        return self::$baseURL.'/'.self::$version."/zones/banner/$resourceID/tags";
    }

}