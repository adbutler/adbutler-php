<?php

namespace AdButler;

class FlashCreativeTest extends SingleResourceTestCase
{
    public $url = "creatives/flash";
    public $type = "flash_creative";

    /**
     * @param array $reqData
     * @param FlashCreative $resourceObj
     */
    public function assertResourceFields(Array $reqData, $resourceObj)
    {
        $this->assertSame($reqData['name'], $resourceObj->name);
        $this->assertSame($reqData['group'], $resourceObj->group);
        $this->assertSame($reqData['description'], $resourceObj->description);
    }

    public function createRequestData($data = array())
    {
        return array(
            "name"        => key_exists('name', $data) ? $data['name'] : "Custom Flash Creative",
            "file"        => key_exists('file', $data) ? $data['file'] : realpath("../adbutler-data/snack.swf"),
            "group"       => key_exists('group', $data) ? $data['group'] : 1,
            "description" => key_exists('description', $data) ? $data['description'] : "This is the description.",
        );
    }

    public function collectionResponse($id, $data = array())
    {
        return array(
            "object"   => "list",
            "has_more" => true,
            "limit"    => 10,
            "offset"   => 0,
            "url"      => "/v1/creatives/flash",
            "data"     => array($this->response($id, $data))
        );
    }

    public function response($id, $data = array())
    {
        return array(
            "object"      => $this->type,
            "self"        => $this->getSelfURL($id),
            "id"          => $id,
            "name"        => key_exists('name', $data) ? $data['name'] : "Custom Flash Creative",
            "group"       => key_exists('group', $data) ? $data['group'] : 1,
            "description" => key_exists('description', $data) ? $data['description'] : "This is the description.",
            "width"       => 300,
            "height"      => 250,
            "file_name"   => "snack.swf",
            "file_size"   => 77383,
            "mime_code"   => 47,
            "upload_time" => "2016-04-29 09:36:35",
        );

    }
}
