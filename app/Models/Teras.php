<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_teras',
    ];

    // public function komponenTeras(){
    //     return $this->belongsTo('App\Models\KomponenTeras');
    // }

    // public function gangguan(){
    //     return $this->belongsTo('App\Models\Gangguan');
    // }
}
