<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Http\Requests\LanguageRequest;

class LanguageController extends Controller
{


    public function index()
    {
        if (request()->ajax()) {
            $data = Language::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('code', function ($row) {
                    return $row->code;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('language-update')){
                    $actionBtn .= '<a href="' . route('admin.language.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('language-delete')){
                    $actionBtn .= ' <a href="' . route('admin.language.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                   
                     }
                      return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.language.index');
    }


    public function show(){
        return view('admin.language.index');
    }

    public function store(Request $request,LanguageRequest $languageRequest)
    {
        $validatedData = $languageRequest->validated();

        if ($validatedData) {
        $exists_product = Language::where('code', $request->code)->doesntExist();
        if ($exists_product) {
            $language = new Language();
            $language->name = $request->name;
            $language->code = $request->code;
            $language->save();

            $notification = [
                'message' => __('New language successfully added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.language.index')->with($notification);
        } else {

            $notification = [
                'message' => __('This language already exists'),
                'alert-type' => 'success'
            ];
            return redirect()->back()->with('error', __('This language already exists'));
        }
    }
    else{
        return redirect()->back()->with('error', __('This title must be filled'));
    }
    }


    public function create()
    {
        return view('admin.language.add');
    }


    public function edit($id)
    {
    
        $language = Language::where('id', $id)->first();
    
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::find($id);

        $language->name = $request->name;
        $language->code = $request->code;
        $language->save();

    
        $notification = [
            'message' => __('Language successfully updated'),
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.language.index')->with($notification);
    }

    public function destroy($id)
    {
      
         Language::find($id)->delete();

        $notification = [
            'message' => __('Language successfully destroyed'),
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.language.index')->with($notification);
    }
}
