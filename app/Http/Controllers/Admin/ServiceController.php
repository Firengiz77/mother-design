<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceRequest;
use App\Helpers\Crud;
use DataTables;
use Auth;


class ServiceController extends Controller
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
            $data = Service::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('image', function ($row) {
                    return "<img src='".asset($row->image)."' width='100px'>";
                })
              
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('service-update')){
                    $actionBtn .= '<a href="' . route('admin.service.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('service-delete')){
                    $actionBtn .= ' <a href="' . route('admin.service.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.service.index');
    }



    public function create()
    {
        return view('admin.service.add');
    }

    public function store(Request $request,ServiceRequest $serviceRequest)
    {
       
        $validatedData = $serviceRequest->validated();
        if($validatedData){
    
             $service = new Service();
       
            $service->setTranslation('title', app()->getLocale(), $request->title);
            $service->setTranslation('desc', app()->getLocale(), $request->desc);
            $service->image = $this->crud->common_image('service',$request,'image');
            $service->save();
            
            $notification = [
                'message' => __('New service added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.service.index')->with($notification);
        }
            else{
                return redirect()->route('admin.service.index')->with('Data Must be filled');
            }
    }

  
    public function edit($id)
    {
       
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
   
        $service = Service::where('id',$id)->first();
 
        if($request->file('image')) {
                File::delete($service->image);
              $service->image = $this->crud->common_image('service',$request,'image');

        }


            $service->setTranslation('title', app()->getLocale(), $request->title);
            $service->setTranslation('desc', app()->getLocale(), $request->desc);
            $service->save();

            $notification = [
                'message' => __('Service successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.service.index')->with($notification);
     
    }

    public function destroy($id)
    {
        Service::find($id)->delete();

        $notification = array(
            'message' => __('Service successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.service.index')->with($notification);
    }
}
