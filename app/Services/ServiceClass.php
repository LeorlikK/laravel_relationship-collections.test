<?php

namespace App\Services;

class ServiceClass implements ServiceInterface
{
    public function getOneArray(): array
    {
        return [1,2,3];
    }

    public function getTwoArray(): array
    {
        return [4,5,6];
    }
}
