<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ColorCreateRequest",
 *     required={"name", "hex_code"},
 *     @OA\Property(property="name", type="array", @OA\Items(type="string", maxLength=255)),
 *     @OA\Property(property="hex_code", type="string", minLength=4)
 * )
 */
class ColorCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required' , 'array' , 'min:1'],
            'name.*' => ['required' , 'string' , 'max:255'],
            'hex_code' => ['required' , 'string' , 'min:4'],
        ];
    }
}
