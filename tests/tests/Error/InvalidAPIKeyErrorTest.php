<?php

namespace AdButler;

class InvalidAPIKeyErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'invalid_api_key_error',
        'status'  => 400,
        'message' => 'Invalid API key.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidAPIKeyError'));
        
        $this->setCannedResult( $this->cannedResponse );
        
        Advertiser::create(array());
    }
}
