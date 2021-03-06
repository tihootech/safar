<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function visas()
    {
        return $this->hasMany(Visa::class)->with('first_picture');
    }

    public function gallery()
    {
        return $this->morphMany(Gallery::class, 'owner');
    }

}
