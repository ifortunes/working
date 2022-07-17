<?php

namespace App\DTO\Api\v1;

class AdvertisementStoreDTO
{
    public function __construct(
        private string $name,
        private string $description,
        private array $images,
        private string|int $price,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string|int
    {
        return $this->price;
    }


    public function getImages(): array
    {
        return $this->images;
    }
}
