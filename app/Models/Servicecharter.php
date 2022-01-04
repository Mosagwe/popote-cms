<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicecharter extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function scinstitution()
    {
        return $this->belongsTo(Scinstitution::class);
    }
}
