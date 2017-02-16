<?php

namespace AdButler;

class GeoTargetTest extends SingleResourceTestCase
{
    public $url  = "geo-targets";
    public $type = "geo_target";

    /**
     * @param array $reqData
     * @param GeoTarget $resourceObj
     */
    public function assertResourceFields( Array $reqData, $resourceObj ) {
        $this->assertSame($reqData['name']     , $resourceObj->name);
        $this->assertSame($reqData['range']    , $resourceObj->range);
        $this->assertSame($reqData['unit']     , $resourceObj->unit);
        $this->assertSame($reqData['inclusive'], $resourceObj->inclusive);
        //$this->assertSame($reqData['areas']    , $resourceObj->getAreas());
    }

    public function createRequestData( $data = array() ) {
        return array(
            "name"      => key_exists('name'     , $data) ? $data['name']      : "Custom Geo Target",
            "range"     => key_exists('range'    , $data) ? $data['range']     : 1,
            "unit"      => key_exists('unit'     , $data) ? $data['unit']      : "miles",
            "inclusive" => key_exists('inclusive', $data) ? $data['inclusive'] : true,
            "areas"     => key_exists('areas'    , $data) ? $data['areas']     : array( "country"=>"CA", "region"=>"British Columbia", "city"=>"Vancouver" ),
        );
    }

    public function collectionResponse($id, $data = array() ) {
        return array(
            "object"   => "list",
            "has_more" => true,
            "limit"    => 10,
            "offset"   => 0,
            "url"      => "/v1/geotargets",
            "data"     => array( $this->response($id, $data) )
        );
    }

    public function response($id, $data = array() ) {
        return array(
            "object"    => $this->type,
            "self"      => $this->getSelfURL($id),
            "id"        => $id,
            "name"      => key_exists('name'     , $data) ? $data['name']      : "Custom Geo Target",
            "range"     => key_exists('range'    , $data) ? $data['range']     : 1,
            "unit"      => key_exists('unit'     , $data) ? $data['unit']      : "miles",
            "inclusive" => key_exists('inclusive', $data) ? $data['inclusive'] : true,
            "areas"     => key_exists('areas'    , $data) ? $data['areas']     : array(),
        );
    }
}
