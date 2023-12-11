<?php

namespace App\Http\Controllers\Admin;


use App\Models\SocialLink;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SocialLinkRequest;
use App\Helpers\Crud;
use DataTables;
use Auth;


class SocialLinkController extends Controller
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
            $data = SocialLink::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('icon', function ($row) {
                    return $row->icon;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<strong> <span class="badge bg-label-success">'. __('Active').'  </span>  </strong>' : '<strong> <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </strong>' ;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('socialLink-update')){
                    $actionBtn .= '<a href="' . route('admin.socialLink.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('socialLink-delete')){
                    $actionBtn .= ' <a href="' . route('admin.socialLink.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action','icon','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.socialLink.index');
    }



    public function create()
    {
        return view('admin.socialLink.add');
    }

    public function store(Request $request,SocialLinkRequest $socialRequest)
    {
       
        $validatedData = $socialRequest->validated();
        if($validatedData){
    
             $social = new SocialLink();
       
            $social->setTranslation('title', app()->getLocale(), $request->title);
            $social->status = $request->status;
            $social->link = $request->link;
            $social->icon = $request->icon;
            $social->save();
            
            $notification = [
                'message' => __('New SM Link added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.socialLink.index')->with($notification);
        }
            else{
                return redirect()->route('admin.socialLink.index')->with('Data Must be filled');
            }
    }

  
    public function edit($id)
    {
       
        $social = SocialLink::findOrFail($id);
        return view('admin.socialLink.edit', compact('social'));
    }

    public function update(Request $request, $id)
    {
   
           
         $social = SocialLink::where('id',$id)->first();
 
            $social->setTranslation('title', app()->getLocale(), $request->title);
            $social->link = $request->link;
            $social->status = $request->status;
            $social->icon = $request->icon;
            $social->save();

            $notification = [
                'message' => __('SM Link successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.socialLink.index')->with($notification);
     
    }

    public function destroy($id)
    {
        SocialLink::find($id)->delete();

        $notification = array(
            'message' => __('SM Link successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.socialLinks.index')->with($notification);
    }
}
