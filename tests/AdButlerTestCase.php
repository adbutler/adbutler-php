<?php

namespace AdButler;

/**
 * Base class for AdButler test cases.
 * Provides some utility methods for creating objects.
 */
class AdButlerTestCase extends \PHPUnit_Framework_TestCase  
{
    private $apiKey = 'API_KEY';

    /** @var CURLClientMock $curlClient */
    private $testCURLClient;

    public $url;
    public $type;
    public $version = "v1";

    public function setUp() {
        if (!$this->testCURLClient) {
            // create a mock curlclient and pass it in to the API
            $this->testCURLClient = CURLClientMock::getInstance();

            API::init(array(
                'api_key'     => $this->apiKey,
                'curl_client' => $this->testCURLClient,
            ));
        }
    }
    
    public function tearDown() {
        $curlClient = $this->testCURLClient; /** @var CURLClientMock $curlClient */
        $curlClient::$result = null;
        $curlClient::$curlError = false;
        $curlClient::$curlErrorNumber  = CURLE_OK; // 0
        $curlClient::$curlErrorMessage = 'CURL error message';
    }

    public function setAPIKey( $apiKey ) {
        $this->apiKey = $apiKey;
    }

    public static $curlError = false;

    public static $curlErrorNumber  = CURLE_OK; // 0
    public static $curlErrorMessage = 'CURL error message';

    /**
     * @param array $result Associative array of the response to be returned by the CURL request
     */
    public function setCannedResult( $result ) {
        $curlClient = $this->testCURLClient; /** @var CURLClientMock $curlClient */
        $curlClient::$result = json_encode($result);
    }
    
    public function setCURLError( $number, $message ) {
        $curlClient = $this->testCURLClient; /** @var CURLClientMock $curlClient */
        $curlClient::$curlErrorNumber  = $number;
        $curlClient::$curlErrorMessage = $message;
    }
    
//    public function makeCURLRequest() {
//        $curlClient = $this->testCURLClient; /** @var CURLClientMock $curlClient */
//        $curlClient::request();
//    }

    /**
     * Override in the derived class to return the create request data
     * 
     * @param  array $data
     * @return array
     */
    public function createRequestData( $data = array() ) {}
    
    //public function collectionResponse($id, $data = array() ) {}
    
    /**
     * Override in the derived class to return the response
     * 
     * @param  int   $id
     * @param  array $data
     * @return array
     */
    public function response($id, $data = array() ) {}
    public function assertResourceFields( Array $reqData, $resourceObj ) {}

    /**
     * @return Resource
     */
    public function getResourceClass() {
        return substr( get_called_class(), 0, -4 );
    }

    public function getSelfURL( $id = null ) {
        return empty( $id )
             ? "/$this->version/$this->url"
             : "/$this->version/$this->url/$id";
    }

    /**
     * @return Resource
     */
    public function createTestResource( $class, $data, $id = 1 ) {
        $this->setCannedResult( $this->response($id, $data) );
        return $class::create( $data );
    }

    public function deleteResponse( $id ) {
        return array( 'id'=>$id, 'deleted'=>true );
    }

    public function collectionResponse($id, $data = array() ) {
        return array(
            "object"   => "list",
            "has_more" => true,
            "limit"    => 10,
            "offset"   => 0,
            "url"      => $this->getSelfURL(),
            "data"     => array( $this->response($id, $data) )
        );
    }
}
