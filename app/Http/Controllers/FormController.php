<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class FormController extends Controller
{
    public function create()
    {
        //
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => '0', 'errors' =>$validator->errors()->toArray()]);
        }
        else {
            $values=[
                'name' =>$request->first_name,
                'last_name' =>$request->last_name,
                'email' =>$request->email,
                'address' =>$request->address,

            ];

            $query = DB::table('students')->insert($values);
            if ($query){
                return response()->json(['status' => '1', 'msg' =>'successfully created XXXXX']);
            }
        }


    }
}
