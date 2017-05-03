<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public static $rules = [
        'title' => 'required',
        'body' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['title', 'body', 'thumbnail'];
}
