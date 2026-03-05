<?php

namespace AdButler;

/**
 * @property-read string object
 * @property-read string self
 * @property-read array data
 */
class ImageBannerConvTag extends ConvTag
{
    /*
     * Overridden Methods
     */
    
    protected static function getResourceURL( $resourceID = null ) {
        return static::$baseURL.'/'.static::$version."/banners/image/$resourceID/conversion-tag";
    }

    /*
     * Resource specific methods
     */
    
}
