<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use DataTables;
class MessageController extends Controller
{
  
   
    public function index()
    {
        if (request()->ajax()) {
            $data = Message::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('surname', function ($row) {
                    return $row->surname;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->addColumn('message', function ($row) {
                    return $row->message;
                })

                ->make(true);
        }

        return view('admin.messages.index');
    }






}
