<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'avbook_avmoo_movie';
    public $timestamps = false;

    public function series_name()
    {
        return $this->hasOne('App\Models\Series','code_36','Series');
    }
    public function director_name()
    {
        return $this->hasOne('App\Models\Director','code_36','Director');
    }
    public function studio_name()
    {
        return $this->hasOne('App\Models\Studio','code_36','Studio');
    }
    public function label_name()
    {
        return $this->hasOne('App\Models\Label','code_36','Label');
    }

}
