<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'content', 'href', 'is_sheet', 'parent_id', 'is_protected', 'child_amount'];
    public $timestamps = false;
}
