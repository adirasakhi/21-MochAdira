<?php

// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $fillable = [
        'brand', 'model', 'rental_rate', 'availability', 'description', 'image', 'slug', 'advantages'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($car) {
            $car->slug = Str::slug($car->model . '-' . Str::random(6), '-');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getAdvantagesAttribute($value)
    {
        return $value ? explode(', ', $value) : [];
    }

    public function setAdvantagesAttribute($value)
    {
        $this->attributes['advantages'] = is_array($value) ? implode(', ', $value) : $value;
    }
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
