<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Javlibrary extends Model
{
    protected $table = 'avbook_javlib_movie';
    public $timestamps = false;
    public function avmoo_info()
    {
        return $this->hasOne('App\Models\Avbooks','censored_id','censored_id');
    }
}
