<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculateModel extends Model
{
    public $timestamps = false;
    protected $table = 'calculate';
    protected $guarded = [];
    use HasFactory;
}
