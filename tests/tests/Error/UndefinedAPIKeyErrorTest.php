<?php

namespace AdButler;

class UndefinedAPIKeyErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'undefined_api_key_error',
        'status'  => 400,
        'message' => 'No API key was provided.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('UndefinedAPIKeyError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::create(array());
    }
}
