<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
class PermissionsController extends Controller
{
    
    public function index()
    {
       
        if (request()->ajax()) {
            $data = Permission::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
              

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('permission-update')){

                        $actionBtn .= '<a href="' . route('admin.permissions.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if(Auth::user()->can('permission-delete')){

                        $actionBtn .= ' <a href="' . route('admin.permissions.destroy', $row->id) . '"   class="delete btn btn-danger btn-sm delete-confirm"  >Delete</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
            $data = $data->orderBy('name', 'ASC');
        }

        return view('admin.permissions.index');
    }

   
    public function create() 
    {   
        return view('admin.permissions.add');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}