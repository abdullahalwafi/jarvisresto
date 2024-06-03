<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenResto extends Model
{
    use HasFactory;

    protected $table = 'open_resto';
    protected $fillable = ['is_open'];

    public $timestamps = false;
    
}
