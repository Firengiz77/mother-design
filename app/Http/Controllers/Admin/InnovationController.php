<?php

namespace App\Http\Controllers\Admin;

use App\Models\Innovation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;


class InnovationController extends Controller
{
   
    public function index()
    {
        if (request()->ajax()) {
            $data = Innovation::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('innovation-update')){
                    $actionBtn .= '<a href="' . route('admin.innovation.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('innovation-delete')){
                    $actionBtn .= ' <a href="' . route('admin.innovation.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.innovation.index');
    }

    public function create()
    {
        return view('admin.innovation.add');
    }

    public function store(Request $request)
    {
     
            $innovation = new Innovation();
            $innovation->setTranslation('name', app()->getLocale(), $request->name);
            $innovation->save();

            $notification = [
                'message' => __('New innovation added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.innovation.index')->with($notification);
        
    }


    public function edit($id)
    {
        
        $innovation = Innovation::findOrFail($id);
        return view('admin.innovation.edit', compact('innovation'));
    }

    public function update(Request $request, $id)
    {
         $innovation = Innovation::where('id',$id)->first();
         $innovation->setTranslation('name', app()->getLocale(), $request->name);
        $innovation->save();

            $notification = [
                'message' => __('Innovation successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.innovation.index')->with($notification);
     
    }

    public function destroy($id)
    {
       Innovation::find($id)->delete();

        $notification = array(
            'message' => __('Innovation successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.innovation.index')->with($notification);
    }
}
