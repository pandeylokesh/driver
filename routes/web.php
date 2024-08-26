<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Route::get('driver/form', [DriverController::class, 'create'])->name('driver.create');
Route::post('driver/store', [DriverController::class, 'store'])->name('driver.store');
Route::get('driver/list', [DriverController::class, 'index'])->name('driver.index');
Route::get('driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
Route::post('driver/update/{id}', [DriverController::class, 'update'])->name('driver.update');
Route::get('driver/delete/{id}', [DriverController::class, 'destroy'])->name('driver.delete');


Route::post('driver/logout', [DriverController::class, 'logout'])->name('driver.logout');

// Routes that require authentication
Route::middleware('auth:driver')->group(function () {
    Route::get('driver/bookings', [DriverController::class, 'showDriverBookings'])->name('driver.bookings');
    // Add other routes that require driver authentication here
});

// Route for login
Route::get('driver/login', [DriverController::class, 'showLoginForm'])->name('driver.login');
Route::post('driver/login', [DriverController::class, 'login'])->name('driver.login.submit');
Route::get('/driver/bookings', [DriverController::class, 'showDriverBookings'])
    ->name('driver.bookings');
    





// company 


Route::get('company/form', [CompanyController::class, 'create'])->name('company.create');

Route::post('company/store', [CompanyController::class, 'store'])->name('company.store');

Route::get('company/list', [CompanyController::class, 'index'])->name('company.index');

Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');

// Update a company
Route::put('company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
// Route::post('company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
// Delete a company
Route::get('company/delete/{id}', [CompanyController::class, 'destroy'])->name('company.delete');



// booking

Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('booking/list', [BookingController::class, 'index'])->name('booking.index');
Route::get('booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
// In routes/web.php
Route::delete('booking/delete/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
Route::post('/booking/{id}/addAmount', [BookingController::class, 'addAmount'])->name('booking.addAmount');




// partner


// Route to show the create partner form
// Route to display the form for creating a new partner booking
Route::get('partner/create', [PartnerController::class, 'create'])->name('partner.create');

// Route to handle the submission of the partner booking creation form
Route::post('partner/store', [PartnerController::class, 'store'])->name('partner.store');

// Route to list all partner bookings
Route::get('partner/list', [PartnerController::class, 'index'])->name('partner.index');

// Route to display the form for editing a specific partner booking
Route::get('partner/edit/{id}', [PartnerController::class, 'edit'])->name('partner.edit');

// Route to handle the submission of the partner booking edit form
Route::put('partner/update/{id}', [PartnerController::class, 'update'])->name('partner.update');

// Route to delete a specific partner booking
Route::delete('partner/delete/{id}', [PartnerController::class, 'destroy'])->name('partner.destroy');
Route::post('/partner/{id}/addAmount', [PartnerController::class, 'addAmount'])->name('partner.addAmount');


// Check for duplicates like this:
 

    Route::post('/driver/{id}/add-amount', [DriverController::class, 'addAmount'])->name('driver.addAmount');
    




Route::get('/', function () {
    return view('welcome');
});