<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;


class MemberController extends Controller
{
    public function index()
    {
        $result = Member::all();

        return response()->json($result, 200);
    }


    public function showId(string $id) 
    {
        $result = Member::find($id);

        if($result) {
            return response()->json($result, 200);
        }
        else {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | string',
            'age' => 'required | integer | gte:18 | lte: 65',
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $member = Member::create([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json(['message' => 'Data has been saved successfully'], 201);
    }


    public function show($name)
    {
        $result = Member::where("name","like","%".$name."%")->get();

        if(count($result)) {
            return $result;
        }
        else {
            return response()->json(['result' => 'No records found. Please try again and use character(s) only'], 404);
        }
    }


    public function edit(Request $request, string $id)
    {
        $result = Member::find($id);

        if(is_null($result)) {
            return response()->json(['message' => 'ID member not found'], 404);
        }
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required | string',
                'age' => 'required | integer | gte:18 | lte: 65',
                'email' => 'required | email',
                'password' => 'required',
            ]);
    
            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $result->update($request->all());
            return response()->json(['message' => 'Data has been updated successfully'], 201);
        }
    }

 
    public function destroy(string $id)
    {
        $result = Member::find($id);

        if($result) {
            $result = Member::destroy($id);

            return response()->json(['message' => 'Member deleted successfully'], 200);
        }
        else {
            return response()->json(['message' => 'ID member not found'], 404);
        }
    }
}
