<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Http\Requests\TagRequest;


class TagController extends Controller
{
   
    public function index()
    {
        if (request()->ajax()) {
            $data = Tag::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('tag-update')){
                        $actionBtn .= '<a href="' . route('admin.tags.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    
                    if(Auth::user()->can('tag-delete')){
                        $actionBtn .= ' <a href="' . route('admin.tags.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    }
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.tags.index');
    }

    public function store(Request $request,TagRequest $tagRequest)
    {
        $validatedData = $tagRequest->validated();
        if($validatedData){
            $exists_product = Tag::where('title', $request->title)->doesntExist();
      
            if ($exists_product) {
                $tag = new Tag();
                $tag->setTranslation('title', app()->getLocale(), $request->title);
                $tag->save();
    
                $notification = [
                    'message' => __('Tag successfully added'),
                    'alert-type' => 'success'
                ];
                return redirect()->route('admin.tags.index')->with($notification);
            } else {
    
                $notification = [
                    'message' => __('This tag already added'),
                    'alert-type' => 'success'
                ];
                return redirect()->back()->with('error', __('This tag already added'));
            }
        }
        else{
            return redirect()->back()->with('error', __('This title must be filled'));
        }
     
    }

    public function create()
    {
        return view('admin.tags.add');
    }

 
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit',compact('tag'));
    }

    
    public function update(Request $request,$id)
    {
            $tag = Tag::find($id);
           
            $tag->setTranslation('title', app()->getLocale(), $request->title);
            $tag->save();

            $notification = [
                'message' => __('Tag successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.tags.index')->with($notification);
     
    }


    public function destroy($id)
    {
      Tag::find($id)->delete();

        $notification = [
            'message' => __('Tag successfully destroyed'),
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.tags.index')->with($notification);
    }
}
