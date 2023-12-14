<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;

class WorkAttributeController extends Controller
{
    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }


    public function index($work_id){

    
        if (request()->ajax()) {

            $data = WorkAttribute::where('work_id',$work_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('work_id', function ($row) {
                    return $row->getWork->name;
                 })

                ->addColumn('type_1', function ($row) {
                    if($row->type_1 == 1){
                        return 'Şəkil/Gif';
                    }
                    elseif($row->type_1 == 2){
                        return 'Video';
                    }else{
                          return 'None';
                    }
              
                 })
                 ->addColumn('type_2', function ($row) {
                    if($row->type_2 == 1){
                        return 'Şəkil/Gif';
                    }
                    elseif($row->type_2 == 2){
                        return 'Video';
                    }else{
                          return 'None';
                    }
                 })
                 ->addColumn('type_3', function ($row) {
                    if($row->type_3 == 1){
                        return 'Şəkil/Gif';
                    }
                    elseif($row->type_3 == 2){
                        return 'Video';
                    }else{
                          return 'None';
                    }
                 })


                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('workAttribute-update')){
                    $actionBtn .= '<a href="' . route('admin.workAttribute.edit', ['work_id' => $row->work_id,'id' => $row->id]) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('workAttribute-delete')){
                        $actionBtn .= ' <a href="' . route('admin.workAttribute.destroy', ['work_id' => $row->work_id,'id' => $row->id]) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                         }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.workAttribute.index',compact('work_id'));
    }


    
    public function create($work_id)
    {
        return view('admin.workAttribute.add',compact('work_id'));
    }

    public function store(Request $request,$work_id)
    {
    
            $work = new WorkAttribute();
            $work->work_id = $work_id;
            $work->type_1 = $request->type_1;
            $work->type_2 = $request->type_2;
            $work->type_3 = $request->type_3;

            if ( $request->type_1 == 1) {
             $work->file_1 = $this->crud->common_image('workAttribute',$request,'file_1');
            }
            else{
               $path = $request->file('file_1')->store('video', ['disk' =>'my_files']);
               $work->file_1 = $path;
            }


            if($request->type_2 != 0){
            if ( $request->type_2 == 1) {
                $work->file_2 = $this->crud->common_image('workAttribute',$request,'file_2');
            }
            else{
                $path = $request->file('file_2')->store('video', ['disk' =>'my_files']);
                $work->file_2 = $path;
            }
        }

               if($request->type_3 != 0){
            if ( $request->type_3 == 1) {
                $work->file_3 = $this->crud->common_image('workAttribute',$request,'file_3');
               }
               else{
                  $path = $request->file('file_3')->store('video', ['disk' =>'my_files']);
                  $work->file_3 = $path;
            }
        }
   

            $work->save();
            
            $notification = [
                'message' => __('New work Attribute added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.workAttribute.index',$work_id)->with($notification);
     
    }

  
    public function edit($work_id,$id)
    {
        $workAttribute = WorkAttribute::findOrFail($id);
        return view('admin.workAttribute.edit', compact('workAttribute','work_id'));
    }

    public function update(Request $request, $id)
    {
   
        $work = WorkAttribute::findorFail($id);
 
        if($request->file('file_1')){
            if ($request->type_1 == 1) {
                File::delete($work->file_1);
                $work->file_1 = $this->crud->common_image('workAttribute',$request,'file_1');
                }
            else{
                $path = $request->file('file_1')->store('video', ['disk' =>'my_files']);
                $work->file_1 = $path;
            }
        }

     
    
        if($request->file('file_2') && $request->type_2 != 0){
            if ($request->type_2 == 1) {
                File::delete($work->file_2);
                $work->file_2 = $this->crud->common_image('workAttribute',$request,'file_2');
                }
            else{
                $path = $request->file('file_2')->store('video', ['disk' =>'my_files']);
                $work->file_2 = $path;
            }
        }
        if($request->file('file_3') && $request->type_3 != 0){
            if ($request->type_3 == 1 ) {
                File::delete($work->file_3);
                $work->file_3 = $this->crud->common_image('workAttribute',$request,'file_3');
                }
            else{
                $path = $request->file('file_3')->store('video', ['disk' =>'my_files']);
                $work->file_3 = $path;
            }
        }


        $work->type_1 = $request->type_1;
        $work->type_2 = $request->type_2;
        $work->type_3 = $request->type_3;
        $work->save();
          
            $notification = [
                'message' => __('WorkAttribute successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.workAttribute.index',$work->getWork->id)->with($notification);
     
    }


    public function destroy($work_id,$id){
        WorkAttribute::findOrFail($id)->delete();

        $notification = [
            'message' => __('Workattribute Deleted'),
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.workAttribute.index',$work_id)->with($notification);
    }


}
