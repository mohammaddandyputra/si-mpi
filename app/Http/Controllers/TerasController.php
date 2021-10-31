<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Teras;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class TerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            
            $data = Teras::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','nama_teras')->orderBy('nama_teras', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="edit" title="Ubah"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="delete" id="delete" title="Hapus" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('masters.teras');
    }

    public function getTeras(Request $request)
    {
        if ($request->ajax()) {
            
            DB::statement(DB::raw('set @rownum=0'));
            $data = Teras::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id','nama_teras')->orderBy('nama_teras', 'asc');
            return Datatables::of($data)
            ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<a href="teras/'.$row->id.'/komponen/" class="btn btn-dark text-white" data-id="'.$row->id.'" id="detail()" title="Detail"><i class="fa fa-eye"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('masters.komponen-teras');
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
        $validator = \Validator::make($request->all(),
        [
            'nama_teras' => 'required|unique:teras,nama_teras'], 
        [
            'nama_komponen.required' => 'Nama komponen tidak terisi!',
            'nama_teras.unique' => 'Nama teras sudah tersedia!'
        ]);
    
        
        $id_teras = $request->get('id');
        $teras = Teras::find($id_teras);
            
        if ($validator->passes()) {
            if(empty($teras)){
                Teras::insert([
                    'nama_teras' => $request->nama_teras
                ]);

                return response()->json(['success' => 'Data berhasil di input']);
            }
            else{
                Teras::where('id', $id_teras)
                ->update(['nama_teras' => $request->nama_teras]);

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }

        return response()->json(['error' => $validator->errors()->all()]);
        
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
    public function edit($id)
    {
        $id = Teras::find($id);

        return response()->json($id);
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
        $teras = Teras::find($id);
        $teras->delete();

        return response()->json(['success'=>'Data berhasil dihapus']);
    }
}
