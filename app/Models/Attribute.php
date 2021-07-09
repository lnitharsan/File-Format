<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    

    /**
     * Attributes
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
