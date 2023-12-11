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
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('image', function ($row) {
                    return "<img src='".asset($row->image)."' width='100px'>";
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<strong> <span class="badge bg-label-success">'. __('Active').'  </span>  </strong>' : '<strong> <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </strong>' ;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('slider-update')){
                    $actionBtn .= '<a href="' . route('admin.slider.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('slider-delete')){
                    $actionBtn .= ' <a href="' . route('admin.slider.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
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
       
            $slider->setTranslation('title', app()->getLocale(), $request->title);
            $slider->setTranslation('desc', app()->getLocale(), $request->desc);
            $slider->setTranslation('link', app()->getLocale(), $request->link);
            $slider->status = $request->status;
            $slider->image = $this->crud->common_image('slider',$request,'image');

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
 
            if ($request->file('image')) {
                File::delete($slider->image);
            $slider->image = $this->crud->common_image('slider',$request,'image');

            }


            $slider->setTranslation('title', app()->getLocale(), $request->title);
            $slider->setTranslation('desc', app()->getLocale(), $request->desc);
            $slider->setTranslation('link', app()->getLocale(), $request->link);
            $slider->status = $request->status;
            $slider->save();

          
            $notification = [
                'message' => __('Slider successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.slider.index')->with($notification);
     
    }

    public function destroy($id)
    {
       Slider::find($id)->delete();

        $notification = array(
            'message' => __('Slider successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.slider.index')->with($notification);
    }
}
