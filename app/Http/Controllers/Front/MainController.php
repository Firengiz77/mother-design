<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Slider;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
   


    public function index()
    {
        $sliders = Slider::isActive()->get();
        $products = Product::isActive()->get();
        $blog = Blog::isActive()->orderBy('id', 'desc')->first();
        $banner = Banner::orderBy('id', 'desc')->first();
        $categories = Category::isActive()->where('parent_id', '!=', 0)->get();
        $about = About::first();
        $services = Service::get();
        return view('front.index', compact('sliders', 'products', 'blog', 'banner', 'categories', 'about', 'services'));
    }

    public function productSingle($category_id, $id)
    {
        $product = Product::with('getAttributeProduct')->findOrFail($id);
        return view('front.product.single', compact('product'));
    }

    public function blog()
    {
        $blogs = Blog::get();
        return view('front.blog.index', compact('blogs'));
    }

    public function blogSingle($slug)
    {
        $blog = Blog::IsSlug($slug)->first();
        $blogs = Blog::get();
        $tags = Tag::get();

        return view('front.blog.single', compact('blog', 'blogs', 'tags'));
    }

    public function aboutUs()
    {
        $about = About::first();
        $banners = Banner::where('status', 1)->get();
        return view('front.about.index', compact('about', 'banners'));
    }

    public function contact(){
        return view('front.contact.index');
    }


    public function allProducts(){
        $products = Product::orderBy('id','desc')->get();
        return view('front.product.index',compact('products'));
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



    public function category($id)
    {
        $products = Product::take(6)->get();
        $category = Category::with('getProducts')->findOrFail($id);
        $attribute = Attribute::get();
        return view('front.category.index', compact('category', 'products', 'attribute'));
    }
    


}
