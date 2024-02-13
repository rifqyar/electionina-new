<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaModel extends Model
{
    public $timestamps = false;
    protected $table = 'desa';
    protected $guarded = [];
    
    use HasFactory;
}
