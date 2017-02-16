<?php

namespace AdButler;

/**
 * @property-read  int     id
 * @property-read  string  object
 * @property-read  string  self
 * @property       string  name
 * @property       string  email
 * @property-write string  password
 * @property-read  string  has_password
 * @property       boolean can_add_banners
 * @property       boolean can_change_password
 */
class Advertiser extends SingleResource
{
    protected static $type = 'advertiser';
    protected static $url  = 'advertisers';

    /*
     * Overridden Methods
     * ==================
     */

    /**
     * @param array $bodyParams
     * @param array $queryParams
     *
     * @return Advertiser
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
     * @return Advertiser
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
     * @return Advertiser
     */
    public function update($bodyParams = array()) {
        return parent::update($bodyParams);
    }

    /**
     * @param array $queryParams
     *
     * @return Advertiser
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
        unset($this->unsavedValues['has_password']);
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

    public function addCampaign($params = null) {
        // adds a new campaign for this advertiser
        // returns \AdButler\Campaign object
    }

    public function campaigns($params = null) {
        // returns all the campaigns of the advertiser
        // returns array of \AdButler\Collection of \AdButler\Campaign objects
    }
}





