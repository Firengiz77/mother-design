<?php

namespace App\Http\Controllers\Admin;

use App\Models\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;


class FamilyController extends Controller
{
    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }
    
    public function index()
    {
        if (request()->ajax()) {
            $data = Family::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('image', function ($row) {
                    return "<img src='".asset($row->image)."' width='100px'>";
                })
             
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('family-update')){
                    $actionBtn .= '<a href="' . route('admin.family.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('family-delete')){
                        $actionBtn .= ' <a href="' . route('admin.family.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    }

                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.family.index');
    }



    public function create()
    {
        return view('admin.family.add');
    }

    public function store(Request $request)
    {
    
            $family = new Family();
       
            $family->setTranslation('name', app()->getLocale(), $request->name);
            $family->setTranslation('profession', app()->getLocale(), $request->profession);
            $family->setTranslation('desc', app()->getLocale(), $request->desc);
            $family->link = $request->link;
            $family->image = $this->crud->common_image('family',$request,'image');
            $family->save();
          
            $notification = [
                'message' => __('New family added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.family.index')->with($notification);
     
    }

  
    public function edit($id)
    {
        $family = Family::findOrFail($id);
        return view('admin.family.edit', compact('family'));
    }

    public function update(Request $request, $id)
    {
   
         $family = Family::where('id',$id)->first();
 
       
            if ($request->file('image')) {
                File::delete($family->image);
                $family->image = $this->crud->common_image('family',$request,'image');
            }

            $family->setTranslation('name', app()->getLocale(), $request->name);
            $family->setTranslation('profession', app()->getLocale(), $request->profession);
            $family->setTranslation('desc', app()->getLocale(), $request->desc);
            $family->link = $request->link;

            $family->save();
          
            $notification = [
                'message' => __('Family successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.family.index')->with($notification);
     
    }


    public function destroy($id)
    {
        Family::find($id)->delete();

        $notification = array(
            'message' => __('Family successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.family.index')->with($notification);
    }

    
}
