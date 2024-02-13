<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    public $timestamps = true;
    protected $table = 'imageupload';
    protected $guarded = [];
    use HasFactory;
}
