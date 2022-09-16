<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodity extends Model
{
    use HasFactory;
    public $table='comodities';
    protected $guarded = ['id'];
}
