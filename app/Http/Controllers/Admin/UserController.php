<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Crud;
use App\Models\Order;
use App\Models\Address;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomPasswordResetEmail;
use Illuminate\Support\Str;


class UserController extends Controller
{
   
   public function index(){
    return view('user.dashboard');
   }
   public function account(){

      return view('user.account');
   }

   protected $crud;
    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }


    public function user_update(Request $request){
        $id = auth()->id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->gender = $request->gender;
        $data->birthdate = $request->birthdate;
        $data->save();
        if($data){
          toastr()->success('<span style="font-size: 18px;">İstifadəçi məlumatları dəyişdirildi</span>');
        return redirect()->back();     
        }else{
             toastr()->error('<span style="font-size: 18px;">İstifadəçi parametrləri düz deyil.Xahiş edirik təkrar yoxlayın</span>');
        return redirect()->back();
        }
       
    }

    public function update_image(Request $request){
        $id = auth()->id();
        $data = User::find($id);
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('/upload/user_images/') . $data->image);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/upload/user_images'), $filename);
            $data['image'] = $filename;
        }
        $data->save();
                 toastr()->success('<span style="font-size: 18px;">Profil şəkli dəyişdirildi</span>');
       
        return redirect()->back();
    }

   public function user_password(Request $request)
{
    $id = auth()->id();

    $hashedpassword = User::find($id)->password;

    if (Hash::check($request->old_password, $hashedpassword)) {

            $admin = User::find($id);
            $admin->password = Hash::make($request->password);
            $admin->opassword = $request->password;
            $admin->save();
            Auth::logout();
           toastr()->success('<span style="font-size: 18px;">Şifrəniz dəyişdirildi</span>');
            return redirect()->route('login');
    } else {
        toastr()->error('<span style="font-size: 18px;">Şifrəniz dəyişdirilə bilmədi. Təkrar yoxlayın</span>');
        return redirect()->back();
    }
}


    public function logout()
    {

        \Session::flush();
        Auth::logout();

        return redirect('login');
    }



        public function user_orders(){
            $user = Auth::user();
            $orders = Order::with('getOrderDetail')->orderBy('id','desc')->where('email',$user->email)->get();
            return view('user.order',compact('orders'));
        }

    public function login(Request $request){
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                toastr()->success('<span style="font-size: 18px;">Xoş gəlmisiniz</span>');
                return redirect()->route('account');
            }
           toastr()->error('<span style="font-size: 18px;">Şifrə və ya email düz deyil.Təkrar yoxlayın</span>');
              
            return redirect()->back();

    }

    public function register(Request $request)
    {
     
if ($request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required|min:6',
    'password_confirmation' => 'required|same:password'
])) {
    if (User::where('email', $request->email)->first()) {
        toastr()->error('<span style="font-size: 18px;">Bu emaillə artıq qeydiyyatdan keçilib</span>');
        return redirect()->back();
    }

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->opassword = $request->password;
    $user->birthdate = $request->birthdate;
    $user->admin_status = 2;
    $user->superadmin = 4;
    $randomString = Str::random(10);
    $user->clientCode = $randomString;
    $user->save();

    if ($user) {
        // Log in the user
        Auth::login($user);
        toastr()->success('<span style="font-size: 18px;">İstifadəçi yaradıldı</span>');
        return redirect()->route('account');
    } else {
        toastr()->error('<span style="font-size: 18px;">İstifadəçi parametrləri yanlışdır. Təkrar yoxlayın</span>');
        return redirect()->back();
    }
    }
    }


  
  public function forgot_password(Request $request) {
    $user = User::where('email', $request->email)->first();
    if ($user) {
        $token = $this->broker()->createToken($user);
        Mail::to($request->email)->send(new CustomPasswordResetEmail($token));

        toastr()->success('<span style="font-size: 14px;">Emailinizə link göndərildi</span>');

        return redirect()->back();
    } else {

        toastr()->error('<span style="font-size: 14px;">Bu email qeydiyyatda yoxdur</span>');
    }
}


    public function broker()
    {
        return Password::broker('users');
    }
    

public function showResetForm(Request $request, $token = null)
{
    return view('user.passwords.reset')->with(
        ['token' => $token, 'email' => $request->email]
    );
}



public function resetPassword($user, $password)
{
    if (!$user) {
        return redirect()->route('password.reset')->with('error', 'User not found');
    }

    $user->password = Hash::make($password); 
    $user->opassword = $password;
    $user->save();

    Auth::login($user);

     toastr()->success('<span style="font-size: 18px;">Şifrəniz dəyişdirildi</span>');
      return redirect('login');
}


public function reset(Request $request)
{
    $this->validate($request, [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

      $response = $this->broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $this->resetPassword($user, $password);
        }
    );
 
    
         Password::PASSWORD_RESET;
             return redirect("/account");
   
}



}
