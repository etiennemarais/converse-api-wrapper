<?php namespace ConverseApi\Tests;

use ConverseApi\Services\Curl\Converse;

class ConverseCurlServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResource()
    {
        $response = Converse::make()->get('http://httpbin.org/get');

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/get', $response->url);
    }

    public function testGetResourceWithHeaders()
    {
        $headers = array(
            array('X-Auth-Token:someAuthToken'),
        );

        $response = Converse::make()
            ->withHeaders($headers)
            ->get('http://httpbin.org/get');

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/get', $response->url);

        $headers = (array)$response->headers;
        $this->assertSame('someAuthToken', $headers['X-Auth-Token']);
    }

    public function testDeleteResource()
    {
        $response = Converse::make()->delete('http://httpbin.org/delete');

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/delete', $response->url);
    }

    public function testDeleteResourceWithHeaders()
    {
        $headers = array(
            array('X-Auth-Token:someAuthTokenDelete'),
        );

        $response = Converse::make()
            ->withHeaders($headers)
            ->delete('http://httpbin.org/delete');

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/delete', $response->url);

        $headers = (array)$response->headers;
        $this->assertSame('someAuthTokenDelete', $headers['X-Auth-Token']);
    }

    public function testPutResource()
    {
        $response = Converse::make()->put('http://httpbin.org/put', array());

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/put', $response->url);
    }

    public function testPutResourceWithHeaders()
    {
        $headers = array(
            array('X-Auth-Token:someAuthTokenPut'),
        );

        $response = Converse::make()
            ->withHeaders($headers)
            ->put('http://httpbin.org/put', array());

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/put', $response->url);

        $headers = (array)$response->headers;
        $this->assertSame('someAuthTokenPut', $headers['X-Auth-Token']);
    }

    public function testPostResource()
    {
        $data = array(
            'email' => 'test@test.com',
            'name' => 'Firstname',
        );
        $response = Converse::make()->post('http://httpbin.org/post', $data);

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/post', $response->url);
        $this->assertSame($data, (array)$response->form);
    }

    public function testPostResourceWithHeaders()
    {
        $headers = array(
            array('X-Auth-Token:someAuthTokenPost'),
        );

        $data = array(
            'email' => 'test@test.com',
            'name' => 'Firstname',
        );
        $response = Converse::make()->withHeaders($headers)
            ->post('http://httpbin.org/post', $data);

        $this->assertSame(JSON_ERROR_NONE, json_last_error());
        $this->assertSame('http://httpbin.org/post', $response->url);
        $this->assertSame($data, (array)$response->form);

        $headers = (array)$response->headers;
        $this->assertSame('someAuthTokenPost', $headers['X-Auth-Token']);
    }
}