<?php

namespace App\Http\Requests\Api\v1;

use App\DTO\Api\v1\AdvertisementIndexDTO;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisementIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asc' => 'nullable|string|max:50',
            'desc' => 'nullable|string|max:50',
            'page' => 'integer'
        ];
    }

    public function getDto(): AdvertisementIndexDTO
    {
        return new AdvertisementIndexDTO(
            $this->get('asc') ?? '',
            $this->get('desc') ?? '',
            $this->get('page') ?? 1,
        );
    }
}
