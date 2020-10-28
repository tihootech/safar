<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function make($receptor, $body)
    {
        return self::create(compact('receptor', 'body'));
    }
}
