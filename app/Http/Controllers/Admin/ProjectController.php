<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $daerah = Daerah::where('id','!=', 1)->get();
        $user = User::where('id','!=', 1)->get();
        if ($request->ajax()) {
            $data = Project::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fa fa-edit"></i></button>';
                        $btn = $btn.'<button onclick="deleteConfirmation('.$row->id.',`'.$row->name.'`)" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })->editColumn('daerah_name', function ($d) {
                        return $d->daerah_rol->name;
                    })->editColumn('user_name', function ($u) {
                        return $u->user_rol->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.project')->with(['daerah' => $daerah, 'user' => $user]);
    }

    public function store(Request $request)
    {
        $data =  Project::updateOrCreate(['id' => $request->id],
                [
                    'project_name' => $request->project_name,
                    'percentage' => "0.0",
                    'address' => $request->address,
                    'status' => 'active',
                    'id_user' => $request->id_user,
                    'id_daerah' => $request->id_daerah,
                ]
        );
        return response()->json($data);
    }

    public function edit($id)
    {
        $item = Project::find($id);
        return response()->json($item);
    }

    public function destroy($id)
    {   
        $name = Project::find($id);
        $names = $name['project_name'];
        $delete = Project::find($id)->delete();
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
