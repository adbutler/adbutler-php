<?php

namespace AdButler;

abstract class ListOnlyResource extends ResourceBase
{
    /**
     * C{R}UD - Reads resource by specified id and initializes it.
     * Implemented in the specific resource (eg. in an advertiser resource).
     *
     * @param  array $params
     *
     * @return Collection|array
     */
    protected static function retrieveAll($params = array()) {
        /** @var ListOnlyResource $class */
        $class = get_called_class();
        $asArray = array_key_exists('array', $params) ? $params['array'] : false;

        $data = self::getDecodedResponse('GET', $class::getResourceURL(), null, null, $params);

        // inspect response for success or failure
        $isListObject = array_key_exists('object', $data) && $data['object'] === 'list';

        if ($isListObject) {
            return Collection::instantiate( $data, $asArray ); // success
        } else {
            self::throwRequestError($data);
        }
    }
}





