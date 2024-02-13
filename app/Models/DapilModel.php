<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DapilModel extends Model
{
    public $timestamps = true;
    protected $table = 'dapil';
    protected $guarded = [];
    use HasFactory;
}
