<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = array('title', 'content', 'href', 'is_sheet', 'parent_id', 'is_protected');
    public $timestamps = false;
}
