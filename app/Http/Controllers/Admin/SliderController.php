<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;


class SliderController extends Controller
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
            $data = Slider::query();

            return DataTables::of($data)
                ->addIndexColumn()
              
                ->addColumn('image', function ($row) {
                    return   $row->type == 1 ?   "<img src='".asset($row->file)."' width='100px'>" 
                 :
                  '<video id="video" loop="" playsinline="" autoplay="" muted=""  style="width:100px">
                 <source src="'.asset($row->file).'" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
               </video>'
                 
                 ;
                })
                ->addColumn('status', function ($row) {
                  if($row->status == 1){
                    return '<a href="' . route('admin.slider.status', 0) . '" > <span class="badge bg-label-success">'. __('Active').'  </span>  </a>'  ;
                  }
                  else{
                    return  '<a href="' . route('admin.slider.status', 1) . '" > <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </a>' ;
               
                  }
                     })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('slider-update')){
                    $actionBtn .= '<a href="' . route('admin.slider.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.slider.index');
    }



    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(Request $request)
    {
    
            $slider = new Slider();
       
            $slider->setTranslation('link', app()->getLocale(), $request->link);
            $slider->status = $request->status;
            $slider->type = $request->type;

            $slider->file = $this->crud->common_image('slider',$request,'file');
           

            $slider->save();
            
            $notification = [
                'message' => __('New slider added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.slider.index')->with($notification);
     
    }

  
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
   
         $slider = Slider::where('id',$id)->first();
 
         if($request->file('file')){
                File::delete($slider->file);
                $slider->file = $this->crud->common_image('slider',$request,'file');
         }

            $slider->setTranslation('link', app()->getLocale(), $request->link);
            $slider->status = $request->status;
            $slider->type = $request->type;
            $slider->save();
          
            $notification = [
                'message' => __('Slider successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.slider.index')->with($notification);
     
    }

        public function status($id){
            $slider = Slider::first();
            $slider->status = $id;
            $slider->save();
            return redirect()->back();

        }
}
