<?php

namespace AdButler;

class MediaGroupTest extends SingleResourceTestCase
{
    public $url = "media-groups";
    public $type = "media_group";

    /**
     * @param array $reqData
     * @param MediaGroup $resourceObj
     */
    public function assertResourceFields(Array $reqData, $resourceObj)
    {
        $this->assertSame($reqData['name'], $resourceObj->name);
    }

    public function createRequestData($data = array())
    {
        return array(
            "name" => key_exists('name', $data) ? $data['name'] : "Custom Media Group",
        );
    }

    public function response($id, $data = array())
    {
        return array(
            "object" => $this->type,
            "self"   => $this->getSelfURL($id),
            "id"     => $id,
            "name"   => key_exists('name', $data) ? $data['name'] : "Custom Media Group",
        );
    }

    /*
     * Resource specific methods
     */

}
