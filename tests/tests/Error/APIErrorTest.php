<?php

namespace AdButler;

class APIErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'api_error',
        'status'  => 500,
        'message' => 'Something crazy happened, but people know about it and are doing something about it.',
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('APIError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::retrieve(1);
    }
}


