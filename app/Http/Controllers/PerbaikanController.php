<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Facade;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use App\Models\Gangguan;

use App\Models\Perbaikan;

use Carbon\Carbon;

use Yajra\DataTables\DataTables;

class PerbaikanController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
        
            DB::statement(DB::raw('set @rownum=0'));

            $data = DB::table('gangguans')
            ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'gangguans.id', 'teras.nama_teras', 'komponens.nama_komponen', 'gangguans.tanggal_gangguan', 'gangguans.desc', 'gangguans.id_perbaikan', 'gangguans.status',
            )
            ->join('komponens', 'gangguans.kode_komponen', '=', 'komponens.kode_komponen')
            ->join('teras', 'gangguans.id_teras', '=', 'teras.id')
            ->get();
            
            return DataTables::of($data)
                ->editColumn('tanggal_gangguan', function ($data) {
                    return $data->tanggal_gangguan ? with(new Carbon($data->tanggal_gangguan))->isoFormat('D MMMM Y') : '';
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('status'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['status'], $request->get('status')) ? true : false;
                        });
                    }
                })
                ->editColumn('tanggal_gangguan', function ($data) {
                    return $data->tanggal_gangguan ? with(new Carbon($data->tanggal_gangguan))->isoFormat('D MMMM Y') : '';
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
                ->addColumn('action', function($row){
                    if($row->status == 'TIDAK'){
                    $btn = '<a href="perbaikan/'.$row->id.'" class="btn btn-dark text-white" data-id="'.$row->id.'" id="edit" title="Perbaiki"><i class="fa fa-wrench"></i></a>';
    
                    return $btn;
                    }
                    else{
                        $btn = '<a href="perbaikan/'.$row->id.'/edit" class="btn btn-dark text-white" data-id="'.$row->id.'" id="edit" title="Ubah"><i class="fa fa-edit"></i></a>';
                        
                        return $btn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        $filter = Gangguan::select('id_perbaikan')->first();

        return view('perbaikan.data', ['filter' => $filter]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Insert data ke Perbaikan + Update id_perbaikan dan status
    public function updateGangguan(Request $request, $kode_komponen)
    { 
        $validator = \Validator::make($request->all(),[
            'tanggal_perbaikan' => 'required',
            'tindakan' => 'required',
        ], [
            'tanggal_perbaikan.required' => 'Tanggal perbaikan tidak terisi!',
            'tindakan.required' => 'Tindakan gangguan tidak terisi!',
        ]);

        $gangguan = Gangguan::select('id_perbaikan')->where('id', $kode_komponen)->get();
        
        $id_perbaikan = '';
        foreach($gangguan as $data){
            $id_perbaikan = $data->id_perbaikan;
        }

        $perbaikan = Perbaikan::find($id_perbaikan);

        if ($validator->passes()) {
            if(empty($perbaikan)){
                Perbaikan::create([
                    'id' => $request->id,
                    'tanggal_perbaikan' => $request->tanggal_perbaikan,
                    'tindakan' => $request->tindakan
                ]);
                
                $id_perbaikan = DB::table('perbaikans');
                $id_perbaikan = DB::getPDO()->lastInsertId();
                
                Gangguan::where('id', $kode_komponen)
                ->update([
                    'id_perbaikan' => $id_perbaikan,
                    'status' => 'SELESAI'
                ]);

                return response()->json(['success' => 'Data berhasil diinput']);
            }
            else{
                Perbaikan::where('id', $id_perbaikan)
                ->update([
                    'tanggal_perbaikan' => $request->tanggal_perbaikan,
                    'tindakan' => $request->tindakan
                ]);

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);

        // if ($validator->passes()) {
        //     Perbaikan::create(['id' => $request->id,
        //         'tanggal_perbaikan' => $request->tanggal_perbaikan,
        //         'tindakan' => $request->tindakan]);

        
        //     $id_perbaikan = DB::table('perbaikans');
        //     $id_perbaikan = DB::getPDO()->lastInsertId();
            
        //     Gangguan::where('id', $kode_komponen)
        //     ->update([
        //         'id_perbaikan' => $id_perbaikan,
        //         'status' => 'SELESAI'
        //     ]);

        //     return response()->json(['success' => 'Berhasil']);
        // }

        // return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_gangguan)
    {

        $gangguan = Gangguan::select('teras.nama_teras', 'komponens.nama_komponen', 'gangguans.id', 'gangguans.tanggal_gangguan', 'gangguans.desc')
                    ->join('komponens', 'gangguans.kode_komponen', '=', 'komponens.kode_komponen')
                    ->join('teras', 'gangguans.id_teras', '=', 'teras.id')
                    ->where('gangguans.id', $id_gangguan)
                    ->first();

        return view('perbaikan.input-perbaikan', ['gangguan' => $gangguan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id_gangguan)
    {
        $gangguan = Gangguan::where('gangguans.id', $id_gangguan)
                    ->first();

        return view('perbaikan.edit', ['gangguan' => $gangguan]);
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
        //
    }
}
