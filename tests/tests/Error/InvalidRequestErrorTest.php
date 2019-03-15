<?php

namespace AdButler;

class InvalidRequestErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'invalid_request_error',
        'message' => 'Resource not found.',
        'status'  => 404
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidRequestError'));

        $this->setCannedResult($this->cannedResponse);

        // TODO: set this data on the advertiser object;

        API::init(array('api_key' => 'invalid'));
        Advertiser::create(array());
    }

}
