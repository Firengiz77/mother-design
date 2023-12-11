<?php

namespace App\Http\Controllers\Admin;


use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Models\Option;


class OptionController extends Controller
{

    public function index($attribute_id)
    {
        if (request()->ajax()) {
            $data = Option::where('attribute_id',$attribute_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('value', function ($row) {
                    return $row->value;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('option-update')){
                    $actionBtn .= '<a href="' . route('admin.option.edit', ['attribute_id'=> $row->attribute_id,'id' => $row->id ]) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('option-delete')){
                    $actionBtn .= ' <a href="' . route('admin.option.destroy', ['attribute_id'=> $row->attribute_id,'id' => $row->id ]) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.option.index',compact('attribute_id'));
    }



    public function create($attribute_id)
    {
        $attribute = Attribute::findOrFail($attribute_id);
        return view('admin.option.add',compact('attribute_id','attribute'));
    }

    public function store(Request $request,$attribute_id)
    {

            $option = new Option();
            $option->setTranslation('value', app()->getLocale(), $request->value);
            $option->attribute_id = $attribute_id;
            $option->save();
            
            $notification = [
                'message' => __('New option added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.option.index',$attribute_id)->with($notification);
       
    }

  
    public function edit( $attribute_id,$id)
    {
       
        $option = Option::findOrFail($id);
        return view('admin.option.edit', compact('option'));
    }

    public function update(Request $request, $attribute_id,$id)
    {
        // dd($id,$attribute_id);
   
        $option = Option::findOrFail($id);
        $option->setTranslation('value', app()->getLocale(), $request->value);
        $option->save();

            $notification = [
                'message' => __('Option successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.option.index',$attribute_id)->with($notification);
     
    }

    public function destroy($id,$attribute_id)
    {
        Option::find($id)->delete();

        $notification = array(
            'message' => __('Option successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.option.index',$attribute_id)->with($notification);
    }
}
