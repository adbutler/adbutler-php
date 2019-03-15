<?php

namespace AdButler;

class InvalidResourceErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'invalid_resource_error',
        'status'  => 404,
        'message' => 'This resource endpoint does not exist.',
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidResourceError'));

        $this->setCannedResult($this->cannedResponse);

        Advertiser::create(array());
    }
}
