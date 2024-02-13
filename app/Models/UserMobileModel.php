<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMobileModel extends Model
{
    public $timestamps = false;
    protected $table = 'usermobile';
    protected $guarded = [];
    use HasFactory;
}
    

