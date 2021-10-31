<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    // public $timestamps = FALSE;
    
    protected $fillable = [
        'id_gangguan',
        'id_komponen_teras',
        'tanggal_perbaikan',
        'tindakan',
    ];
    
    public function gangguans(){
        return $this->belongsTo('App\Models\Gangguan');
    }

}
