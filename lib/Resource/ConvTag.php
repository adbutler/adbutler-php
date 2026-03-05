<?php

namespace AdButler;

use \AdButler\Error\APIException;

/**
 * @property-read int    id
 * @property-read string object
 * @property-read string self
 * @property-read string name
 * @property-read array  tags
 */
abstract class ConvTag extends ReadOnlyResource
{
    protected static $type = 'conv_tag';

    /*
     * Overridden Methods
     */

    /*
     * Resource specific methods
     */
    
}
