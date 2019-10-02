<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['ip', 'region', 'browser_name', 'browser_version', 'os'];
}
