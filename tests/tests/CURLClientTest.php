<?php

namespace AdButler;

use AdButler\Error\UndefinedRequestParametersError;

class CURLClientTest extends TestUtils  
{
    private $baseURL = 'https://api.adbutler.com';
    private $apiKey  = 'API_KEY';
    private $version = 'v1';

    public function getFileUploadData() {
        return array(
            'name'        => 'xyz',
            'file'        => 'data/image1.png',
            'group'       => 123,
            'description' => 'bla bla bla',
        );
    }
    
    // Tests the CURL headers
    public function testFileUpload() {
        CURLClient::init(array('api_key'=>$this->apiKey));
        $headers = $this->invokeMethod('AdButler\CURLClient', 'constructCURLOptionsArray', array('POST', $this->getFileUploadData()));

        $this->assertFalse($headers[CURLOPT_HTTPGET]);
        $this->assertTrue($headers[CURLOPT_POST]);
        $this->assertFalse($headers[CURLOPT_SAFE_UPLOAD]);
        $this->assertEquals(
            array(
                'Content-Type: multipart/form-data',
                'Authorization: Basic ' . $this->apiKey,
                'X-AdButler-Requestor: ' . php_uname(),
                'X-AdButler-PHP-Client: true',
                'Expect:'
            ),
            $headers[CURLOPT_HTTPHEADER]
        );
        $this->assertEquals($this->getFileUploadData(), $headers[CURLOPT_POSTFIELDS]);
    }
    
    public function testPOSTRequest() {
        // TODO: don't do a POST request.
        // TODO: just check if everything in the CURL request is set correctly
        
    }

    public function testNullDataForPOSTRequest() {
        CURLClient::init(array('api_key'=>$this->apiKey));
        try {
            CURLClient::request('POST', "$this->baseURL/$this->version/advertisers");
        } catch (UndefinedRequestParametersError $e) {
            $this->assertSame('invalid_request_error', $e->type, 'Mismatch request error types.');
        }
    }
    
    public function testNullDataForPUTRequest() {
        CURLClient::init(array('api_key'=>$this->apiKey));
        try {
            CURLClient::request('PUT', "$this->baseURL/$this->version/advertisers");
        } catch (UndefinedRequestParametersError $e) {
            $this->assertSame('invalid_request_error', $e->type);
        }
    }
    
    public function testCURLRequest() {
        $url = 'http://www.google.ca';
        $curlOptions = array( CURLOPT_RETURNTRANSFER => true );
        $response = $this->invokeMethod('AdButler\CURLClient', '_makeRequest', array($url, $curlOptions));
        $this->assertSame(CURLE_OK, $response['error_number']);
        $this->assertSame('', $response['error_message']);
        $this->assertNotEmpty($response['response']);
    }
    
    public function testEncodedURLs() {
        $queryParams = array(
            'type'   => 'publisher',
            'from'   => '2016-09-01T00:00:00+00:00',
            'to'     => '2016-10-15T16:00:00+00:00',
            'period' => 'year',
        );
        CURLClient::init(array('api_key'=>$this->apiKey));
        $response = $this->invokeMethod('AdButler\CURLClient', 'constructRequestURL', array("$this->baseURL/$this->version/stats", 123, $queryParams, array()));
        $this->assertSame('http://api.adbutler.com.baig.dev/v1/stats/123?type=publisher&from=2016-09-01T00%3A00%3A00%2B00%3A00&to=2016-10-15T16%3A00%3A00%2B00%3A00&period=year', $response);
    }
}