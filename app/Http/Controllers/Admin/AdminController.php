<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Spatie\Permission\Models\Role;
use Auth;


class AdminController extends Controller
{

    public function all_admin()
    {
        if (request()->ajax()) {
            $data = User::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
              
                ->addColumn('status', function ($row) {
                    return count($row->roles) > 0 ? $row->roles[0]->name : 'None' ;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    if(Auth::user()->can('admin-update')){
                        $actionBtn .= '<a href="' . route('admin.adminEdit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }

                    if(Auth::user()->can('admin-delete')){
                    $actionBtn .= ' <a href="' . route('admin.adminDestroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.user.all_admin');
    }


    public function edit($id){
        
        $admin = User::find($id);
        $roles = Role::orderBy('name')->get();
        return view('admin.user.action.adminEdit',compact('admin','roles'));
    }

    public function update($id,Request $request) {

        $user = User::findOrFail($id);
        $defaultRole = Role::findOrFail($request->role);
        $user->assignRole($defaultRole);

        return redirect()->route('admin.all');
    }
    
   public function index(){
    return view('admin.user.dashboard');
   }

   public function destroy($id){

    User::findOrFail($id)->delete();
    return redirect()->route('admin.all');
   }

   public function all_users(){
    $users = User::where('superadmin',4)->get();
    return view('admin.user.all_users',compact('users'));
   }

   public function account(){
      return view('admin.user.account');
   }


}
