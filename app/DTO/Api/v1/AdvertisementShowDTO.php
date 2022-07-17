<?php

namespace App\DTO\Api\v1;

class AdvertisementShowDTO
{
    public function __construct(
        private string|null $fields,
    ){}

    public function getFields()
    {
        return $this->fields;
    }
}
