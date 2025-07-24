<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NotificationLogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentServiceController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('customers', CustomerController::class);
Route::apiResource('staff', StaffController::class);
Route::apiResource('schedules', ScheduleController::class);
Route::apiResource('promotions', PromotionController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('feedback', FeedbackController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('appointment-services', AppointmentServiceController::class);

Route::get('customers/{customer}/feedback', [CustomerController::class, 'feedback']);
Route::get('customers/{customer}/appointments', [CustomerController::class, 'appointments']);

Route::get('staff/{staff}/schedules', [StaffController::class, 'schedules']);
Route::get('staff/{staff}/promotions', [StaffController::class, 'promotions']);
Route::get('staff/{staff}/appointments', [StaffController::class, 'appointments']);

Route::get('promotions/{promotion}/services', [PromotionController::class, 'services']);

Route::get('services/{service}/appointments', [ServiceController::class, 'appointments']);
Route::get('services/{service}/promotion', [ServiceController::class, 'promotion']);

Route::get('feedback/customer/{customer}', [FeedbackController::class, 'customerFeedback']);

Route::get('appointments/today', [AppointmentController::class, 'today']);
Route::get('appointments/date/{date}', [AppointmentController::class, 'byDate']);
Route::get('appointments/customer/{customerID}', [AppointmentController::class, 'byCustomer']);
Route::get('appointments/staff/{staffID}', [AppointmentController::class, 'byStaff']);
Route::get('appointments/statistics', [AppointmentController::class, 'statistics']);
Route::patch('appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
