<?php

namespace App\DTO\Api\v1;

class AdvertisementIndexDTO
{
    public function __construct(
        private string $asc,
        private string $desc,
        private int $page,
    ){}

    public function getAsc(): string
    {
        return $this->asc;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getPage(): string
    {
        return $this->page;
    }
}
