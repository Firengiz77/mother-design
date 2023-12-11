<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\NewsRequest;
use App\Helpers\Crud;
use DataTables;
use Auth;
use App\Http\Requests\BlogRequest;
use App\Helpers\FileRepository;


class BlogsController extends Controller
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
            $data = Blog::query();

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
                    if(Auth::user()->can('blog-update')){
                    $actionBtn .= '<a href="' . route('admin.blogs.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('blog-delete')){
                    $actionBtn .= ' <a href="' . route('admin.blogs.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.blogs.index');
    }



    public function create()
    {
        $tags = Tag::orderBy('title')->get();
        return view('admin.blogs.add',compact('tags'));
    }

    public function store(Request $request,BlogRequest $blogRequest)
    {
        $validatedData = $blogRequest->validated();
        if($validatedData){
    
            $tags = Tag::findOrFail($request->tags);
            $blog = new Blog();
       
            $blog->setTranslation('title', app()->getLocale(), $request->title);
            $blog->setTranslation('desc', app()->getLocale(), $request->desc);
            $blog->setTranslation('meta_title', app()->getLocale(), $request->meta_title);
            $blog->setTranslation('meta_keyword', app()->getLocale(), $request->meta_keyword);
            $blog->setTranslation('meta_desc', app()->getLocale(), $request->meta_desc);
 
            $blog->status = $request->status;
            $blog->image = $this->crud->common_image('blogs',$request,'image');

            $blog->save();
            $blog->thumb_sm = $this->filerepo->save($blog->image,'blogs',[400,400]);
            $blog->save();
            $blog->tags()->attach($tags);

            $notification = [
                'message' => __('New blog added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.blogs.index')->with($notification);
        }
            else{
                return redirect()->route('admin.blogs.index')->with('Data Must be filled');
            }
    }

  
    public function edit($id)
    {
        $tags = Tag::orderBy('title')->get();
        $blogs = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('tags', 'blogs'));
    }

    public function update(Request $request, $id)
    {
   
            $tags = Tag::findOrFail($request->tags);

         $blog = Blog::where('id',$id)->first();
 
            if ($request->file('image')) {
                File::delete($blog->image);
            $blog->image = $this->crud->common_image('blogs',$request,'image');

            }


            $blog->setTranslation('title', app()->getLocale(), $request->title);
            $blog->setTranslation('desc', app()->getLocale(), $request->desc);
            $blog->setTranslation('meta_title', app()->getLocale(), $request->meta_title);
            $blog->setTranslation('meta_keyword', app()->getLocale(), $request->meta_keyword);
            $blog->setTranslation('meta_desc', app()->getLocale(), $request->meta_desc);
            $blog->status = $request->status;
            $blog->save();

            $blog->thumb_sm = $this->filerepo->save($blog->image,'blogs',[400,400]);
            $blog->save();
            $blog->tags()->sync($tags);

            $notification = [
                'message' => __('Blog successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.blogs.index')->with($notification);
     
    }

    public function destroy($id)
    {
        $blogs = Blog::find($id);
        $blogs->tags()->detach();
        $blogs->delete();

        $notification = array(
            'message' => __('Blog successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blogs.index')->with($notification);
    }
}
