<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SCR;

use App\Models\Komponen;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class ScrController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
        
            DB::statement(DB::raw('set @rownum=0'));

            $data = SCR::with('komponens')
            ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'kode_komponen', 'sc', 'qc', 'pt', 'oc')
            ->get();
            
            return DataTables::of($data)
            
            ->addColumn('nama_komponen', function(SCR $scr){
                return $scr->komponens->nama_komponen;
            })
            ->addColumn('sc1', function($data){
                if($data->sc = $data->sc){
                    return $data->sc;
                }
                else{
                    return '-';
                }
            })
            
            ->addColumn('qc1', function($data){
                if($data->qc = $data->qc){
                    return $data->qc;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('sf', function($data){
                if($data->qc = $data->qc & $data->sc = $data->sc){
                    $sc = $data->sc;
                    $qc = $data->qc;
                    $sf = $sc+$qc;
                    return $sf;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('oc1', function($data){
                if($data->oc = $data->oc){
                    return $data->oc;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('pt1', function($data){
                if($data->pt = $data->pt){
                    return $data->pt;
                }
                else{
                    return '-';
                }
            })
            
            ->addColumn('scr', function($data){
            
                $id = $data->id;
                $data_scr = ScrController::hitungScr($id);
                return $data_scr;
            })
            ->addColumn('action', function($data){
                // if($data->sc == $data->sc && $data->qc == $data->qc && $data->pt == $data->pt && $data->oc == $data->oc){
                    
                // $id = $data->id;
                // $scr = ScrController::hitungScr($id);

                // return $scr;

                // if($scr == '-'){
                    $btn = '<a href="scr/'.$data->id.'/edit" class="btn btn-dark text-white" title="Ubah data"><i class="fa fa-edit"></i></a>';
                    return $btn;
                // }
                // else{
                //     return $scr;
                // }

                // $a = $data->qc;
                // return $a;
            })
            ->rawColumns(['sc1', 'qc1', 'oc1', 'pt1', 'action'])
            ->make(true);
        }

        return view('mpi.scr');
    }


    public static function hitungScr($id)
    {
        $scr = SCR::select('sc', 'qc', 'oc', 'pt')->where('id', $id)->get();

        if($scr[0]->sc !== null && $scr[0]->qc !== null && $scr[0]->oc !== null && $scr[0]->pt !== null){
            
            $sc = $scr[0]->sc;
            $qc = $scr[0]->qc;

            $nilai_pt = $scr[0]->pt;
            $pt = ScrController::convert_pt($nilai_pt);

            $nilai_oc = $scr[0]->oc;
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
    
    public static function convert_pt($data)
    {
        if($data == 0){
            $pt = 1;
        }
        elseif($data >= 1 && $data <= 7){
            $pt = 2;
        }
        elseif($data > 7 && $data <= 15){
            $pt = 3;
        }
        elseif($data > 15 && $data <= 30){
            $pt = 4;
        }
        elseif($data > 30){
            $pt = 5;
        }

        return $pt;
    }
    
    public static function convert_oc($data)
    {
        if($data > 100000000 && $data <= 200000000){
            $oc = '5';
        }
        elseif($data > 50000000 && $data <= 100000000){
            $oc = '4';
        }
        elseif($data > 10000000 && $data <= 50000000){
            $oc = '3';
        }
        elseif($data >= 1000000 && $data <= 10000000){
            $oc = '2';
        }
        elseif($data < 1000000){
            $oc = '1';
        }

        return $oc;
    }

    public function create()
    {
        $komponens = Komponen::select('kode_komponen', 'nama_komponen')->get();

        return view('mpi.input-scr', ['komponens' => $komponens]);
    }

    

    public function store(Request $request)
    {   

        // $rules = \Validator::make($request->all(),[
        //     "kode_komponen" => "required|unique:komponens,kode_komponen",
        // ])->validate();

        SCR::create([
                'kode_komponen' => $request->kode_komponen,
                'sc' => $request->sc,
                'qc' => $request->qc,
                'oc' => $request->oc,
                'pt' => $request->pt
            ]);

        
        $id_scr = DB::table('scr');
        $id_scr = DB::getPDO()->lastInsertId();
        
        Komponen::where('kode_komponen', $request->get('kode_komponen'))
        ->update([
            'scr' => $id_scr
        ]);

        return redirect()->route('scr.index')->with('success' , 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $komponens = Komponen::select('kode_komponen', 'nama_komponen')->get();
        $scr = SCR::findOrFail($id);

        return view('mpi.edit-scr', ['scr' => $scr], ['komponens' => $komponens]);
        
    }

    public function update(Request $request, $id)
    {
        $scr = SCR::findOrFail($id);

        $scr->kode_komponen = $request->get('kode_komponen');
        $scr->sc = $request->get('sc');
        $scr->qc = $request->get('qc');
        $scr->oc = $request->get('oc');
        $scr->pt = $request->get('pt');
        $scr->save();

        return redirect()->route('scr.index')->with('success' , 'Data berhasil diubah');;
    }

    public function destroy($id)
    {
        //
    }

}
