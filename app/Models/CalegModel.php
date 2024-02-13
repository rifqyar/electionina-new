<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalegModel extends Model
{
    public $timestamps = true;
    protected $table = 'caleg';
    protected $guarded = [];
    use HasFactory;
}
