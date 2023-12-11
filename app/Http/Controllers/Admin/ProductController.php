<?php

namespace App\Http\Controllers\Admin;


use App\Models\Product;
use App\Models\Category;
use App\Models\Innovation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\Crud;
use DataTables;
use Auth;
use App\Http\Requests\ProductRequest;
use App\Helpers\FileRepository;
use GuzzleHttp\Handler\Proxy;
use App\Helpers\FileManager;
use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\OptionProduct;
use App\Models\Option;

class ProductController extends Controller
{

    protected $crud;
    protected $filerepo;
    
    public function __construct(Crud $crud,FileRepository $filerepo)
    {
        $this->crud = $crud;
        $this->filerepo = $filerepo;
    }

  
    public function index()
    {
        if (request()->ajax()) {
            $data = Product::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->getCategory->name;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<strong> <span class="badge bg-label-success">'. __('Active').'  </span>  </strong>' : '<strong> <span class="badge bg-label-danger">'. __('Deactive').'  </span>  </strong>' ;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('product-update')){
                    $actionBtn .= '<a href="' . route('admin.product.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('product-delete')){
                    $actionBtn .= ' <a href="' . route('admin.product.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                     }
                     if(Auth::user()->can('product-action')){
                        $actionBtn .= ' <a href="' . route('admin.product.attribute.create', $row->id) . '"   class="btn btn-primary btn-sm"  >Attribute</a>';
                    }
                      return $actionBtn;
                })
                ->rawColumns(['action','category','status'])
                ->make(true);
        }

        return view('admin.product.index');
    }



    public function productAttribute($id){
        $product = Product::findOrFail($id);
        $attributes= Attribute::get();
        $attribute_products = AttributeProduct::where('product_id', $product->id)->get();
    
        return view('admin.product.attribute.create',compact('attributes','product','attribute_products'));
    }

    public function attributeStore(Request $request){
      
        $product = Product::findOrFail($request->product_id);
        if ($request->attributeOptions) {
            $product->getOption()->sync($request->attributeOptions);

            $attributeOptions = Option::whereIn('id', $request->attributeOptions)->get('attribute_id');
          
            $attributes = Attribute::whereIn('id', $attributeOptions)->get();
            $product->attributes()->sync($attributes);
        } else {
            $product->getOption()->detach();
            $product->attributes()->detach();
        }


        $notification = array(
            'message' => __('product_attribute_edit'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product.index', compact('product'))->with($notification);

    }

    public function create()
    {
        $category = Category::get();
        $innovation = Innovation::get();
        return view('admin.product.add',compact('category','innovation'));
    }

    public function store(Request $request,ProductRequest $productRequest)
    {
        $validatedData = $productRequest->validated();


        if($validatedData){
    
            $product = new Product();

            $data = $request->all();


            if ($request->hasFile('images')) {
                $data['images'] = [];
                foreach ($request->file('images') as $key => $file) {
                    $data['images'][$key] = FileManager::fileUpload($file, 'product');
                }
            }
    

            $product->setTranslation('name', app()->getLocale(), $request->name);
            $product->sku = $request->sku;
            $product->price = $request->price;

            $product->setTranslation('meta_title', app()->getLocale(), $request->meta_title);
            $product->setTranslation('meta_keywords', app()->getLocale(), $request->meta_keywords);
            $product->setTranslation('meta_desc', app()->getLocale(), $request->meta_desc);
            $product->setTranslation('desc', app()->getLocale(), $request->desc);
            $product->image_1 = $this->crud->common_image('product',$request,'image_1');
            $product->status = $request->status;
            $product->percentage = $request->percentage;
           
            $product->category_id = $request->category_id;
            $product->innovation_id = $request->innovation_id;
            $product->images = $data['images'];
            $product->save();
            $product->percentage_price = $request->percentage != null ?  $product->price - ($product->price * $request->percentage)/100  : null ;
            
            $product->thumb_1 = $this->filerepo->save($product->image_1,'product',[616,920]);
    
            $data['thumbs'] = [];
           foreach($product->images as $key => $image){
              $data['thumbs'][$key] = $this->filerepo->save('uploads/product/'.$image,'product',[88,88]);
           }
            $product->thumbs = $data['thumbs'];
            $product->save();
             

         
            $notification = [
                'message' => __('New product added'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.product.index')->with($notification);
        }
            else{
                return redirect()->route('admin.product.index')->with('Data Must be filled');
            }
    }

    public function edit($id)
    {
        $category = Category::where('parent_id','!=',0)->get();
        $innovation = Innovation::get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'category','innovation'));
    }

    public function update(Request $request, $id)
    {
         $product = Product::where('id',$id)->first();
 
            if ($request->file('image_1')) {
                File::delete($product->image_1);
                $product->image_1 = $this->crud->common_image('product',$request,'image_1');
                
            }

            $data = $request->all();
            $data['images'] = $product->images ?? [];
            if ($request->hasFile('images')) {
                if($request->has('images')){
                    foreach ($request->file('images') as $key => $file) {
                        array_push($data['images'], FileManager::fileUpload($file, 'product'));
                    }
                }
                $product->images = $data['images'];
            }



            $product->setTranslation('name', app()->getLocale(), $request->name);
            $product->setTranslation('desc', app()->getLocale(), $request->desc);
            $product->setTranslation('meta_title', app()->getLocale(), $request->meta_title);
            $product->setTranslation('meta_keywords', app()->getLocale(), $request->meta_keywords);
            $product->setTranslation('meta_desc', app()->getLocale(), $request->meta_desc);

            $product->status = $request->status;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->percentage = $request->percentage;
            $product->category_id = $request->category_id;
            $product->innovation_id = $request->innovation_id;
            $product->percentage_price = $request->percentage != null ?  $product->price - ($product->price * $request->percentage)/100  : null ;
            $product->images = $data['images'];
            $product->save();

            $product->thumb_1 = $this->filerepo->save($product->image_1,'product',[616,920]);

            $data['thumbs'] = [];
            foreach($product->images as $key => $image){
               $data['thumbs'][$key] = $this->filerepo->save('uploads/product/'.$image,'product',[88,88]);
            }
             $product->thumbs = $data['thumbs'];
             $product->save();

           
            $notification = [
                'message' => __('Product successfully updated'),
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.product.index')->with($notification);
     
    }

    public function destroy($id)
    {
     Product::find($id)->delete();

        $notification = array(
            'message' => __('Product successfully destroyed'),
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function delete_images_photos($id, Request $request){
        $key = $request->key;
        $data = $request->all();
        
        $fullImgPath = storage_path("uploads/product/$key.jpg");
        $product = Product::find($id);
        $images = $product->images;
        unset($images[$key]);
        $product->update([
            'images'=>$images,
        ]);
     return response()->json(['success'=>true,'images'=>$product->images]);
    }

}
