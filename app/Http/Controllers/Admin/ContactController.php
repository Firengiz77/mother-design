<?php

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ContactController extends Controller
{

  
    public function edit()
    {
        $contact = Contact::first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
   
         $contact = Contact::where('id',$id)->first();

            $contact->setTranslation('address', app()->getLocale(), $request->address);
            $contact->setTranslation('hours', app()->getLocale(), $request->hours);
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->voen = $request->voen;
            $contact->map = $request->map;
            $contact->save();

            $notification = [
                'message' => __('Contact successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.contact.edit',1)->with($notification);
     
    }
}
