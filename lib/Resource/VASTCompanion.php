<?php

namespace AdButler;

/**
 * @property-read 	int     id
 * @property-read 	string  object
 * @property-read 	string  self
 * @property 		int banner_id
 * @property  		string resource_type
 * @property 		string type
 * @property 		int width
 * @property 		int height
 * @property 		int asset_width
 * @property 		int asset_height
 * @property 		bool scalable
 * @property 		int expanded_width
 * @property 		int expanded_height
 * @property 		string api_framework
 * @property 		string content
 * @property 		string altText
 * @property 		string dom_element_id
 * @property 		int sequence
 * @property 		int library_id
 * @property 		string click_through_url
 * @property 		encode_parameters
 * @property 		ad_parameters
 */
class VASTCompanion extends SingleResource
{
	protected static $type = 'vast_companion';
	protected static $url  = 'vast-companions';

	/*
	 * Overridden Methods
	 * ==================
	 */

	/**
	 * @param array $bodyParams
	 * @param array $queryParams
	 *
	 * @return VASTCompanion
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
	 * @return VASTCompanion
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
	 * @return VASTCompanion
	 */
	public function update($bodyParams = array()) {
		return parent::update($bodyParams);
	}

	/**
	 * @param array $queryParams
	 *
	 * @return VASTCompanion
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

