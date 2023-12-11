<?php

namespace App\Http\Controllers\Admin;


use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use App\Helpers\FileRepository;


class SiteSettingController extends Controller
{

    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud,FileRepository $filerepo)
    {
        $this->crud = $crud;
        $this->filerepo = $filerepo;
    }


  
    public function edit($id)
    {
       
        $setting = SiteSetting::first();
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
   
         $setting = SiteSetting::where('id',$id)->first();
 
         if ($request->file('main_logo')) {
            File::delete($setting->main_logo);
        $setting->main_logo = $this->crud->common_image('setting',$request,'main_logo');
        }

            if ($request->file('logo_1')) {
                File::delete($setting->logo_1);
            $setting->logo_1 = $this->crud->common_image('setting',$request,'logo_1');
            }

            if ($request->file('logo_2')) {
                File::delete($setting->logo_2);
                $setting->logo_2 = $this->crud->common_image('setting',$request,'logo_2');
            }


            $setting->save();

            $setting->thumb_logo_1 = $this->filerepo->save($setting->logo_1,'setting',[400,400]);
            $setting->thumb_logo_2 = $this->filerepo->save($setting->logo_2,'setting',[400,400]);
            $setting->save();
            
            $notification = [
                'message' => __('Setting successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.setting.edit',1)->with($notification);
     
    }
}
