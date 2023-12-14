<?php

namespace App\Http\Controllers\Admin;

use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;


class WorkController extends Controller
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
            $data = Work::query();

            return DataTables::of($data)
                ->addIndexColumn()
              
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('type', function ($row) {
                  return $row->type=1 ? 'Şəkil' : "Video";
                     })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('workAttribute-list')){
                        $actionBtn .= ' <a href="' . route('admin.workAttribute.index', $row->id) . '"  class="btn btn-primary btn-sm " >Attributlar</a>';
                    }
                    if(Auth::user()->can('work-update')){
                    $actionBtn .= '<a href="' . route('admin.work.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('work-delete')){
                        $actionBtn .= ' <a href="' . route('admin.work.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    }
                   
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.work.index');
    }



    
    public function create()
    {
        return view('admin.work.add');
    }

    public function store(Request $request)
    {
    
            $work = new Work();
       
            $work->setTranslation('name', app()->getLocale(), $request->name);
            $work->setTranslation('desc', app()->getLocale(), $request->desc);
            $work->setTranslation('title', app()->getLocale(), $request->title);
            $work->type = $request->type;


            if ( $request->type == 1) {
             $work->file = $this->crud->common_image('work',$request,'file');
            }
            else{
               $path = $request->file('file')->store('work', ['disk' =>'my_files']);
               $work->file = $path;
            }
            $work->save();
            
            $notification = [
                'message' => __('New work added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.work.index')->with($notification);
     
    }

  
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('admin.work.edit', compact('work'));
    }

    public function update(Request $request, $id)
    {
   
        $work = Work::where('id',$id)->first();
 
        if($request->file('file')){
            if ($request->type == 1) {
                File::delete($work->file);
                $work->file = $this->crud->common_image('work',$request,'file');
                }
            else{
                $path = $request->file('file')->store('work', ['disk' =>'my_files']);
                $work->file = $path;
            }
        }
         

            $work->setTranslation('name', app()->getLocale(), $request->name);
            $work->setTranslation('desc', app()->getLocale(), $request->desc);
            $work->setTranslation('title', app()->getLocale(), $request->title);
            $work->type = $request->type;
            $work->save();
          
            $notification = [
                'message' => __('Work successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.work.index')->with($notification);
     
    }


    public function destroy($id){
        Work::findOrFail($id)->delete();

        $notification = [
            'message' => __('Work Deleted'),
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.work.index')->with($notification);
    }


}
