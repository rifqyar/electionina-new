<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    public $timestamps = true;
    protected $table = 'kecamatan';
    protected $guarded = [];
    use HasFactory;
}
