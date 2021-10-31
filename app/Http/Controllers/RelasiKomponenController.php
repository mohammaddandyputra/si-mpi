<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Komponen;

use App\Models\RelasiKomponen;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class RelasiKomponenController extends Controller
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

            $data = Komponen::select(
                'kode_komponen',
                'nama_komponen',
            )
            ->get()
            ;
            
            return DataTables::of($data)
            ->addColumn('relasi', function($row){
                
                $relasi = DB::table('relasi_komponen')->select('relasi')->where('komponen', $row->kode_komponen)->get();

                $data = [];

                foreach($relasi as $row){
                    $data[] = Komponen::select('nama_komponen')->where('kode_komponen', $row->relasi)->pluck('nama_komponen');
                }

                return $data;
            })
            ->addColumn('action', function($row){
                
                $btn = '<a href="relasi/'.$row->id.'/komponen" class="btn btn-dark text-white" data-id="'.$row->id.'" title="Ubah"><i class="fa fa-edit"></i></a>';
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->tojson();
        }
        return view('masters.relasi-komponen');
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
        //
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
        //
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
