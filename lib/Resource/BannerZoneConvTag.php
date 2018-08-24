<?php

namespace AdButler;

/**
 * @property-read string object
 * @property-read string self
 * @property-read array data
 */
class BannerZoneConvTag extends ConvTag
{
    /*
     * Overridden Methods
     */
    
    protected static function getResourceURL( $resourceID = null ) {
        return static::$baseURL.'/'.static::$version."/zones/banner/$resourceID/conversion-tag";
    }

    /*
     * Resource specific methods
     */
    
}
