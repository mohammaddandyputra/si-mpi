<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Komponen;

use App\Models\Gangguan;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class KomponenController extends Controller
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

            $data = Komponen::select(
                DB::raw('@rownum  := @rownum  + 1 AS rownum'), 
                'kode_komponen','nama_komponen');
            
                return Datatables::of($data)
                    ->addColumn('action', function($row){
     
                        $btn = '<a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->kode_komponen.'" id="edit" title="Ubah"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->kode_komponen.'" id="delete" id="delete" title="Hapus" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('masters.komponen');
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

    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(),[
            'nama_komponen' => 'required|unique:komponens,nama_komponen',
        ],
        [
            'nama_komponen.required' => 'Nama komponen tidak terisi!',
            'nama_komponen.unique' => 'Nama komponen sudah tersedia!'
        ]);
        
        $kode_komponen = $request->get('kode_komponen');

        $komponen = Komponen::find($kode_komponen);
        
        if ($validator->passes()) {
            if(empty($komponen)){
                Komponen::insert([
                    'nama_komponen' => $request->nama_komponen
                ]);

                return response()->json(['success' => 'Data berhasil diinput']);
            }
            else{
                Komponen::where('kode_komponen', $kode_komponen)
                ->update(['nama_komponen' => $request->nama_komponen]);

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_komponen)
    {
        $komponen = Komponen::findOrFail($kode_komponen);

        return response()->json($komponen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($kode_komponen)
    {
        Komponen::where('kode_komponen', 151)
                ->update(['nama_komponen' => request('nama_komponen')]);

        return response()->json();

        // if(!empty($_POST['kode_komponen'])){
        //     return 'data kosong';
        // }

        // else{
        //     return 'data ada';
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Komponen::findOrFail($id)->delete();

        return response()->json(['success'=>'Data berhasil dihapus!']);
        
    }
}
