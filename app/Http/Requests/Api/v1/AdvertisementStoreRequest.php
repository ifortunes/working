<?php

namespace App\Http\Requests\Api\v1;

use App\DTO\Api\v1\AdvertisementStoreDTO;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisementStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:200',
            'description' => 'required|max:1000',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'string|active_url|url',
            'price' => 'required|integer',
        ];
    }

    public function getDto(): AdvertisementStoreDTO
    {
        return new AdvertisementStoreDTO(
            $this->get('name'),
            $this->get('description'),
            $this->get('images'),
            $this->get('price'));
    }
}
