<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function mda()
    {
        return $this->belongsTo('App\Models\Mda');
    }

    public function centres()
    {
        return $this->belongsToMany('App\Models\Centre', 'service_center');
    }
}
