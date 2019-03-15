<?php

namespace AdButler;

/**
 * Base class for AdButler test cases.
 * Provides some utility methods for creating objects.
 */
class SingleResourceTestCase extends AdButlerTestCase
{
    public function testCreate($id = 1)
    {
        $class = $this->getResourceClass();
        $data = $this->createRequestData();
        $this->setCannedResult($this->response($id, $data));
        $response = $class::create($data);
        $this->assertResourceFields($data, $response);
    }

    public function testRetrieve($id = 1)
    {
        $class = $this->getResourceClass();
        $this->setCannedResult($this->response($id));
        $response = $class::retrieve($id);
        $this->assertSame($response->id, $id);
    }

    public function testUpdate()
    {

    }

    public function testSave()
    {

    }

    public function testDelete()
    {
        $resource = $this->createTestResource($this->getResourceClass(), $this->createRequestData());
        $this->setCannedResult($this->deleteResponse($resource->id));
        $deleted = $resource->delete();
        $this->assertTrue($deleted);
    }

    public function testRetrieveAll($id = 1)
    {
        $class = $this->getResourceClass();
        $this->setCannedResult($this->collectionResponse($id));
        $collection = $class::retrieveAll();
        /** @var Collection $collection */
        $this->assertSame($collection->object, 'list');
    }
}
