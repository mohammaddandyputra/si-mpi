<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MpiController;

use App\Models\Komponen;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $data = Komponen::select(
            'kode_komponen', 'nama_komponen',
                )
                ->get();

        $komponen = json_decode($data);

        foreach($komponen as $value){
            $kode_komponen[] = $value->kode_komponen;
        }
        
        $count = count($data);

        for($i = 0; $i < $count; $i++){
            $hasil = MpiController::mpi($kode_komponen[$i]);
            
            if($hasil !== '-'){
                
                $user[] = str_replace(",", ".", $hasil);
            }
            else{
                $user[] = '';
            }
        }

        $year = [];

        foreach($data as $data){
            $year[] = $data->nama_komponen;  
        }
        
        return view('grafik.index')->with('year',json_encode($year))->with('user',json_encode($user));
    }
}
