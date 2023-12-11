<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
 

    public function admin_update(Request $request){
        $id = auth()->id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        return redirect()->back()->with('message', 'Admin Has Been Changed Already');
    }

    public function update_image(Request $request){
        $id = auth()->id();
        $data = User::find($id);
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('/upload/admin_images/') . $data->image);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/upload/admin_images'), $filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->back()->with('message', 'Images Changed Already');
    }

    public function admin_password(Request $request)
    {
        $id = auth()->id();
        $hashedpassword = User::find($id)->password;

        if (Hash::check($request->old_password, $hashedpassword)) {
            $admin = User::find($id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect('admin/login')->with('message', 'Password has been changed Successfully');
        } else {
            return redirect()->back()->with('message', 'Password has NOT been changed Successfully');
        }
    }

    public function logout()
    {

        Auth::logout();

        return redirect('admin/login');
    }

    public function login(Request $request){
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect("admin/index")->with('message', 'Successfully Signed In');
            }

            return redirect()->back()->with('message', 'Have A Problem,Please Check Again');

    }


    public function registerIndex(){
        $roles = Role::orderBy('name')->get();
        return view('admin.user.action.register',compact('roles'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
          ]);

          $defaultRole = Role::findOrFail($request->role);

          $user->assignRole($defaultRole);
          
        return redirect()->route('admin.index')->with('message', 'Successfully Created Admin');
    }


    public function admin_delete($id)
    {
       
        User::find($id)->delete();
        return redirect()->route('admin.all_admin')->with('message','User has been deleted successfully');
    }

  

}
