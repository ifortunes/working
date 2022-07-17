<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\v1\{
    AdvertisementStoreRequest,
    AdvertisementIndexRequest,
    AdvertisementShowRequest
};

use App\Services\Api\v1\AdvertisementService;

class AdvertisementController extends Controller
{
    public function index(AdvertisementIndexRequest $request, AdvertisementService $service)
    {
        try {
            return $service->index($request->getDto());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(AdvertisementStoreRequest $request, AdvertisementService $service)
    {
        try {
            $id = $service->store($request->getDto());
            return response()->json(['id' => $id], 201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id, AdvertisementShowRequest $request, AdvertisementService $service)
    {
        try {
            return $service->show($id, $request->getDto());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
