<?php

namespace App\Services\Api\v1;

use App\DTO\Api\v1\{
    AdvertisementIndexDTO,
    AdvertisementStoreDTO,
};
use App\Http\Resources\Api\v1\AdvertisementCollection;
use App\Models\Advertisement;

class AdvertisementService
{
    /**
     * @param AdvertisementIndexDTO $dto
     * @return object
     */
    public function index(AdvertisementIndexDTO $dto): object
    {
        return new AdvertisementCollection(
            app(SortService::class)
            ->apply([
                'asc' => $dto->getAsc(),
                'desc' => $dto->getDesc()
            ])->paginate(10, ['*'], 'page', $dto->getPage())
        );
    }

    /**
     * @param AdvertisementStoreDTO $dto
     * @return mixed
     */
    public function store(AdvertisementStoreDTO $dto): int
    {
        $images = $dto->getImages();

        return Advertisement::create([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'image' => array_shift($images),
            'images' => $images,
            'price' => $dto->getPrice(),
        ])->id;
    }

    /**
     * @param $id
     * @param $dto
     * @return mixed
     */
    public function show($id, $dto):object
    {
        $fields = app(ApiService::class)
            ->checkAllowedFields($dto->getFields());

        return Advertisement::findOrFail($id, $fields);
    }
}
