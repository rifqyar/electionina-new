<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpsModel extends Model
{
    public $timestamps = false;
    protected $table = 'tps';
    protected $guarded = [];
    use HasFactory;
}
