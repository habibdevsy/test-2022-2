<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $appends = [
        'total_quantity',
        'image_path',
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class)->withPivot("amount");
    }

    public function getTotalQuantityAttribute()
    {
        $items = [];  
        foreach ($this->units()->get() as $unit) {
            $items[] =  $unit->modifier * $unit->pivot->amount;
         }
        return array_sum ($items);
    }

    public function getTotalQuantityByUnitAttribute($unit_id)
    {
        $items = [];  
        foreach ($this->units()->get() as $unit) {
            $items[] = $unit->modifier * $unit->pivot->amount;
        }
        Unit::where('id', "=", $unit_id)->get()->map(function ($required_unit) use ($items) {
          return $this->total_quantity_by_unit_id =  array_sum($items) / $required_unit->modifier;
        });
    }

    public function getImagePathAttribute()
    {
        $image = $this->imagePath();
        if($image->exists()) {
            return $image->first()->path;
        }
        return null;
    }

    public function imagePath()
    {
        return $this->hasOne(Image::class, 'o_id')->where('o_type','product');
    }
}
