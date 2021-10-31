<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Facade;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Date;

use Illuminate\Support\Str;

use App\Models\Gangguan;

use App\Models\Komponen;

use App\Models\Perbaikan;

use App\Models\Teras;

use Carbon\Carbon;

use Yajra\DataTables\DataTables;


class GangguanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $komponens = Komponen::select('kode_komponen', 'nama_komponen')->get();
        $teras = Teras::select('id', 'nama_teras')->get();

        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            
            $data = Gangguan::with('komponens')
                            ->with('teras')
                            ->with('perbaikans')
                            ->select(
                                DB::raw('@rownum  := @rownum  + 1 AS rownum'), 
                                'id', 
                                'id_teras', 
                                'kode_komponen', 
                                'tanggal_gangguan', 
                                'desc', 
                                'id_perbaikan',
                                'status'
                            )
                            ->orderBy('tanggal_gangguan', 'asc')
                            ->get();
                                
                    return DataTables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('status'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['status'], $request->get('status')) ? true : false;
                            });
                        }
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="row">
                                    <div class="col-md-6">
                                        <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="edit" title="Ubah"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="delete" id="delete" title="Hapus" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>';

                        return $btn;
                    })
                    ->addColumn('nama_teras', function(Gangguan $gangguan){
                        return $gangguan->teras->nama_teras;
                    })
                    ->addColumn('nama_komponen', function(Gangguan $gangguan){
                        return $gangguan->komponens->nama_komponen;
                    })
                    ->addColumn('tanggal_perbaikan', function($data){
                        $perbaikan = Perbaikan::select('tanggal_perbaikan')
                                    ->where('id', $data->id_perbaikan)
                                    ->get();
                        
                        $tanggal_perbaikan = '';
                        
                        foreach($perbaikan as $data){
                            $tanggal_perbaikan = $data->tanggal_perbaikan;
                        }
                        
                        return $tanggal_perbaikan ? with(new Carbon($tanggal_perbaikan))->isoFormat('D MMMM Y') : '';
                    })
                    ->addColumn('tindakan', function($data){
                        $perbaikan = Perbaikan::select('tindakan')
                                    ->where('id', $data->id_perbaikan)
                                    ->get();
                        
                        $tindakan = '';
                        
                        foreach($perbaikan as $data){
                            $tindakan = $data->tindakan;
                        }
                        return $tindakan;
                    })
                    ->editColumn('tanggal_gangguan', function ($data) {
                        return $data->tanggal_gangguan ? with(new Carbon($data->tanggal_gangguan))->isoFormat('D MMMM Y') : '';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('masters.gangguan', ['teras' => $teras], ['komponens' => $komponens]);
    }

    public function historyGangguanTeras(Request $request)
    {
        if ($request->ajax()) {
            
            DB::statement(DB::raw('set @rownum=0'));
            $data = Teras::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id', 'nama_teras');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_gangguan', function($data){
                
                $total_gangguan = Gangguan::select(DB::raw('count(gangguans.kode_komponen) as total_gangguan'))
                ->join('komponens', 'gangguans.kode_komponen', '=', 'komponens.kode_komponen')
                ->join('teras', 'gangguans.id_teras', '=', 'teras.id')
                ->where('gangguans.id_teras', $data->id)
                ->first();

                return $total_gangguan['total_gangguan'];
            })
            ->addColumn('action', function($row){
                
                $btn = '<a href="teras/'.$row->id.'/komponen" class="btn btn-dark text-white" data-id="'.$row->id.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('history.teras');
    }

    public function historyGangguanTerasKomponen(Request $request, $id_teras)
    {
        $teras = Teras::select('nama_teras')->where('id', $id_teras)->first();

        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            
            $data = DB::table('gangguans')
            ->select(
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                DB::raw('count(gangguans.kode_komponen) as total_gangguan'),
                'gangguans.kode_komponen',
                'komponens.nama_komponen',
                'gangguans.id_teras'
            )
            ->join('komponens', 'gangguans.kode_komponen', '=', 'komponens.kode_komponen')
            ->join('teras', 'gangguans.id_teras', '=', 'teras.id')
            ->where('gangguans.id_teras', $id_teras)
            ->groupBy('gangguans.kode_komponen')
            ->groupBy('komponens.nama_komponen')
            ->groupBy('gangguans.id_teras')
            ->get();

            return Datatables::of($data)
            ->addColumn('action', function($row){
                   $btn = '<a href="komponen/'.$row->kode_komponen.'" class="btn btn-dark text-white" data-id="'.$row->kode_komponen.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('history.teras-komponen', ['teras' => $teras]);
    }

    public function historyGangguanTerasKomponenDetail(Request $request, $id_teras, $kode_komponen)
    {
        $teras = Teras::select('nama_teras')->where('id', $id_teras)->first();

        $komponen = Komponen::select('nama_komponen')->where('kode_komponen', $kode_komponen)->first();

        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));

            $gangguan = Gangguan::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                        'id', 'kode_komponen', 'tanggal_gangguan', 'desc', 'id_perbaikan')
            ->where('kode_komponen', $kode_komponen)
            ->where('id_teras', $id_teras)
            ->get();
            return Datatables::of($gangguan)
            ->addColumn('tanggal_perbaikan', function(Gangguan $gangguan){
                if($gangguan->id_perbaikan = $gangguan->id_perbaikan){
                    $perbaikan = DB::table('perbaikans')->select('tanggal_perbaikan')->where('id', '=', $gangguan->id_perbaikan)->get();
                    $data = json_decode($perbaikan);

                    return $data[0]->tanggal_perbaikan;
                }
                else{
                    return '-';
                }
            })

            ->addColumn('tindakan', function (Gangguan $gangguan) {
                if($gangguan->id_perbaikan = $gangguan->id_perbaikan){
                        $perbaikan = DB::table('perbaikans')->select('tindakan')->where('id', '=', $gangguan->id_perbaikan)->get();
                        $data = json_decode($perbaikan);

                        return $data[0]->tindakan;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('ttr', function ($gangguan) {
                if($gangguan->id_perbaikan !== null){
                    $data_gangguan = Gangguan::select('tanggal_gangguan')
                    ->where('id', $gangguan->id)
                    ->get();

                $data_perbaikan = DB::table('gangguans')
                    ->select('perbaikans.tanggal_perbaikan')
                    ->join('perbaikans', 'gangguans.id_perbaikan', '=', 'perbaikans.id')
                    ->where('perbaikans.id', $gangguan->id_perbaikan)
                    ->get();

                $a ='';
                $b ='';
                
                foreach($data_gangguan as $row){
                    $a = $row->tanggal_gangguan;
                }
                
                foreach($data_perbaikan as $row){
                    $b = $row->tanggal_perbaikan;
                }

                $date1 = Date::parse($a);
                $date2 = Date::parse($b);
                
                $selisih_data = $date1->diffInDays($date2);
                
                return "$selisih_data hari";
                }
                else{
                    return '-';
                }
                
            })
                    ->addColumn('action', function($row){
     
                        $btn = '<a href="komponen/'.$row->id.'" class="btn btn-dark text-white" data-id="'.$row->id.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('history.teras-komponen-detail', ['teras' => $teras], ['komponen' => $komponen]);
    }


    public function historyGangguanKomponen(Request $request)
    {
        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));

            $data = Komponen::select(
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'kode_komponen',
                'nama_komponen',
            )
            ->orderBy('nama_komponen', 'asc')
            ->get();

            return Datatables::of($data)
            ->addColumn('total_gangguan', function($data){
                
                $total_gangguan = Gangguan::select(DB::raw('count(gangguans.kode_komponen) as total_gangguan'))
                ->join('komponens', 'gangguans.kode_komponen', '=', 'komponens.kode_komponen')
                ->where('gangguans.kode_komponen', $data->kode_komponen)
                ->first();

                return $total_gangguan['total_gangguan'];
            })
            ->addColumn('ttr', function ($data) {
                    
                $kode_komponen = $data->kode_komponen;
                
                $data_ttr = Perbaikan::select(DB::raw('sum(DATEDIFF(perbaikans.tanggal_perbaikan, gangguans.tanggal_gangguan)) as total_gangguan'))
                ->join('gangguans', 'perbaikans.id', '=', 'gangguans.id_perbaikan')
                ->where('gangguans.kode_komponen', $kode_komponen)
                ->get();
                
                                
                foreach($data_ttr as $row){
                    $ttr = $row->total_gangguan;
                }
                
                if($ttr !== null){
                    return $ttr;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('action', function($row){
                   $btn = '<a href="komponen/'.$row->kode_komponen.'" class="btn btn-dark text-white" data-id="'.$row->kode_komponen.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('history.komponen');
    }

    public function historyGangguanKomponenDetail(Request $request, $kode_komponen)
    {

        $komponen = Komponen::select('nama_komponen')->where('kode_komponen', $kode_komponen)->first();

        $ttr = Perbaikan::select(DB::raw('sum(DATEDIFF(perbaikans.tanggal_perbaikan, gangguans.tanggal_gangguan)) as total_gangguan'))
        ->join('gangguans', 'perbaikans.id', '=', 'gangguans.id_perbaikan')
        ->where('gangguans.kode_komponen', $kode_komponen)
        ->first();

        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));

            $gangguan = Gangguan::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                        'id', 'kode_komponen', 'id_teras', 'tanggal_gangguan', 'desc', 'id_perbaikan')
            ->where('kode_komponen', $kode_komponen)
            ->get();
            
            return Datatables::of($gangguan)
            ->addColumn('teras', function($row){

                $teras[] = Teras::select('nama_teras')->where('id', $row->id_teras)->pluck('nama_teras');
                
                return $teras;
            })
            ->addColumn('tanggal_perbaikan', function($row){
                if($row->id_perbaikan = $row->id_perbaikan){
                    $perbaikan = DB::table('perbaikans')->select('tanggal_perbaikan')->where('id', '=', $row->id_perbaikan)->get();
                    $data = json_decode($perbaikan);

                    return $data[0]->tanggal_perbaikan;
                }
                else{
                    return '-';
                }
            })

            ->addColumn('tindakan', function ($row) {
                if($row->id_perbaikan = $row->id_perbaikan){
                        $perbaikan = DB::table('perbaikans')->select('tindakan')->where('id', '=', $row->id_perbaikan)->get();
                        $data = json_decode($perbaikan);

                        return $data[0]->tindakan;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('ttr', function ($row) {
                if($row->id_perbaikan !== null){
                    $data_gangguan = Gangguan::select('tanggal_gangguan')
                    ->where('id', $row->id)
                    ->get();

                $data_perbaikan = DB::table('gangguans')
                    ->select('perbaikans.tanggal_perbaikan')
                    ->join('perbaikans', 'gangguans.id_perbaikan', '=', 'perbaikans.id')
                    ->where('perbaikans.id', $row->id_perbaikan)
                    ->get();

                $a ='';
                $b ='';
                
                foreach($data_gangguan as $row){
                    $a = $row->tanggal_gangguan;
                }
                
                foreach($data_perbaikan as $row){
                    $b = $row->tanggal_perbaikan;
                }

                $date1 = Date::parse($a);
                $date2 = Date::parse($b);
                
                $selisih_data = $date1->diffInDays($date2);
                
                return "$selisih_data hari";
                }
                else{
                    return '-';
                }
                
            })
            ->addColumn('action', function($row){
                
                $btn = '<a href="komponen/'.$row->id.'" class="btn btn-dark text-white" data-id="'.$row->id.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('history.komponen-detail', ['komponen' => $komponen], ['ttr' => $ttr]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'kode_komponen' => 'required',
            'id_teras' => 'required',
            'tanggal_gangguan' => 'required',
            'desc' => 'required',
        ], ['kode_komponen.required' => 'Komponen tidak terisi!',
            'id_teras.required' => 'Teras tidak terisi!',
            'tanggal_gangguan.required' => 'Tanggal gangguan tidak terisi!',
            'desc.required' => 'Deskripsi gangguan tidak terisi!',
        ]);
    
        $id_gangguan = $request->get('id');

        $gangguan = Gangguan::find($id_gangguan);
        
        if ($validator->passes()) {
            if(empty($gangguan)){
                Gangguan::insert([
                    'kode_komponen' => $request->kode_komponen,
                    'id_teras' => $request->id_teras,
                    'tanggal_gangguan' => $request->tanggal_gangguan,
                    'desc' => $request->desc,
                    'status' => 'TIDAK'
                ]);

                return response()->json(['success' => 'Data berhasil diinput']);
            }
            else{
                Gangguan::where('id', $id_gangguan)
                ->update([
                    'kode_komponen' => $request->kode_komponen,
                    'id_teras' => $request->id_teras,
                    'tanggal_gangguan' => $request->tanggal_gangguan,
                    'desc' => $request->desc
                ]);

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $gangguan = Gangguan::where('id', $id)->first();

        return response()->json($gangguan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gangguan = Gangguan::find($id);
        $gangguan->delete();

        return response()->json(['success'=>'Data berhasil dihapus']);
    }

}
