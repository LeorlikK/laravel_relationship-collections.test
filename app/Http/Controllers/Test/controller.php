<?php

class One
{
    public $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}

class Two extends One
{
    public function test()
    {
        return $this->service->store();
    }
}

class Service
{
    public function store()
    {
        return 'Store';
    }

    public function update()
    {
        return 'Update';
    }
}

