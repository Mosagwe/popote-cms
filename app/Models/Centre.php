<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;
    // protected $table ='centres';
    // protected $fillable =['id','code','name','status'];
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','service_center');
    }
}
