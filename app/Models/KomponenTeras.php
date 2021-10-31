<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenTeras extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_teras',
        'kode_komponen',
    ];

    public function gangguans(){
        return $this->belongsToMany('App\Models\Gangguan', 'id_komponen_teras');
    }
    
    public function komponens(){
        return $this->belongsTo('App\Models\Komponen', 'kode_komponen');
    }
    
    public function teras(){
        return $this->belongsTo('App\Models\Komponen', 'id_teras');
    }
}
