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
            $data = Daerah::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fa fa-edit"></i></button>';
                        $btn = $btn.' <button  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fa fa-trash"></i></button>';
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
        Daerah::find($id)->delete();
        return back();
    }
}
