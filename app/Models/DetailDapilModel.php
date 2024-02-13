<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDapilModel extends Model
{
    public $timestamps = false;
    protected $table = 'detail_dapil';
    protected $guarded = [];
    use HasFactory;
}
