<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_komponen';

    // public $incrementing = false;

    protected $fillable = [
        'kode_komponen',
        'nama_komponen',
        'scr',
    ];
    
    public function gangguans(){
        return $this->belongsToMany('App\Models\Gangguan');
    }
    public function scr(){
        return $this->belongsToMany('App\Models\SCR');
    }

    public function relasi(){

        return $this->belongsTo('App\Models\RelasiKomponen', 'komponen');

    }

    // public function scr(){
    //     return $this->belongsTo('App\Models\SCR');
    // }
    
}
