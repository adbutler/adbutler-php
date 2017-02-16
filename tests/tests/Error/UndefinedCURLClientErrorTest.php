<?php

namespace AdButler;

class UndefinedCURLClientErrorTest extends \PHPUnit_Framework_TestCase
{
    private $cannedResponse = array(
        'object'  => 'error',
        'type'    => 'undefined_curl_client_error',
        'message' => "Please specify a CURL Client for making HTTP requests.",
    );

    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('UndefinedCURLClientError'));

        ListOnlyResource::init();
    }
}
