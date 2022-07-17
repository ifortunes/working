<?php

namespace App\Services\Api\v1;

use App\Models\Advertisement;
use Illuminate\Support\Str;

class SortService
{
    public function apply($queries)
    {
        if (!empty($queries)) {

            $query = Advertisement::query();

            foreach ($queries as $k => $item) {

                if (!empty($item)) {
                    $replaced = Str::replace(',', ' - ', $item);
                    $query->orderByRaw($replaced . ' ' . $k)->toSql();
                }

            }

            return $query;
        }
    }
}
