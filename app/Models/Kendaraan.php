<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = 'tbl_kendaraan';

    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga', 'mobil_id', 'motor_id'
    ];

    public function mobil()
    {
        return $this->hasMany(Mobil::class);
    }

    public function motor()
    {
        return $this->hasMany(Motor::class);
    }
}
