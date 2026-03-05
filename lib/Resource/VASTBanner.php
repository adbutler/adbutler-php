<?php

namespace AdButler;

/**
 * @property-read 	int     id
 * @property-read 	string  object
 * @property-read 	string  self
 * @property      	string  name
 * @property      	string  click_url
 * @property 		array ad_parameters
 * @property 		string encode_parameters
 * @property 		string companion_display
 * @property 		bool skippable
 * @property 		decimal skip_duration
 * @property 		decimal duration
 * @property 		bool use_wrapper
 * @property 		string wrapper_url
 */
class VASTBanner extends SingleResource
{
	protected static $type = 'vast_banner';
	protected static $url  = 'vast-banners';

	/*
	 * Overridden Methods
	 * ==================
	 */

	/**
	 * @param array $bodyParams
	 * @param array $queryParams
	 *
	 * @return VASTBanner
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
	 * @return VASTBanner
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
	 * @return VASTBanner
	 */
	public function update($bodyParams = array()) {
		return parent::update($bodyParams);
	}

	/**
	 * @param array $queryParams
	 *
	 * @return VASTBanner
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

