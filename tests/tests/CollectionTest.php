<?php

namespace AdButler;

use AdButler\Error\InvalidPropertyException;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    private function getCollectionData()
    {
        return array(
            'object'   => 'list',
            'has_more' => false,
            'limit'    => 0,
            'offset'   => 0,
            'url'      => '/v1/advertisers',
            'data'     => array(
                array(
                    'object'              => 'advertiser',
                    'self'                => '/v1/advertisers/123',
                    'id'                  => 123,
                    'can_change_password' => true,
                    'can_add_banners'     => true,
                    'email'               => 'example@domain.com',
                    'name'                => 'John doe',
                    'has_password'        => true,
                ),
            ),
        );
    }

    private function getUpdateData()
    {
        return array(
            array(
                'object'         => 'banner_campaign',
                'self'           => '/v1/campaigns/banner/123',
                'id'             => 123,
                'advertiser'     => 321,
                'height'         => 300,
                'name'           => '2015-06 Adbutler API',
                'roadblock_tags' => null,
                'width'          => 250
            )
        );
    }

    public function testInstantiationReturningObject()
    {
        $collection = Collection::instantiate($this->getCollectionData());
        $this->assertNotEmpty($collection->getData());
        $this->assertInstanceOf('AdButler\Collection', $collection);
    }

    public function testInstantiationReturningArray()
    {
        $collection = Collection::instantiate($this->getCollectionData(), true);
        $this->assertNotEmpty($collection);
        $this->assertInternalType('array', $collection);
    }

//    public function testInvalidPropertyException() {
//        $collection = Collection::instantiate( $this->getCollectionData() );
//        $field = 'blaBla';
//        try{
//            $collection->$field;
//        } catch (InvalidPropertyException $e) {
//            $this->assertSame($field, $e->field);
//        }
//        
//    }

    public function testGet()
    {
        $collection = Collection::instantiate($this->getCollectionData());

        $this->assertInternalType('string', $collection->object);
        $this->assertInternalType('boolean', $collection->has_more);
        $this->assertInternalType('int', $collection->limit);
        $this->assertInternalType('int', $collection->offset);
        $this->assertInternalType('string', $collection->url);
        $this->assertInternalType('array', $collection->getData());

        $this->assertSame('list', $collection->object);
        $this->assertSame(false, $collection->has_more);
        $this->assertSame(0, $collection->limit);
        $this->assertSame(0, $collection->offset);
        $this->assertSame('/v1/advertisers', $collection->url);

        $this->assertNotEmpty($collection->getData());
    }

    public function testGetData()
    {
        $colData = $this->getCollectionData();
        $collection = Collection::instantiate($colData);
        $data = $collection->getData();
        $this->assertInternalType('array', $data);
    }

    public function testSetData()
    {
        $colData = $this->getCollectionData();
        $collection = Collection::instantiate($colData);
        $data = $collection->getData();
        $this->assertInternalType('array', $data);
    }

    public function testStringification()
    {

    }

    public function testJSONification()
    {

    }
}