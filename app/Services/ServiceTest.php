<?php

namespace App\Services;

class ServiceTest
{
    private ServiceInterface $service;
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function getService():array
    {
        return $this->service->getOneArray();
    }
}
