<?php

namespace App\Http\Controllers\Admin;


use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;
use App\Http\Requests\AboutRequest;
use App\Helpers\FileRepository;
use App\Helpers\FileManager;

class AboutController extends Controller
{

    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud,FileRepository $filerepo)
    {
        $this->crud = $crud;
        $this->filerepo = $filerepo;
    }


       
    public function index()
    {
        if (request()->ajax()) {
            $data = About::query();

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
                    if(Auth::user()->can('about-update')){
                    $actionBtn .= '<a href="' . route('admin.about.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('about-delete')){
                        $actionBtn .= ' <a href="' . route('admin.about.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                         }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.about.index');
    }


    public function create()
    {
        return view('admin.about.add');
    }


    public function store(Request $request)
    {
    
            $about = new About();
       
            $about->setTranslation('title', app()->getLocale(), $request->title);
            $about->image = $this->crud->common_image('about',$request,'image');
            $about->save();
          
            $notification = [
                'message' => __('New about added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.about.index')->with($notification);
     
    }

  
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
   
         $about = About::where('id',$id)->first();

            if ($request->file('image')) {
                File::delete($about->image);
                $about->image = $this->crud->common_image('about',$request,'image');
            }

           $about->setTranslation('title', app()->getLocale(), $request->title);
           $about->save();
          
            $notification = [
                'message' => __('About successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.about.index')->with($notification);
     
    }


    public function destroy($id)
    {
        About::find($id)->delete();

        $notification = array(
            'message' => __('About successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.about.index')->with($notification);
    }





}
