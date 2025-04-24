<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="ColorUpdateRequest",
 *     required={"name", "hex_code"},
 *     @OA\Property(property="name", type="array", @OA\Items(type="string", maxLength=255)),
 *     @OA\Property(property="hex_code", type="string", minLength=4)
 * )
 */
class ColorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes' , 'array' , 'min:1'],
            'name.*' => ['required' , 'string' , 'max:255'],
            'hex_code' => ['sometimes' , 'string' , 'min:4'],
        ];
    }
}
