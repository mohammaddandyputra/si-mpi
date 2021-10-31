<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SCR extends Model
{
    use HasFactory;
    
    

    public $table = "scr";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode_komponen',
        'sc',
        'qc',
        'pt',
        'oc',
    ];

    public function komponens(){
        return $this->belongsTo('App\Models\Komponen', 'kode_komponen');
    }
}
