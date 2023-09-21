<?php

namespace App\Models;

use App\Models\Table as ModelsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table = "tables";
    protected $fillable = ['name','status'];

    
}
