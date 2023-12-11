<?php

namespace App\Http\Controllers\Admin;


use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;


class AttributeController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = Attribute::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('attribute-update')){
                    $actionBtn .= '<a href="' . route('admin.attribute.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('attribute-delete')){
                    $actionBtn .= ' <a href="' . route('admin.attribute.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                     }
                     if(Auth::user()->can('option-list')){
                        $actionBtn .= ' <a href="' . route('admin.option.index',['attribute_id' => $row->id]) . '"   class="btn btn-primary btn-sm"  >Option</a>';
                       
                         }
                      return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.attribute.index');
    }



    public function create()
    {
        return view('admin.attribute.add');
    }

    public function store(Request $request)
    {
   
             $attribute = new Attribute();
       
            $attribute->setTranslation('name', app()->getLocale(), $request->name);
            $attribute->save();
            
            $notification = [
                'message' => __('New attribute added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.attribute.index')->with($notification);
       
    }

  
    public function edit($id)
    {
       
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
   
        $attribute = Attribute::where('id',$id)->first();
        $attribute->setTranslation('name', app()->getLocale(), $request->name);
        $attribute->save();

            $notification = [
                'message' => __('Attribute successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.attribute.index')->with($notification);
     
    }

    public function destroy($id)
    {
        Attribute::find($id)->delete();

        $notification = array(
            'message' => __('Attribute successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.attribute.index')->with($notification);
    }
}
