<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gangguan extends Model
{
    use HasFactory;

    // public function komponens(){
    //     return $this->belongsTo('App\Models\KomponenTeras', 'id_komponen_teras' );
    // }
    
    // public function perbaikans(){
    //     return $this->belongsTo('App\Models\Perbaikan', 'id_perbaikan');
    // }

    // public function scr(){
    //     return $this->belongsTo('App\Models\SCR', 'scr');
    // }

    protected $fillable = [
        'kode_komponen',
        'id_teras',
        'tanggal_gangguan',
        'desc',
        'id_perbaikan',
        'status',
    ];

    public function teras(){
        return $this->belongsTo('App\Models\Teras', 'id_teras');
    }

    public function komponens(){
        return $this->belongsTo('App\Models\Komponen', 'kode_komponen');
    }

    public function perbaikans(){
        return $this->belongsTo('App\Models\Perbaikan', 'id_perbaikan');
    }
}
