<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name, description'];

    public $rules =
        [
            'name'        => 'required|min:3|max:100',
            'description' => 'required|min:3|max:500',
        ];
}
