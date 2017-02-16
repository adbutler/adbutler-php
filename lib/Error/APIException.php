<?php

namespace AdButler\Error;

/**
 * Class APIException
 * @package AdButler\Error
 * 
 * @property  string  message
 * @property  string  code
 * @property  string  file
 * @property  int     line
 */
class APIException extends \Exception
{
    public $object     = 'error';
    public $type       = '';
    public $status     = null;
    public $message    = '';
    public $parameters = array();

    /**
     * APIException constructor.
     *
     * $data              array  Defines the following fields to be shown by scaffolding. 
     *     ['type']       string The type of the error e.g. 'api_error', 'invalid_property_error' etc.
     *     ['status']     int    The HTTP status value e.g. 200, 400, 404 etc.
     *     ['message']    string The description of the error or possible solutions to it.
     *     ['parameters'] array  List of $parameter (see description below). This may or maynot be present.
     * 
     * $parameter      array  Associative array of submitted fields and associated error messages received from the server.
     *     ['field']   string The submitted but unexpected/expected field name with/without erroneous value. 
     *     ['message'] string The helpful error message instructing how to correct the error.  
     * 
     * @param array $data See the fields description above.
     */
    public function __construct( $data ) {
        parent::__construct( $data['message'] );
        
        $this->type       = $data['type'];
        $this->message    = $data['message'];
        $this->parameters = array_key_exists('status'    , $data) ? $data['status']     : array();
        $this->parameters = array_key_exists('parameters', $data) ? $data['parameters'] : array();
    }

    /**
     * Custom implementation for stringification of the error message for better readability.
     * 
     * @return string
     */
    public function __toString() {
        $message = 'Exception \'' . get_class($this) . "' in {$this->getFile()}:{$this->getLine()} \n\n";
        $message .= "$this->message\n";
        $num = 1;
        if (!empty($this->parameters)) {
            $message .= "Parameters:\n";
        }
        foreach ($this->parameters as $error) {
            $message .= sprintf("% 3d", $num). ") field: \"{$error['field']}\"\n"
                      . "     message: \"{$error['message']}\"\n";
            $num++;
        }
        $message .= "\nStack trace:\n" . $this->getTraceAsString();
        return $message;
    }

}

