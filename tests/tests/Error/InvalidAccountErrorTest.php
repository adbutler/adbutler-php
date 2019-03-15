<?php

namespace AdButler;

class InvalidAccountErrorTest extends AdButlerTestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'invalid_account_error',
        'status'  => 400,
        'message' => 'AdButler account does not exist.'
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidAccountError'));

        $this->setCannedResult($this->cannedResponse);

        Advertiser::create(array());
    }
}
