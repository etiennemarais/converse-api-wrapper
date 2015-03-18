<?php namespace ConverseApi\Tests;

use ConverseApi\Services\Curl\HeaderBag;
use Mockery;

class HeaderBagTest extends \PHPUnit_Framework_TestCase
{
    private $request;
    private $headerBag;

    public function __construct()
    {
        $this->request = Mockery::mock('ConverseApi\Services\Curl\Contracts\Request');
        $this->headerBag = new HeaderBag(array(), $this->request);
    }

    public function teardown()
    {
        Mockery::close();
    }

    public function testCreateHeaderBag()
    {
        $this->assertInstanceof('ConverseApi\Services\Curl\HeaderBag', $this->headerBag);
    }

    public function testSet_WithValues_AddsHeaderToRequest()
    {
        $this->request->shouldReceive('setOption')
            ->once()
            ->with(Mockery::mustBe(CURLOPT_HTTPHEADER), Mockery::type('array'));

        $this->headerBag->set('foo', 'bar');
    }

    public function testRemove()
    {
        $this->request->shouldReceive('setOption')
            ->once()
            ->with(Mockery::mustBe(CURLOPT_HTTPHEADER), Mockery::type('array'));

        $this->headerBag->remove('foo');
    }
}
