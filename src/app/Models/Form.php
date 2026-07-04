<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['city_id', 'latitude', 'length', 'image'];

    public function city()
    {
        /**
         * Define una relación inversa de uno a muchos con el modelo City. Esto significa que un formulario pertenece a una ciudad específica.
         */
        return $this->belongsTo(City::class);
    }
}