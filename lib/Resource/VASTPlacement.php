<?php

namespace AdButler;

/**
 * @property-read 	int     id
 * @property-read 	string  object
 * @property-read 	string  self
 * @property 		int vast_zone_id
 * @property 		int vast_channel_id
 * @property 		int schedule_id
 * @property 		int campaign_id
 * @property 		int banner_id
 * @property 		bool active
 * @property 		decimal cpm
 * @property 		decimal cpc
 * @property 		decimal cpa
 * @property 		decimal fixed_cost
 * @property 		decimal payout_percent
 * @property 		bool use_channel_priority
 * @property 		string priority
 * @property 		int max_frequency
 * @property 		int max_frequency_period
 * @property 		string max_frequency_type
 */
class VASTPlacement extends SingleResource
{
    protected static $type = 'vast_placement';
    protected static $url  = 'vast-placements';

    /*
     * Overridden Methods
     * ==================
     */

    /**
     * @param array $bodyParams
     * @param array $queryParams
     *
     * @return VASTPlacement
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
     * @return VASTPlacement
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
     * @return VASTPlacement
     */
    public function update($bodyParams = array()) {
        return parent::update($bodyParams);
    }

    /**
     * @param array $queryParams
     *
     * @return VASTPlacement
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

