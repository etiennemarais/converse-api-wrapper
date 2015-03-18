<?php namespace ConverseApi\Services\Curl\Contracts;

use Closure;
use ConverseApi\Services\Curl\Contracts\Request as RequestContract;

interface RequestDispatcher
{
    public function add(RequestContract $request);

    public function clear();

    public function remove($key);

    public function get($key = null);

    public function getStackSize();

    public function setStackSize($size);

    public function execute(Closure $callback = null);

    public function all();
}
