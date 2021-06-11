<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffPostRequest;
use App\Mail\StaffAdded;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Staff::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffPostRequest $request)
    {
       $attr = $request->validated();
        $staff = Staff::create([
                'firstname' => $attr['firstname'],
                'lastname' => $attr['lastname'],
                'email' => $attr['email'],
                'age' => $attr['age'],
                'phone_number' => $attr['phone_number'],
                'staff_id' => Str::random(20)  
              ]);

             
            //   Send Mail
              Mail::to($staff->email)->queue(new StaffAdded($staff));

              $response = ['staff' => $staff];
            
              return response($response, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Staff::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $staff = Staff::find($id);
       $staff->update($request->all());
       $staff->save();
       return response()->json('Staff Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);
        return response()->json('Staff Successfully Deleted');
    }
}
