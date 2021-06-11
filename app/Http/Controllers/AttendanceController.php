<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendacePostRequest;
use App\Models\Attendance;
use App\Models\Staff;
use App\Notifications\Lateness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendacePostRequest $request)
    {
      $attr = $request->validated();
       
      $reportedTime = date('H:i:A');
       
        $attend = Attendance::create([
            'staff_id' => 1,
            'staff_serial_code' => $attr['staff_serial_code'],
            'reported_time' => $reportedTime
          ]);
         
        //   Checking if Staff ID Exist
        $staff_string = Staff::where('id', $attend->staff_id)->pluck('staff_id')->all();

        if(!Str::is($attend->staff_serial_code, implode(" ", $staff_string)))
        {
            return response()->json('Staff ID Does Not Exist');
        }


        //   Sending Notification
        if ($attend->reported_time > $attend->standard_time) {
            Notification::route('mail', 'monogasppar@gmail.com')
                        ->notify(new Lateness($attend));
        }

        $response = ['attend' => $attend];
        
        return response([$response, 201, "Clock in Successful"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function latecomers() {
        $standard_time = DB::table('standard_reporting_times')->select('standard_time')
                                                              ->orderByRaw('updated_at - created_at DESC')
                                                              ->get();

        $new_standard_time = json_decode( json_encode($standard_time[0]->standard_time), true);
        $late = DB::table('attendances')->where('reported_time', '>', $new_standard_time)->get();
        
        return $late;
    }
}
