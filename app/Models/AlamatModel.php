<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatModel extends Model
{
    public $timestamps = true;
    protected $table = 'rtrw';
    protected $guarded = [];
    use HasFactory;
}
