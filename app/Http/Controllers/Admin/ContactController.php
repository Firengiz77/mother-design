<?php

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;

class ContactController extends Controller
{

    protected $crud;
    
    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }
  
    public function edit()
    {
        $contact = Contact::first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
   
         $contact = Contact::where('id',$id)->first();


         if($request->file('image')) {
            File::delete($contact->image);
            $contact->image = $this->crud->common_image('contact',$request,'image');
         }


            $contact->setTranslation('address', app()->getLocale(), $request->address);
            $contact->setTranslation('title', app()->getLocale(), $request->title);
            $contact->phone = $request->phone;
            $contact->email_1 = $request->email_1;
            $contact->email_2 = $request->email_2;
            $contact->email_3 = $request->email_3;
            $contact->email_4 = $request->email_4;
            $contact->map = $request->map;
            $contact->save();

            $notification = [
                'message' => __('Contact successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.contact.edit',1)->with($notification);
     
    }
}
