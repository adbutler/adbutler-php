<?php

namespace AdButler;

class InvalidPropertyExceptionTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object' => 'advertiser',
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidPropertyException'));

        $this->setCannedResult($this->cannedResponse);

        $resource = Advertiser::retrieve(1);

        $resource->invalid_property;
    }
}


