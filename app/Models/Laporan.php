<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function comodity()
    {
        return $this->hasOne('App\Models\Comodity','id','comodity_id');
    }
    
    public function village()
    {
        return $this->hasOne('App\Models\Village','id','desa_id');
    }
}
