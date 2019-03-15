<?php

namespace AdButler;

class ResourceNotFoundErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'resource_not_found_error',
        'status'  => 404,
        'message' => 'Resource not found.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('ResourceNotFoundError'));

        $this->setCannedResult($this->cannedResponse);

        Advertiser::retrieve(-1);
    }
}
