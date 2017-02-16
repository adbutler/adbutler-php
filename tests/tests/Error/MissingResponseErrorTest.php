<?php

namespace AdButler;

class MissingResponseErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'missing_response_error',
        'status'  => 500,
        'message' => 'Something crazy happened, but people know about it and are doing something about it.',
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('MissingResponseError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::retrieve(1);
    }
}
