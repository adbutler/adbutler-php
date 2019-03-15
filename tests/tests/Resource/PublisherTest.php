<?php

namespace AdButler;

class PublisherTest extends SingleResourceTestCase
{
    public $url = "publishers";
    public $type = "publisher";

    /**
     * @param array $reqData
     * @param Publisher $resourceObj
     */
    public function assertResourceFields(Array $reqData, $resourceObj)
    {
        $this->assertSame($reqData['name'], $resourceObj->name);
        $this->assertSame($reqData['email'], $resourceObj->email);
        $this->assertSame($reqData['can_approve_ads'], $resourceObj->can_approve_ads);
        $this->assertSame($reqData['can_admin_account'], $resourceObj->can_admin_account);
        $this->assertSame($reqData['can_change_password'], $resourceObj->can_change_password);
        $this->assertSame($reqData['default_payout_percent'], $resourceObj->default_payout_percent);
    }

    public function createRequestData($data = array())
    {
        return array(
            "name"                   => key_exists('name', $data) ? $data['name'] : "Custom Publisher",
            "email"                  => key_exists('email', $data) ? $data['email'] : "publisher@adbutler.com",
            "can_approve_ads"        => key_exists('can_approve_ads', $data) ? $data['can_approve_ads'] : true,
            "can_admin_account"      => key_exists('can_admin_account', $data) ? $data['can_admin_account'] : true,
            "can_change_password"    => key_exists('can_change_password', $data) ? $data['can_change_password'] : true,
            "default_payout_percent" => key_exists('default_payout_percent',
                $data) ? $data['default_payout_percent'] : 2,
        );
    }

    public function response($id, $data = array())
    {
        return array(
            "object"                 => $this->type,
            "self"                   => $this->getSelfURL($id),
            "id"                     => $id,
            "name"                   => key_exists('name', $data) ? $data['name'] : "Custom Publisher",
            "email"                  => key_exists('email', $data) ? $data['email'] : "publisher@adbutler.com",
            "can_approve_ads"        => key_exists('can_approve_ads', $data) ? $data['can_approve_ads'] : true,
            "can_admin_account"      => key_exists('can_admin_account', $data) ? $data['can_admin_account'] : true,
            "can_change_password"    => key_exists('can_change_password', $data) ? $data['can_change_password'] : true,
            "default_payout_percent" => key_exists('default_payout_percent',
                $data) ? $data['default_payout_percent'] : 2,
        );
    }

    /*
     * Tests for Resource specific methods
     */

}
