<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function role()
    {
        return $this->hasOne('App\Models\Kecamatan','id','kecamatan_id');
    }
}
