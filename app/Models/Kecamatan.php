<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function villages()
    {
        return $this->hasMany('App\Models\Village','kecamatan_id','id');
    }
}
