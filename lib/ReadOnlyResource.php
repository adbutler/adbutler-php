<?php

namespace AdButler;

abstract class ReadOnlyResource extends ResourceBase
{
    /**
     * @param int $id
     * @param null $queryParams
     *
     * @return ReadOnlyResource|ResourceBase
     * @throws \Exception
     */
    protected static function retrieve($id, $queryParams = null)
    {
        // $bodyParams can be null if data is optional
        /** @var ListOnlyResource $class */
        $class = get_called_class();
        $uri = $class::getResourceURL($id);
        $data = self::getDecodedResponse('POST', $uri, null, $queryParams);

        // inspect response if it has the correct type
        $isCorrectObjectType = key_exists('object', $data) && $data['object'] === $class::$type;
        if (!$isCorrectObjectType) { // throw an error if it doesn't
            throw new \Exception("Object Type Mismatch Error: Expected object of type \"{$class::$type}\" while received object of type \"{$data['object']}\".");
        }

        // check if the object is already instantiated or not and respond accordingly
        return is_null(self::$objectInstance)
            ? new $class($data) // static method call: instantiate an advertiser object with data
            : self::$objectInstance->setData($data); // member method call: set data on the existing object and return it
    }
}





