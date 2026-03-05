<?php

namespace AdButler;

/**
 * @property-read string object
 * @property-read string self
 * @property-read array data
 */
class BannerConvTag extends ConvTag
{
    /*
     * Overridden Methods
     */
    
    protected static function getResourceURL( $resourceID = null ) {
        return static::$baseURL.'/'.static::$version."/banners/$resourceID/conversion-tag";
    }

    /*
     * Resource specific methods
     */
    
}
