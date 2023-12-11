<?php

namespace App\Http\Controllers\Admin;


use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\BannerRequest;
use App\Helpers\Crud;
use DataTables;
use Auth;


class BannerController extends Controller
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
            $data = Banner::query();

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
                    if(Auth::user()->can('banner-update')){
                    $actionBtn .= '<a href="' . route('admin.banner.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('banner-delete')){
                    $actionBtn .= ' <a href="' . route('admin.banner.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.banner.index');
    }



    public function create()
    {
        return view('admin.banner.add');
    }

    public function store(Request $request,BannerRequest $bannerRequest)
    {
       
        $validatedData = $bannerRequest->validated();
        if($validatedData){
    
             $banner = new Banner();
       
            $banner->setTranslation('title', app()->getLocale(), $request->title);
            $banner->setTranslation('desc', app()->getLocale(), $request->desc);
            $banner->setTranslation('button', app()->getLocale(), $request->button);
            $banner->setTranslation('link', app()->getLocale(), $request->link);
            $banner->status = $request->status;

            $banner->image = $this->crud->common_image('banner',$request,'image');
            $banner->save();
            
            $notification = [
                'message' => __('New Banner added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.banner.index')->with($notification);
        }
            else{
                return redirect()->route('admin.banner.index')->with('Data Must be filled');
            }
    }

  
    public function edit($id)
    {
       
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
   
        $banner = Banner::where('id',$id)->first();
 
        if($request->file('image')) {
                File::delete($banner->image);
              $banner->image = $this->crud->common_image('banner',$request,'image');

        }


            $banner->setTranslation('title', app()->getLocale(), $request->title);
            $banner->setTranslation('desc', app()->getLocale(), $request->desc);
            $banner->setTranslation('button', app()->getLocale(), $request->button);
            $banner->setTranslation('link', app()->getLocale(), $request->link);
            $banner->status = $request->status;
            $banner->save();

            $notification = [
                'message' => __('Banner successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.banner.index')->with($notification);
     
    }

    public function destroy($id)
    {
        Banner::find($id)->delete();

        $notification = array(
            'message' => __('Banner successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.banner.index')->with($notification);
    }
}
