<?php

namespace AdButler;

/**
 * @property-read 	int     id
 * @property-read 	string  object
 * @property-read 	string  self
 * @property 		int quota_lifetime
 * @property 		string quota_type
 * @property 		datetime start_date
 * @property 		datetime end_date
 * @property		int weight
 * @property 		decimal track
 * @property 		bool active
 * @property 		datetime day_cap_date
 * @property 		int day_cap_clicks_limit
 * @property		int day_cap_views_limit
 * @property 		int max_frequency
 * @property 		string day_cap_type
 * @property 		int max_frequency_period
 * @property 		int target_id",
 */
class VASTSchedule extends SingleResource
{
	protected static $type = 'vast_schedule';
	protected static $url  = 'vast-schedules';

	/*
	 * Overridden Methods
	 * ==================
	 */

	/**
	 * @param array $bodyParams
	 * @param array $queryParams
	 *
	 * @return VASTSchedule
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
	 * @return VASTSchedule
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
	 * @return VASTSchedule
	 */
	public function update($bodyParams = array()) {
		return parent::update($bodyParams);
	}

	/**
	 * @param array $queryParams
	 *
	 * @return VASTSchedule
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

