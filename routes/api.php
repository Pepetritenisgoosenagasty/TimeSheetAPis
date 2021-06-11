<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StandardReportingTimeController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Route
// Manager Login Api Route
Route::post('/login', [AuthController::class, 'login']);
// Staff Clockin Api Route
Route::post('/attendance', [AttendanceController::class, 'store']);

// Protected Route
Route::middleware('auth:sanctum')->group( function () {
    // Staff Api Route
    Route::resource('/staff', StaffController::class);
    // Logout Api Route
    Route::post('/logout', [AuthController::class, 'logout']);
    // Late comers Api Route
    Route::get('/lateStaffs', [AttendanceController::class, 'latecomers']);
    // Set New Standard time
    Route::put('/standardReportingTime/{id}', [StandardReportingTimeController::class, 'update']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
