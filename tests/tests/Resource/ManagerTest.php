<?php

namespace AdButler;

class ManagerTest extends SingleResourceTestCase
{
    public $url = 'managers';
    public $type = 'manager';

    /**
     * @param array $reqData
     * @param Manager $resourceObj
     */
    public function assertResourceFields(Array $reqData, $resourceObj)
    {
        $this->assertSame($reqData['name'], $resourceObj->name);
        $this->assertSame($reqData['email'], $resourceObj->email);
        $this->assertSame($reqData['notes'], $resourceObj->notes);
        $this->assertSame($reqData['position'], $resourceObj->position);
        $this->assertSame($reqData['can_manage_publishers'], $resourceObj->can_manage_publishers);
        $this->assertSame($reqData['can_manage_links'], $resourceObj->can_manage_links);
        $this->assertSame($reqData['can_manage_media'], $resourceObj->can_manage_media);
        $this->assertSame($reqData['can_manage_targets'], $resourceObj->can_manage_targets);
        $this->assertSame($reqData['can_manage_users'], $resourceObj->can_manage_users);
        $this->assertSame($reqData['can_view_stats'], $resourceObj->can_view_stats);
        $this->assertSame($reqData['can_view_assigned_stats'], $resourceObj->can_view_assigned_stats);
    }

    public function createRequestData($data = array())
    {
        return array(
            'name'                    => key_exists('name', $data) ? $data['name'] : 'Custom Manager',
            'email'                   => key_exists('email', $data) ? $data['email'] : 'manager@adbutler.com',
            'password'                => key_exists('password', $data) ? $data['password'] : '',
            'position'                => null,
            'notes'                   => null,
            'can_manage_publishers'   => key_exists('can_manage_publishers',
                $data) ? $data['can_manage_publishers'] : array(1, 2, 3),
            'can_manage_links'        => key_exists('can_manage_links', $data) ? $data['can_manage_links'] : true,
            'can_manage_media'        => key_exists('can_manage_media', $data) ? $data['can_manage_media'] : true,
            'can_manage_targets'      => key_exists('can_manage_targets', $data) ? $data['can_manage_targets'] : true,
            'can_manage_users'        => key_exists('can_manage_users', $data) ? $data['can_manage_users'] : true,
            'can_view_stats'          => key_exists('can_view_stats', $data) ? $data['can_view_stats'] : true,
            'can_view_assigned_stats' => key_exists('can_view_assigned_stats',
                $data) ? $data['can_view_assigned_stats'] : true,
        );
    }

    public function response($id, $data = array())
    {
        return array(
            'object'                  => $this->type,
            'self'                    => $this->getSelfURL($id),
            'id'                      => $id,
            'name'                    => key_exists('name', $data) ? $data['name'] : 'Custom Manager',
            'email'                   => key_exists('email', $data) ? $data['email'] : 'manager@adbutler.com',
            'can_manage_links'        => key_exists('can_manage_links', $data) ? $data['can_manage_links'] : true,
            'can_manage_media'        => key_exists('can_manage_media', $data) ? $data['can_manage_media'] : true,
            'can_manage_publishers'   => key_exists('can_manage_publishers',
                $data) ? $data['can_manage_publishers'] : array(1, 2, 3),
            'can_manage_targets'      => key_exists('can_manage_targets', $data) ? $data['can_manage_targets'] : true,
            'can_manage_users'        => key_exists('can_manage_users', $data) ? $data['can_manage_users'] : true,
            'can_view_assigned_stats' => key_exists('can_view_assigned_stats',
                $data) ? $data['can_view_assigned_stats'] : true,
            'can_view_stats'          => key_exists('can_view_stats', $data) ? $data['can_view_stats'] : true,
            'created_date'            => '2016-02-22 12:02:36',
            'last_accessed'           => null,
            'notes'                   => null,
            'position'                => null
        );

    }

    /*
     * Resource specific methods
     */

}
