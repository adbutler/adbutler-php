<?php

namespace AdButler;

class MethodNotSupportedErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'method_not_supported_error',
        'status'  => 405,
        'message' => 'This request method is not supported.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('MethodNotSupportedError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::retrieve(-1);
    }
}
