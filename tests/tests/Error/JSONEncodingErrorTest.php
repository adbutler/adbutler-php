<?php

namespace AdButler;

class JSONEncodingErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'json_encoding_error',
        'status'  => 500,
        'message' => 'There was a problem generating the response to this request. If this problem persists, please contact support.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('JSONEncodingError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::create(array());
    }
}
