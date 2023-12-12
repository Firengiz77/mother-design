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

class MainController extends Controller
{
   
    public function index()
    {
        $slider = Slider::isActive()->first();
        return view('front.pages.index', compact('slider'));
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


    
    public function search(Request $request)
    {
         if ($request->q === null || $request->q === "" || $request->q === " " ) {
        
         return response()->json(['error' => 'Mehsul Tapilmadi']);
         }
        
        $name = 'name';
        if ($request->q) {
            $product_results = Product::where($name, 'LIKE', "%$request->q%")->orWhere('sku', 'LIKE', "%$request->q%")
            ->take(5)->orderByDesc('id')->get();
                
         return view('front.widget.search', compact('product_results'));
              
        }
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
