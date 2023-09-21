<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = "pesanan";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanan_details()
    {
        return $this->hasMany(PesananDetails::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    
}
