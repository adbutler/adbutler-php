<?php

namespace AdButler;

class FileUploadTest extends TestUtils
{
    private $apiKey  = 'API_KEY';

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
}