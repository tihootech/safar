<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function first_picture()
    {
        return $this->morphOne(Gallery::class, 'owner')->whereName('first_picture');
    }

    public function logo()
    {
        return $this->morphOne(Gallery::class, 'owner')->whereName('logo');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
