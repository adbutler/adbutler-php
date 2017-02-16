<?php

namespace AdButler;

class ResourceCreateErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'resource_create_error',
        'status'  => 500,
        'message' => 'Unable to create this resource at this time. Please try again or contact support.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('ResourceCreateError'));

        $this->setCannedResult( $this->cannedResponse );

        Advertiser::create(array());
    }
}
