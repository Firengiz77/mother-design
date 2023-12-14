<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Slider;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use App\Models\Family;
use App\Models\Word;
use App\Models\Work;

class MainController extends Controller
{
   
    public function index()
    {
        $slider = Slider::isActive()->first();
        $works = Work::get();
        return view('front.pages.index', compact('slider','works'));
    }

   

    public function aboutUs()
    {
        $about = About::get();
        return view('front.pages.about', compact('about'));
    }

    public function contact(){

        return view('front.pages.contact');
    }

    public function family(){
        $family = Family::get();
        return view('front.pages.family',compact('family'));
    }



    public function singleWork($id)
    {
       $work = Work::findOrFail($id);
     
        return view('front.pages.work', compact('work'));
    }



    public function sendMessage(Request $request){
        $message = new Message;
        $message->name = $request->name;
        $message->surname = $request->surname;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->save();

        toastr()->success('Mesajınız uğurla göndərildi');

        return redirect()->back();
    }


    


}
