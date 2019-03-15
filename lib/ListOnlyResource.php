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
     */
    protected static function retrieveAll($params = array())
    {

        // $bodyParams can be null if data is optional
        $class = get_called_class();
        /** @var ListOnlyResource $class */
        $uri = $class::getResourceURL();
        $data = self::getDecodedResponse('GET', $uri, null, $params);

        $asArray = array_key_exists('array', $params) ? $params['array'] : false;

        // inspect response for success or failure
        $isListObject = array_key_exists('object', $data) && $data['object'] === 'list';

        if ($isListObject) {
            return Collection::instantiate($data, $asArray); // success
        } else {
            self::throwRequestError($data);
        }
    }
}





