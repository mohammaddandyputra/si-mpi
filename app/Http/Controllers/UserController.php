<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Yajra\DataTables\DataTables;

class UserController extends Controller
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
            $data = User::select('id', 'name', 'email');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="detail" title="Detail"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="edit" title="Ubah"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="btn btn-dark text-white" data-id="'.$row->id.'" id="delete" id="delete" title="Hapus"><i class="fa fa-trash"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users');
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
        // User::updateOrCreate(['id' => $request->id],
        //                     ['name' => $request->name,
        //                     'email' => $request->email]);        

        // \Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required',
        // ])->validate();

        // $new_user = new \App\Models\User;

        // $new_user->name = $request->get('name');
        // $new_user->email = $request->get('email');
        // $new_user->password = \Hash::make($request->get('password'));

        // $new_user->save();

        User::updateOrCreate(['id' => $request->id],
                ['name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->get('password'))]);        

        return response()->json(['success'=>'Data berhasil ditambahkan!']);
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
        $user = User::find($id);
        return response()->json($user);
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
        User::find($id)->delete();
     
        return response()->json(['success'=>'Data berhasil dihapus!']);
    }
}
