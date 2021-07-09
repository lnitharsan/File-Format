<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    use HasFactory;
    
    /**
     * Attributes of file
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * A file may be given various arrtibutes.
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(
            Attribute::class,
            'file_has_attribute',
            'file_id',
            'attribute_id'
        );
    }
}
