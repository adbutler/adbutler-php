<?php

namespace AdButler;

abstract class SingleResource extends ResourceBase  
{
    /**
     * @param array $bodyParams
     * @param array $queryParams
     *
     * @return mixed
     * @throws Error\APIConnectionError
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
     * @throws \Exception
     */
    protected static function create($bodyParams = array(), $queryParams = array()) {
        // $bodyParams can be null if data is optional
        /** @var ListOnlyResource $class */
        $class = get_called_class();
        $data = static::getDecodedResponse('POST', $class::getResourceURL(), null, $bodyParams);
        if (key_exists('object', $data) && $data['object'] === $class::$type) {
            return new $class( $data ); // success: always return a new advertiser object
        } else {
            self::throwRequestError($data);
        }
    }

    /**
     * @param int   $id
     * @param array $queryParams
     *
     * @return mixed
     * @throws Error\APIConnectionError
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
     * @throws \Exception
     */
    protected static function retrieve($id, $queryParams=array()) {
        // can $params be header parameters?
        $class = get_called_class(); /** @var ListOnlyResource $class */
        $data = self::getDecodedResponse('GET', $class::getResourceURL(), $id);

        // inspect response if it has the correct type
        $isCorrectObjectType = key_exists('object', $data) && $data['object'] === $class::$type;
        if (!$isCorrectObjectType) { // throw an error if it doesn't
            self::throwRequestError($data);
        }
        
        // check if the object is already instantiated or not and respond accordingly
        if ( empty(self::$objectInstance) ) {
            return new $class( $data ); // static method call: instantiate an advertiser object with data
        } else {
            return self::$objectInstance->setData( $data ); // member method call: set data on the existing object and return it
        }
    }

    /**
     * Update resource data by array without saving it.
     * Call `$this->save` to persist the changes to the remote server.
     *
     * @param array $bodyParams
     *
     * @return $this
     */
    protected function update($bodyParams = array()) {
        unset($bodyParams['id']); // always unset ID before updating data by array
        $this->data = array_merge($this->data, $bodyParams);
        return $this;
    }

    /**
     * Persist the contents of `$this->unsavedValues` to the remote server.
     *
     * @param array $queryParams
     *
     * @return mixed
     * @throws Error\APIConnectionError
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
     * @throws \Exception
     */
    protected function save($queryParams = array()) {
        $params = $this->unsavedValues;

        // if no values to save, just return
        if ( empty($this->unsavedValues) ) {
            return self::retrieve($this->data['id']); // syncing object with server
        }

        // edge case for creatives
        $isCreative = $this instanceof CreativeSingleResource;

        // caching the resource ID
        $id = $this->data['id'];

        // Necessary Guard: always unset the following fields
        unset($params['id']);
        unset($params['object']);
        unset($params['self']);

        // TODO: $params can never be null when updating

        $class = get_called_class(); /** @var ListOnlyResource $class */

        // use POST if it's a creative
        $response = self::getDecodedResponse( ($isCreative ? 'POST' : 'PUT'), $class::getResourceURL(), $id, $params);

        // inspect response for success or failure
        if ($response['object'] === $class::$type) {
            $this->unsavedValues = array(); // resetting the unsaved values array
            return $class::$objectInstance->setData( $response );
        } else { // failure
            self::throwRequestError($response);
        }
    }

    /**
     * @param array $queryParams
     *
     * @return bool
     * @throws Error\APIConnectionError
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
     * @throws \Exception
     */
    protected function delete($queryParams = array()) {
        /** @var ListOnlyResource $class */
        $class = get_called_class();
        
        $data = self::getDecodedResponse('DELETE', $class::getResourceURL(), $this->data['id']);
        
        // inspect response to see if success or error
        if( key_exists('deleted', $data) && $data['deleted'] ) {
            // cannot unset data; empty the data array
            $this->data = $data;
            return true;
        } else {
            self::throwRequestError($data);
        }
    }

    /**
     * @param array $queryParams
     *
     * @return Collection|array
     * @throws Error\APIConnectionError
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
     * @throws \Exception
     */
    protected static function retrieveAll($queryParams = array()) {
        /** @var ListOnlyResource $class */
        $class = get_called_class();
        $asArray = array_key_exists('array', $queryParams) ? $queryParams['array'] : false;

        $data = self::getDecodedResponse('GET', $class::getResourceURL(), null, null, $queryParams);

        // inspect response for success or failure
        $isListObject = array_key_exists('object', $data) && $data['object'] === 'list';

        if ($isListObject) {
            return Collection::instantiate( $data, $asArray ); // success
        } else {
            self::throwRequestError($data);
        }
    }

}





