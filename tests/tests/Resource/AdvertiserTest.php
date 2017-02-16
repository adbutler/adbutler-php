<?php

namespace AdButler;

class AdvertiserTest extends SingleResourceTestCase
{
    public $url  = "advertisers";
    public $type = "advertiser";

    /**
     * @param array $reqData
     * @param Advertiser $resourceObj
     */
    public function assertResourceFields( Array $reqData, $resourceObj ) {
        $this->assertSame($reqData['name']               , $resourceObj->name);
        $this->assertSame($reqData['email']              , $resourceObj->email);
        $this->assertSame($reqData['can_add_banners']    , $resourceObj->can_add_banners);
        $this->assertSame($reqData['can_change_password'], $resourceObj->can_change_password);
    }

    public function createRequestData( $data = array() ) {
        return array(
            "name"                => key_exists('name'               , $data) ? $data['name']                : "Custom Advertiser",
            "email"               => key_exists('email'              , $data) ? $data['email']               : "nobody@adbutler.com",
            "password"            => key_exists('password'           , $data) ? $data['password']            : "custompassword",
            "can_add_banners"     => key_exists('can_add_banners'    , $data) ? $data['can_add_banners']     : true,
            "can_change_password" => key_exists('can_change_password', $data) ? $data['can_change_password'] : true,
        );
    }

    public function response($id, $data = array() ) {
        return array(
            "object"              => $this->type,
            "self"                => $this->getSelfURL($id),
            "id"                  => $id,
            "has_password"        => true,
            "name"                => key_exists('name'               , $data) ? $data['name']                : "Custom Advertiser",
            "email"               => key_exists('email'              , $data) ? $data['email']               : "nobody@adbutler.com",
            "can_add_banners"     => key_exists('can_add_banners'    , $data) ? $data['can_add_banners']     : true,
            "can_change_password" => key_exists('can_change_password', $data) ? $data['can_change_password'] : true,
        );
    }

    /*
     * Tests for Resource specific methods
     */

    public function testSomeMethodName() {}

}
