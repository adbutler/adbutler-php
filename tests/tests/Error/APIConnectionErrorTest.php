<?php

namespace AdButler;

class APIConnectionErrorTest extends AdButlerTestCase
{
    public function testThrowingOfError()
    {
        // Error\APIConnectionError::class throws error in PHP 5.3 and 5.4
        $this->setExpectedException(TestUtils::getFQCN('APIConnectionError'));

        $this->setCURLError( 4, 'bla bla bla' );

        Advertiser::create(array());
    }
}
