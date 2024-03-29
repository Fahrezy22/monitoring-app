<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DaerahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Daerah::where('id','!=', 1)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fa fa-edit"></i></button>';
                        $btn = $btn.'<button onclick="deleteConfirmation('.$row->id.',`'.$row->name.'`)" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.tes');
    }

    public function store(Request $request)
    {
        $data =  Daerah::updateOrCreate(['id' => $request->id],
                ['name' => $request->name]
        );
        return response()->json($data);
    }

    public function edit($id)
    {
        $item = Daerah::find($id);
        return response()->json($item);
    }

    public function destroy($id)
    {   
        $name = Daerah::find($id);
        $names = $name['name'];
        $delete = Daerah::find($id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "Data ($names) berhasil di hapus";
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
