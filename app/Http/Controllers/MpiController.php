<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ScrController;

use App\Http\Controllers\GangguanController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Date;

use App\Models\Komponen;

use App\Models\Teras;

use App\Models\KomponenTeras;

use App\Models\SCR;

use App\Models\Gangguan;

use App\Models\Perbaikan;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class MpiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $komponens = Komponen::select('kode_komponen', 'nama_komponen')->orderBy('nama_komponen', 'asc')->get();
        $teras = Teras::select('id', 'nama_teras')->orderBy('nama_teras', 'asc')->get();
        $komponen = $request->filter_komponen;
        $teras1 = $request->filter_teras1;
        $teras2 = $request->filter_teras2;

        if($komponen !== null && $teras1 !== '' && $teras2 !== ''){
            if ($request->ajax()) {
                DB::statement(DB::raw('set @rownum=0'));
            
                $data = Komponen::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'kode_komponen',
                    'nama_komponen'
                ])
                ->whereIn('kode_komponen', $komponen)
                ->get();

                return DataTables::of($data)
                ->addColumn('ocr', function($key){
                
                    $kode_komponen = $key->kode_komponen;
                    $ocr = MpiController::ocr($kode_komponen);
                    return $ocr;
                })
                ->addColumn('ocr1', function($key){
                
                    $kode_komponen = $key->kode_komponen;
                    $ocr1 = MpiController::ocr1($kode_komponen);
                    
                    return $ocr1;
                })
                ->addColumn('scr', function($key){
                
                    $data = $key->kode_komponen;
                    $scr = MpiController::scr($data);

                    return $scr;
                })
                ->addColumn('acr', function($key){

                    $kode_komponen = $key->kode_komponen;
                    $acr = MpiController::acr($kode_komponen);

                    return $acr;
                })
                ->addColumn('freq', function($key){
                
                    $kode_komponen = $key->kode_komponen;
                    $afpf = MpiController::freq($kode_komponen);

                    return $afpf;
                })
                ->addColumn('freq%', function($key){
                    
                    $kode_komponen = $key->kode_komponen;

                    $afpf = MpiController::freqPersen($kode_komponen);

                    return $afpf;
                })
                ->addColumn('afpf', function($key){
                
                    $kode_komponen = $key->kode_komponen;
                    $afpf = MpiController::afpf($kode_komponen);

                    return $afpf;
                })
                ->addColumn('mpi', function($key){
                
                    $kode_komponen = $key->kode_komponen;
                    $acr = MpiController::mpi($kode_komponen);
                    
                    return $acr;
                })
                ->addColumn('kategori', function($key){
                    
                    $kode_komponen = $key->kode_komponen;
                    $kategori = MpiController::kategori($kode_komponen);

                        return $kategori;
                })
                ->make(true);
            }
        }
        
        if($komponen !== null && $teras1 !== '' && $teras2 !== ''){
            
            // Grafik
            $data = Komponen::select('kode_komponen', 'nama_komponen')->whereIn('kode_komponen', $komponen)->get();
            
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
        }
        else{
            $year = '';
            $user = '';
        }

        return view('mpi.mpi', ['komponens' => $komponens], ['teras' => $teras])
        ->with('year', json_encode($year))->with('user', json_encode($user));

    }


    public static function ocr($kode_komponen)
    {
        $data = Perbaikan::select(DB::raw('sum(DATEDIFF(perbaikans.tanggal_perbaikan, gangguans.tanggal_gangguan)) as total_gangguan'))
        ->join('gangguans', 'perbaikans.id', '=', 'gangguans.id_perbaikan')
        ->where('gangguans.kode_komponen', $kode_komponen)
        ->get();
                        
        foreach($data as $row){
            $ocr = $row->total_gangguan;
        }
        
        if($ocr !== null){
            return $ocr;
        }
        else{
            return '-';
        }
        
    }

    public static function ocr1($id_komponen_teras)
    {
        $ocr1 = MpiController::ocr($id_komponen_teras);

        if($ocr1 == '-'){
            return '-';
        }
        elseif($ocr1 < 10){
            return '1';
        }
        elseif($ocr1 >= 10 && $ocr1 <= 20){
            return '2';
        }
        elseif($ocr1 > 20 && $ocr1 <= 40){
            return '3';
        }
        elseif($ocr1 > 40 && $ocr1 <= 60){
            return '4';
        }
        elseif($ocr1 > 60 && $ocr1 <= 80){
            return '5';
        }
        elseif($ocr1 > 80 && $ocr1 <= 100){
            return '6';
        }
        elseif($ocr1 > 100 && $ocr1 <= 120){
            return '7';
        }
        elseif($ocr1 > 120 && $ocr1 <= 140){
            return '8';
        }
        elseif($ocr1 > 140 && $ocr1 <= 160){
            return '9';
        }
        elseif($ocr1 > 160){
            return '10';
        }
        elseif($ocr1 > 160){
            return '10';
        }
    }

    public static function scr($kode_komponen)
    {
        $scr = SCR::select('sc', 'qc', 'oc', 'pt')->where('kode_komponen', $kode_komponen)->first();

        if($scr['sc'] !== null && $scr['qc'] !== null && $scr['oc'] !== null && $scr['pt'] !== null){
            
            $sc = $scr['sc'];
            $qc = $scr['qc'];

            $nilai_pt = $scr['pt'];
            $pt = ScrController::convert_pt($nilai_pt);

            $nilai_oc = $scr['oc'];
            $oc = ScrController::convert_oc($nilai_oc);

            $sf = $sc+$qc;

            $hitung = 0.3*pow($oc,2)+0.5*$pt+0.2*pow($sf,2);
            $hitung_akar = sqrt($hitung);

            return number_format($hitung_akar, 5, ",",".");
        }
        else{
            return '-';
        }
    }

    public static function acr($kode_komponen)
    {

        $ocr1 = MpiController::ocr1($kode_komponen);
        $scr = MpiController::scr($kode_komponen);

        $convert_scr = str_replace(",", ".", $scr);

        if($ocr1 !== '-' && $scr !== '-'){

            $acr = $ocr1*$convert_scr;
        
            return number_format($acr, 2, ",",".");
        }
        else{
            return '-';
        }
    }

    public static function freq($kode_komponen)
    {
        $komponen = DB::table('gangguans')
                    ->select(
                        DB::raw('count(gangguans.kode_komponen) as total_gangguan')
                    )
                    ->where('kode_komponen', $kode_komponen)
                    ->get();

        $freq = $komponen[0]->total_gangguan;

        if($freq !== 0){

            return $freq;
        }
        else{
            return '-';
        }
        
    }

    public static function freqPersen($kode_komponen)
    {
        $komponen = $_GET['filter_komponen'];
        $teras1 = $_GET['filter_teras1'];
        $teras2 = $_GET['filter_teras2'];
        $freq = MpiController::freq($kode_komponen);

        $total_freq = Gangguan::select('gangguans.id', 'teras.nama_teras')
        ->join('teras', 'gangguans.id_teras', '=', 'teras.id')
        ->whereIn('gangguans.kode_komponen', $komponen)
        ->whereBetween('teras.nama_teras', [$teras1, $teras2])
        ->pluck('id')
        ->count();

        if($freq !== '-' && $total_freq !== ''){
            
            $freqPersen = $freq/$total_freq*100;

            return number_format($freqPersen, 2, ",",".");
        }
        else{
            return '-';
        }

    }

    public static function afpf($kode_komponen)
    {
        $afpf = MpiController::freqPersen($kode_komponen);

        $convert_afpf = str_replace(",", ".", $afpf);
        
        if($convert_afpf == '-'){
            return '-';
        }
        elseif($convert_afpf <= 0.1){
            return 1;
        }
        elseif($convert_afpf > 0.1 && $convert_afpf <= 1){
            return 2;
        }
        elseif($convert_afpf > 1 && $convert_afpf <= 10){
            return 3;
        }
        elseif($convert_afpf > 10 && $convert_afpf <= 50){
            return 4;
        }
        elseif($convert_afpf > 50){
            return 5;
        }

    }

    public static function mpi($kode_komponen)
    {
        $acr = MpiController::acr($kode_komponen);
        $afpf = MpiController::afpf($kode_komponen);
        
        $convert_acr = str_replace(",", ".", $acr);

        if($acr !== '-' && $afpf !== '-'){
            $mpi = $convert_acr*$afpf;

            return number_format($mpi, 2, ",",".");
        }
        else{
            return '-';
        }

    }

    public static function kategori($kode_komponen)
    {
        $kategori = MpiController::mpi($kode_komponen);

        if($kategori == '-'){
            return '-';
        }
        elseif($kategori > 100){
            return 'Sangat Tinggi';
        }
        elseif($kategori > 50 & $kategori <= 100){
            return 'Tinggi';
        }
        elseif($kategori > 20 & $kategori <= 50){
            return 'Sedang';
        }
        elseif($kategori < 20 ){
            return 'Rendah';
        }
        
    }

}
