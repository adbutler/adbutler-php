<?php

namespace AdButler;

class JSONDecodingErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'json_decoding_error',
        'status'  => 400,
        'message' => 'Could not decode JSON input provided.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('JSONDecodingError'));

        $this->setCannedResult($this->cannedResponse);

        Advertiser::create(array());
    }
}
