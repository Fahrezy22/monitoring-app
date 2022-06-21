<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserManagecontroller extends Controller
{
    public function index(Request $request)
    {
        $daerah = Daerah::where('id','!=', 1)->get();
        if ($request->ajax()) {
            $data = User::where('id','!=', 1)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fa fa-edit"></i></button>';
                        $btn = $btn.'<button onclick="deleteConfirmation('.$row->id.',`'.$row->name.'`)" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })->editColumn('daerah_name', function ($d) {
                        return $d->daerah_rol->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.user_manage')->with('daerah', $daerah);
    }

    public function store(Request $request)
    {
        $data =  User::updateOrCreate(['id' => $request->id],
                [
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'id_daerah' => $request->id_daerah,
                ]
        );
        return response()->json($data);
    }

    public function edit($id)
    {
        $item = User::find($id);
        return response()->json($item);
    }

    public function destroy($id)
    {   
        $name = User::find($id);
        $names = $name['name'];
        $delete = User::find($id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "Akun ($names) berhasil di hapus";
        } else {
            $success = true;
            $message = "User not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
