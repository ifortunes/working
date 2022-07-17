<?php

namespace App\Services\Api\v1;

use Illuminate\Support\Arr;

class ApiService
{
    public function checkAllowedFields(string|null $queries)
    {
        $allowed = [
            'description', 'images'
        ];

        $fields = explode(',', $queries);

        $array = [];
        foreach ($fields as $field) {

            $trim = trim($field);

            if (in_array($trim, $allowed)) {
                $array[] = $trim;
            }
        }

        return Arr::collapse([['name', 'image', 'price'], $array]);
    }
}
