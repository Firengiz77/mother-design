<?php

namespace App\Http\Controllers\Admin;


use App\Models\Word;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class WordController extends Controller
{

    
       
    public function index()
    {
        if (request()->ajax()) {
            $data = Word::query();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('title', function ($row) {
                    return $row->title;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('word-update')){
                    $actionBtn .= '<a href="' . route('admin.word.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('word-delete')){
                        $actionBtn .= ' <a href="' . route('admin.word.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                         }
                      return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        
        }

        return view('admin.word.index');
    }


    public function create()
    {
        return view('admin.word.add');
    }


    public function store(Request $request)
    {
    
            $word = new Word();
       
            $word->setTranslation('title', app()->getLocale(), $request->title);
            $word->save();
          
            $notification = [
                'message' => __('New word added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.word.index')->with($notification);
     
    }

  
    public function edit($id)
    {
        $word = Word::findOrFail($id);
        return view('admin.word.edit', compact('word'));
    }

    public function update(Request $request, $id)
    {
   
        $word = Word::where('id',$id)->first();
        $word->setTranslation('title', app()->getLocale(), $request->title);
        $word->save();
          
            $notification = [
                'message' => __('Word successfully updated'),
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.word.index')->with($notification);
     
    }


    public function destroy($id)
    {
        Word::find($id)->delete();

        $notification = array(
            'message' => __('Word successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.word.index')->with($notification);
    }





}
