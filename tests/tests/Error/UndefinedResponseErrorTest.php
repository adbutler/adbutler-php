<?php

namespace AdButler;

class UndefinedResponseErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'undefined_response_error',
        'status'  => 500,
        'message' => 'Something crazy happened, but people know about it and are doing something about it.',
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('UndefinedResponseError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::retrieve(1);
    }
}
