<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

//login page punya part

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//admin routes


Route::get('/admin/admin-past', function () {
    return view('admin.admin-past');
})->name('admin.pastappointment');

Route::get('/admin/admin-all', function () {
    return view('admin.admin-all');
})->name('admin.allappointment');


Route::get('/admin/manage-promo', function () {
    return view('admin.manage-promo');
})->name('admin.manage-promo');


//manager routes
Route::get('/manager/m-dashboard', function () {
    return view('manager.m-dashboard');
})->name('manager.dashboard');

Route::get('/manager/m-schedule', function () {
    return view('manager.m-schedule');
})->name('manager.schedule');

Route::get('/manager/m-appointment', function () {
    return view('manager.m-appointment');
})->name('manager.appointment');

Route::get('/manager/m-custlist', function () {
    return view('manager.m-custlist');
})->name('manager.custlist');

Route::get('/manager/m-all', function () {
    return view('manager.m-all');
})->name('manager.allappointment');

Route::get('/manager/m-past', function () {
    return view('manager.m-past');
})->name('manager.pastappointment');

Route::get('/manager/m-feedback', function () {
    return view('manager.m-feedback');
})->name('manager.feedback');

//customer routes


Route::get('/customer/promotions', function () {
    return view('customer.promotions');
})->name('customer.promotions');

//mainpage routes
Route::get('/main', function () {
    return view('main');
})->name('main');


Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/profile', [\App\Http\Controllers\CustomerProfileController::class, 'view'])->name('customer.profile');
});

//service list
Route::get('/customer/servicelist', [\App\Http\Controllers\ServiceController::class, 'viewServiceList'])->name('service.list');

//customer profile routes
Route::post('/customer/profile', [\App\Http\Controllers\CustomerProfileController::class, 'update'])->name('customer.profile');

// Update password
Route::post('/customer/profile/updatePassword', [\App\Http\Controllers\CustomerProfileController::class, 'updatePassword'])->name('customer.updatePassword')->middleware('auth:customer');

//appointment routes
Route::get('/customer/bookingpage', [\App\Http\Controllers\AppointmentController::class, 'viewAppointment'])->name('customer.bookingpage');

Route::get('/customer/bookingpage/available-slots', [\App\Http\Controllers\AppointmentController::class, 'getAvailableSlots'])->name('customer.availableslots');
Route::get('/customer/bookingpage/available-staff', [\App\Http\Controllers\AppointmentController::class, 'getAvailableStaff'])->name('customer.availablestaff');

Route::post('/customer/bookingpage/store', [\App\Http\Controllers\AppointmentController::class, 'store'])->name('booking.store');

Route::post('/customer/bookingschedule/reschedule', [\App\Http\Controllers\AppointmentController::class, 'reschedule'])->name('booking.reschedule');

Route::get('/customer/bookingschedule', [\App\Http\Controllers\AppointmentController::class, 'viewAschedule'])->name('booking.schedule');

Route::get('/admin/admin-appointment', [\App\Http\Controllers\AppointmentController::class, 'viewUpcomingAppointments'])->name('admin.appointment');

Route::post('/admin/admin-appointment', [\App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('admin.updateStatus');

Route::get('/admin/admin-past', [\App\Http\Controllers\AppointmentController::class, 'viewPastAppointments'])->name('admin.pastappointment');

Route::get('/admin/admin-all', [\App\Http\Controllers\AppointmentController::class, 'viewAllAppointments'])->name('admin.allappointment');

Route::post('/admin/feedback/close', [\App\Http\Controllers\AppointmentController::class, 'cancelStatus'])->name('admin.closeStatus');


//feedback routes
Route::post('/feedback', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.submit');
Route::get('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'show'])->name('admin.feedback');


//customer details routes
Route::get('/admin/admin-customerdetails', [\App\Http\Controllers\CustomerProfileController::class, 'adminViewCustomer'])->name('admin.customerdetails');

//service routes
Route::get('/customer/service/list', [\App\Http\Controllers\ServiceController::class, 'viewServiceList'])->name('service.list');

Route::get('/admin/manage-service', [\App\Http\Controllers\ServiceController::class, 'view'])->name('admin.manage-service');

Route::post('/admin/create-service', [\App\Http\Controllers\ServiceController::class, 'create'])->name('admin.create-service');

Route::post('/admin/update-service', [\App\Http\Controllers\ServiceController::class, 'update'])->name('admin.update-service');

Route::post('/admin/delete-service', [\App\Http\Controllers\ServiceController::class, 'delete'])->name('admin.delete-service');

//schedule routes
Route::get('/admin/manage-schedule', [\App\Http\Controllers\ScheduleController::class, 'view'])->name('admin.manage-schedule');

Route::post('/admin/create-schedule', [\App\Http\Controllers\ScheduleController::class, 'create'])->name('admin.create-schedule');

Route::post('/admin/update-schedule', [\App\Http\Controllers\ScheduleController::class, 'update'])->name('admin.update-schedule');

Route::post('/admin/delete-schedule', [\App\Http\Controllers\ScheduleController::class, 'delete'])->name('admin.delete-schedule');



//staff routes
Route::get('/admin/admin-profile', [\App\Http\Controllers\StaffProfileController::class, 'view'])->name('admin.profile');

Route::post('/admin/admin-profile', [\App\Http\Controllers\StaffProfileController::class, 'update'])->name('admin.profile');

// Update password
Route::post('/admin/admin-profile/updatePassword', [\App\Http\Controllers\StaffProfileController::class, 'updatePassword'])->name('admin.updatePassword')->middleware('auth:staff');

//promotions routes
Route::get('/customer/promotions', [\App\Http\Controllers\PromotionController::class, 'showCustomerPromotions'])->name('customer.promotions');

Route::get('/admin/manage-promo', [\App\Http\Controllers\PromotionController::class, 'view'])->name('admin.manage-promo');

Route::post('/admin/create-promo', [\App\Http\Controllers\PromotionController::class, 'create'])->name('admin.create-promo');

Route::post('/admin/update-promo', [\App\Http\Controllers\PromotionController::class, 'update'])->name('admin.update-promo');

Route::post('/admin/delete-promo', [\App\Http\Controllers\PromotionController::class, 'delete'])->name('admin.delete-promo');

//report route
Route::post('/reports/weekly-pdf', [\App\Http\Controllers\ReportController::class, 'downloadPdf'])
     ->name('reports.weekly.pdf');


Route::get('/admin/admin-dashboard', [\App\Http\Controllers\ReportController::class, 'view'])->name('admin.dashboard');

Route::get('/admin/notification', [\App\Http\Controllers\NotificationController::class, 'view'])->name('admin.notification');
Route::post('/admin/notification/appointment', [\App\Http\Controllers\NotificationController::class, 'appointmentNotification'])->name('admin.appointment-reminder');
Route::post('/admin/notification/promotion', [\App\Http\Controllers\NotificationController::class, 'promotionNotification'])->name('admin.promotion-reminder');
Route::post('/admin/notification/feedback', [\App\Http\Controllers\NotificationController::class, 'feedbackNotification'])->name('admin.feedback-reminder');