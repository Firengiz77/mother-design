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


class AboutController extends Controller
{

    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud,FileRepository $filerepo)
    {
        $this->crud = $crud;
        $this->filerepo = $filerepo;
    }


  
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact( 'about'));
    }

    public function update(Request $request, $id)
    {
   
         $about = About::where('id',$id)->first();
 
            if ($request->file('image')) {
                File::delete($about->image);
            $about->image = $this->crud->common_image('about',$request,'image');

            }


            $about->setTranslation('title', app()->getLocale(), $request->title);
            $about->setTranslation('desc', app()->getLocale(), $request->desc);
            $about->save();

            $about->thumb_sm = $this->filerepo->save($about->image,'about',[400,400]);
            $about->save();
            
            $notification = [
                'message' => __('About successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.about.edit',1)->with($notification);
     
    }
}
