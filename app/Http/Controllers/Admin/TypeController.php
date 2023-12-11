<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;


class TypeController extends Controller
{
   
    public function index($category_id)
    {
        if (request()->ajax()) {
            $data = Type::where('category_id',$category_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('type-update')){
                    $actionBtn .= '<a href="' . route('admin.type.edit', $row->category_id,$row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('type-delete')){
                    $actionBtn .= ' <a href="' . route('admin.type.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.type.index',compact('category_id'));
    }

    public function create($category_id)
    {
        return view('admin.type.add',compact('category_id'));
    }

    public function store(Request $request,$category_id)
    {
     
            $type = new Type();
            $type->setTranslation('name', app()->getLocale(), $request->name);
            $type->category_id =$category_id;
            $type->save();

            $notification = [
                'message' => __('New Type added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.type.index',$category_id)->with($notification);
        
    }


    public function edit($id)
    {
        
        $type = Type::findOrFail($id);
        return view('admin.type.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
         $type = Type::where('id',$id)->first();
         $type->setTranslation('name', app()->getLocale(), $request->name);
        $type->save();

            $notification = [
                'message' => __('Type successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.type.index')->with($notification);
     
    }

    public function destroy($id)
    {
       Type::find($id)->delete();

        $notification = array(
            'message' => __('Type successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
