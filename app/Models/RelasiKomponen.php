<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelasiKomponen extends Model
{
    use HasFactory;

    protected $table = 'relasi_komponen';

    public function komponen(){

        return $this->belongsTo('App\Models\Komponen');

    }
}
