<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;
use App\Http\Requests\CategoryRequest;
use App\Helpers\FileRepository;

class CategoryController extends Controller
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
            $data = Category::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('parent_id', function ($row) {
                    return $row->getCategory ? $row->getCategory->name : '-';
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('image', function ($row) {
                    return "<img src='".asset($row->image)."' width='100px'>";
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<strong> <span class="badge bg-label-success">'. __('Active').'  </span>  </strong>' : '<strong> <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </strong>' ;
                })
                ->addColumn('favorite', function ($row) {
                    return $row->favorite == 1 ? '<strong> <span class="badge bg-label-success">'. __('Active').'  </span>  </strong>' : '<strong> <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </strong>' ;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('category-update')){
                    $actionBtn .= '<a href="' . route('admin.category.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('category-delete')){
                    $actionBtn .= ' <a href="' . route('admin.category.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                     }
                
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status','favorite'])
                ->make(true);
        }

        return view('admin.category.index');
    }

    public function create()
    {
       
        $category = Category::where('parent_id',0)->get();
    
        return view('admin.category.add',compact('category'));
    }

    public function store(Request $request,CategoryRequest $categoryRequest)
    {
        $validatedData = $categoryRequest->validated();
        if($validatedData){
            $category = new Category();
       
            $category->setTranslation('name', app()->getLocale(), $request->name);
            $category->parent_id = $request->parent_id;
            $category->favorite = $request->favorite;
            $category->status = $request->status;
            $category->image = $this->crud->common_image('category',$request,'image');

            $category->save();
          

            $notification = [
                'message' => __('New category added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.category.index')->with($notification);
        }
            else{
                return redirect()->route('admin.category.index')->with('Data Must be filled');
            }
    }


    public function edit($id)
    {
        
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id',0)->get();
        return view('admin.category.edit', compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
         $category = Category::where('id',$id)->first();
 
            if ($request->file('image')) {
            File::delete($category->image);
            $category->image = $this->crud->common_image('category',$request,'image');
            }

            $category->setTranslation('name', app()->getLocale(), $request->name);
            $category->parent_id = $request->parent_id;
            $category->favorite = $request->favorite;
            $category->status = $request->status;
            $category->save();

            $notification = [
                'message' => __('Category successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.category.index')->with($notification);
     
    }

    public function destroy($id)
    {
       Category::find($id)->delete();

        $notification = array(
            'message' => __('Category successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.category.index')->with($notification);
    }

   
  
}
