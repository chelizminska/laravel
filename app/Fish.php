<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    protected $fillable = array('title', 'href', 'content');
    public $timestamps = false;
    public $table = 'fishes';
}
