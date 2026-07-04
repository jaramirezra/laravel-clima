<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function forms()
    {
        /**
         * Define una relación uno a muchos con el modelo Form. Esto significa que una ciudad puede tener múltiples formularios asociados.
         */
        return $this->hasMany(Form::class);
    }
}
