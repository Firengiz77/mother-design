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


  
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact( 'about'));
    }

    public function update(Request $request, $id)
    {
   
         $about = About::where('id',$id)->first();
 
          
         $data = $request->all();
         $data['images'] = $about->images ?? [];
         if ($request->hasFile('images')) {
             if($request->has('images')){
                 foreach ($request->file('images') as $key => $file) {
                     array_push($data['images'], FileManager::fileUpload($file, 'about'));
                 }
             }
             $about->images = $data['images'];
         }

            $about->setTranslation('desc', app()->getLocale(), $request->desc);
            $about->images = $data['images'];
            $about->save();

            
            $notification = [
                'message' => __('About successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.about.edit',1)->with($notification);
     
    }


    public function delete_images_photos($id, Request $request){
        $key = $request->key;
        $data = $request->all();
        
        $fullImgPath = storage_path("uploads/about/$key.jpg");
        $product = About::find($id);
        $images = $product->images;
        unset($images[$key]);
        $product->update([
            'images'=>$images,
        ]);
     return response()->json(['success'=>true,'images'=>$product->images]);
    }



}
