<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'hex_code'
    ];

    protected $casts = [
        'name' => 'array',
        'hex_code' => 'string',
    ];
}
