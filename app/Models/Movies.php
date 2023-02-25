<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'avbook_avmoo_movie';

    public $timestamps = false;

    public function series_name()
    {
        return $this->hasOne(\App\Models\Series::class, 'code_36', 'Series');
    }

    public function director_name()
    {
        return $this->hasOne(\App\Models\Director::class, 'code_36', 'Director');
    }

    public function studio_name()
    {
        return $this->hasOne(\App\Models\Studio::class, 'code_36', 'Studio');
    }

    public function label_name()
    {
        return $this->hasOne(\App\Models\Label::class, 'code_36', 'Label');
    }

    public function javlib()
    {
        return $this->hasOne(\App\Models\Javlibrary::class, 'censored_id', 'censored_id');
    }
}
