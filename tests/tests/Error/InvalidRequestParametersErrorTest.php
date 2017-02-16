<?php

namespace AdButler;

class InvalidRequestParametersErrorTest extends AdButlerTestCase  
{
    private $cannedResponse = array(
        'object'     => 'error',
        'type'       => 'invalid_request_parameters_error',
        'status'     => 400,
        'message'    => 'One or more of the specified fields was invalid.',
        'parameters' => array(
            array(
                'field'   => 'can_add_banners',
                'message' => "The field 'can_add_banners' must be true or false.",
            )
        )
    );
    
    public function testThrowingOfError()
    {
        $this->setExpectedException(TestUtils::getFQCN('InvalidRequestParametersError'));
        
        $this->setCannedResult( $this->cannedResponse );
        
        $resource = Advertiser::retrieve(1);
        
        $resource->can_add_banners = 3;
        
        $resource->save();
    }
}
