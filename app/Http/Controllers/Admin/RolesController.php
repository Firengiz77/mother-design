<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use DataTables;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function old_index(Request $request)
    {   
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = Role::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
              

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . route('admin.roles.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    
                    $actionBtn .= ' <a href="' . route('admin.roles.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
            $data = $data->paginate(5);
        }

        return view('admin.roles.index');
    }



    
  
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.add', compact('permissions'));
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('admin.roles.index')
                        ->with('success','Role created successfully');
    }

  
    public function show(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions;
    
        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }
    
   
    public function edit(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::orderBy('name')->get();
    
        return view('admin.roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
       // $role->update($request->only('name'));
    
    
        $role = Role::find($id);
        $role->name =  $request->name;
        $role->syncPermissions($request->permission);
        $role->save();
    
        return redirect()->route('admin.roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return redirect()->route('admin.roles.index')
                        ->with('success','Role deleted successfully');
    }
}