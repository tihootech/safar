<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['country_name'];

    public function getCountryNameAttribute()
    {
        return $this->country->fa_name ?? '';
    }

    public function country()
    {
        return $this->belongsTo(Country::Class);
    }

    public function first_picture()
    {
        return $this->morphOne(Gallery::class, 'owner')->whereName('first_picture');
    }
}
