<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('home');

//Auth Routes
Route::get('/login', [App\Http\Controllers\auth\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\auth\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\auth\RegisterController::class, 'register'])->name('.register');

Route::middleware(['auth', 'role:mentee'])->prefix('mentee')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\mentee\DashboardController::class, 'index'])->name('mentee.dashboard');
    Route::get('/bookings', [App\Http\Controllers\mentee\BookingsController::class, 'index'])->name('mentee.bookings');
    Route::get('/chat', [App\Http\Controllers\mentee\MessageController::class, 'index'])->name('mentee.chat');
    Route::get('/profile', [App\Http\Controllers\mentee\ProfileController::class, 'index'])->name('mentee.profile');
    Route::get('/profile-settings', [App\Http\Controllers\mentee\DashboardController::class, 'index'])->name('mentee.profile-settings');
    Route::post('/toggle/{mentorId}', [App\Http\Controllers\mentee\DashboardController::class, 'toggleMentor'])->name('mentee.toggle');
    // Fetch messages route
    Route::get('/messages/fetch/{mentor_id}', [App\Http\Controllers\mentee\MessageController::class, 'fetchMessages'])->name('mentee.messages.fetch');

    // Send message route
    Route::post('/messages/send/{mentor_id}', [App\Http\Controllers\mentee\MessageController::class, 'sendMessage'])->name('mentee.messages.send');
    Route::post('/password-change', [App\Http\Controllers\mentee\ProfileController::class, 'changePassword'])->name('mentee.password.change');

});

Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\mentor\DashboardController::class, 'index'])->name('mentor.dashboard');
    Route::get('/bookings', [App\Http\Controllers\mentor\BookingsController::class, 'index'])->name('mentor.bookings');
    Route::get('/chat', [App\Http\Controllers\mentor\MessageController::class, 'index'])->name('mentor.chat');
    Route::get('/profile', [App\Http\Controllers\mentor\ProfileController::class, 'index'])->name('mentor.profile');
    Route::get('/profile-settings', [App\Http\Controllers\mentor\DashboardController::class, 'index'])->name('mentor.profile-settings');
    Route::post('/toggle/{mentorId}', [App\Http\Controllers\mentor\DashboardController::class, 'toggleStatus'])->name('mentor.toggleStatus');
    Route::put('/editTimeSlot/{id}', [App\Http\Controllers\mentor\BookingsController::class, 'updateAppointment'])->name('mentor.editTimeSlot');
    Route::post('/setTimeSlot', [App\Http\Controllers\mentor\BookingsController::class, 'setTimeSlot'])->name('mentor.setTimeSlot');
    // Routes
    Route::put('/time-slot/{id}', [App\Http\Controllers\mentor\BookingsController::class, 'updateTimeSlot'])->name('mentor.updateTimeSlot');

    Route::post('/password-change', [App\Http\Controllers\mentor\ProfileController::class, 'changePassword'])->name('mentor.password.change');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/users/{user}', [App\Http\Controllers\admin\DashboardController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/bookings', [App\Http\Controllers\admin\BookingsController::class, 'index'])->name('admin.bookings');
    Route::delete('/mentorships/{id}', [App\Http\Controllers\admin\BookingsController::class, 'destroy'])->name('admin.mentorships.destroy');
    Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/password-change', [App\Http\Controllers\admin\ProfileController::class, 'changePassword'])->name('admin.password.change');

});
Route::get('/{pathMatch}', function () {
    return view('frontend.home');
})->where('pathMatch', ".*");
