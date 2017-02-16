<?php

namespace AdButler;

/**
 * @property-read  int    id
 * @property-read  string object
 * @property-read  string self
 * @property-read  string file_name
 * @property-read  int    file_size
 * @property-read  int    mime_code
 * @property-read  string upload_time
 * @property-read  int    width
 * @property-read  int    height
 * @property       string name
 * @property       int    group
 * @property       string description
 * @property-write string file
 */
class RichMediaCreative extends CreativeSingleResource
{
    protected static $type = 'rich_media_creative';
    protected static $url  = 'creatives/rich-media';

    /*
     * Overridden Methods
     * ==================
     */

    /**
     * @param array $bodyParams
     * @param array $queryParams
     *
     * @return RichMediaCreative
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
    public static function create($bodyParams = array(), $queryParams = array()) {
        return parent::create($bodyParams, $queryParams);
    }

    /**
     * @param int   $id
     * @param array $queryParams
     *
     * @return RichMediaCreative
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
    public static function retrieve($id, $queryParams = array()) {
        return parent::retrieve($id, $queryParams);
    }

    /**
     * @param array $bodyParams
     *
     * @return RichMediaCreative
     */
    public function update($bodyParams = array()) {
        return parent::update($bodyParams);
    }

    /**
     * @param array $queryParams
     *
     * @return RichMediaCreative
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
    public function save($queryParams = array()) {
        return parent::save($queryParams);
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
    public function delete($queryParams = array()) {
        return parent::delete($queryParams);
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
    public static function retrieveAll($queryParams = array()) {
        return parent::retrieveAll($queryParams);
    }

    /*
     * Resource specific methods
     * =========================
     */
}











