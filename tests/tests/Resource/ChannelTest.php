<?php

namespace AdButler;

class ChannelTest extends SingleResourceTestCase
{
    public $url  = "channels";
    public $type = "channel";

    /**
     * @param array $reqData
     * @param Channel $resourceObj
     */
    public function assertResourceFields( Array $reqData, $resourceObj ) {
        $this->assertSame($reqData['name']    , $resourceObj->name);
        $this->assertSame($reqData['priority'], $resourceObj->priority);
    }

    public function createRequestData( $data = array() ) {
        return array(
            "name"     => key_exists('name'    , $data) ? $data['name']     : "Custom Channel",
            "priority" => key_exists('priority', $data) ? $data['priority'] : "standard",
        );
    }

    public function response($id, $data = array() ) {
        return array(
            "object"   => $this->type,
            "self"     => $this->getSelfURL($id),
            "id"       => $id,
            "name"     => key_exists('name'    , $data) ? $data['name']     : "Custom Channel",
            "priority" => key_exists('priority', $data) ? $data['priority'] : "standard",
        );
    }
}
