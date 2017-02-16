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
abstract class CreativeSingleResource extends SingleResource
{
    /*
     * Overridden Methods
     * ==================
     */

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
    public static function create($bodyParams = array(), $queryParams = array()) {
        $modifiedBodyParams = array();
        if (key_exists('file', $bodyParams)) {
            $modifiedBodyParams['file'] = class_exists('CURLFile')
                ? new \CURLFile($bodyParams['file']) // use CURLFile if defined
                : '@'.realpath($bodyParams['file']); // prepend '@' otherwise
            unset($bodyParams['file']);
        }
        $modifiedBodyParams['attributes'] = json_encode($bodyParams);
        return parent::create($modifiedBodyParams, $queryParams);
    }

    /**
     * @param array $bodyParams
     *
     * @return mixed
     */
    public function update($bodyParams = array()) {
        $modifiedBodyParams = array();

        if (key_exists('file', $bodyParams)) {
            $modifiedBodyParams['file'] = class_exists('CURLFile')
                ? new \CURLFile($bodyParams['file']) // use CURLFile if defined
                : '@'.realpath($bodyParams['file']); // prepend '@' otherwise
            unset($bodyParams['file']);
        }

        $modifiedBodyParams['attributes'] = json_encode($bodyParams);

        return parent::update($bodyParams);
    }

    /**
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
    public function save($queryParams = array()) {
        $modifiedBodyParams = array();

        if (key_exists('file', $this->unsavedValues)) {
            $modifiedBodyParams['file'] = class_exists('CURLFile')
                ? new \CURLFile($this->unsavedValues['file']) // use CURLFile if defined
                : '@'.realpath($this->unsavedValues['file']); // prepend '@' otherwise
            unset($this->unsavedValues['file']);
        }

        if (key_exists('name', $this->unsavedValues) || key_exists('group', $this->unsavedValues) || key_exists('description', $this->unsavedValues)) {
            $modifiedBodyParams['attributes'] = json_encode($this->unsavedValues);
        }

        $this->unsavedValues = $modifiedBodyParams;

        return parent::save($queryParams);
    }

    /*
     * Resource specific methods
     * =========================
     */
}











