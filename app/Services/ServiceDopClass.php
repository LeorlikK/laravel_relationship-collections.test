<?php

namespace App\Services;

class ServiceDopClass implements ServiceInterface
{
    private  array $oneArray;
    private  array $twoArray;
    public function __construct($oneArray, $twoArray)
    {
        $this->oneArray = $oneArray;
        $this->twoArray = $twoArray;
    }

    public function getOneArray(): array
    {
        return $this->oneArray;
    }

    public function getTwoArray(): array
    {
        return $this->twoArray;
    }
}
