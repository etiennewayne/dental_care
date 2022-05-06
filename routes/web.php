<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // if(Auth::check()){
    //     $user = Auth::user();
    //     return view('welcome')
    //         ->with('user', $user->only(['lname', 'fname', 'mname', 'suffix', 'role', 'remark', 'office_id']));
    // }
    return view('welcome');
});
Route::get('/get-dental-services', [App\Http\Controllers\Administrator\ServicesController::class, 'getDentalServices']);


Auth::routes([
    'login' => 'false'
]);


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/sample',[App\Http\Controllers\SampleController::class,'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sign-up', [App\Http\Controllers\SignUpController::class, 'index']);

Route::get('/covid-updates', [App\Http\Controllers\CovidUpdatesController::class, 'index']);

Route::post('/sign-up', [App\Http\Controllers\SignUpController::class, 'store']);


Route::get('/get-user/{id}', [App\Http\Controllers\OpenUserController::class, 'getUser']);





//QUICK BOOK NOW
Route::post('/book-now', [App\Http\Controllers\BookNowController::class, 'store']);




Route::get('/dental-chart', [App\Http\Controllers\DentalChartController::class, 'index']);




//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);




/*     ADMINSITRATOR          */
Route::resource('/admin-home', App\Http\Controllers\Administrator\AdminHomeController::class);

Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
Route::get('/get-user-offices', [App\Http\Controllers\Administrator\UserController::class, 'getOffices']);


//services
Route::resource('/services', App\Http\Controllers\Administrator\ServicesController::class);
Route::get('/get-services', [App\Http\Controllers\Administrator\ServicesController::class, 'getServices']);
Route::get('/get-all-services', [App\Http\Controllers\Administrator\ServicesController::class, 'getAllServices']);

//Route::get('/get-open-appointment-types', [App\Http\Controllers\ServicesController::class, 'getOpenSer']);


Route::resource('/request-appointment', App\Http\Controllers\Administrator\RequestAppointment::class);
Route::get('/get-request-appointments', [App\Http\Controllers\Administrator\RequestAppointment::class, 'getRequestAppointments']);


Route::resource('/appointments', App\Http\Controllers\Administrator\AppointmentController::class);
Route::get('/get-appointments', [App\Http\Controllers\Administrator\AppointmentController::class, 'getAppointments']);
Route::post('appointment-approve/{id}', [App\Http\Controllers\Administrator\AppointmentController::class, 'appointmentApprove']);
Route::post('appointment-cancel/{id}', [App\Http\Controllers\Administrator\AppointmentController::class, 'appointmentCancel']);

Route::get('/report-track', [App\Http\Controllers\Administrator\ReportTrackController::class, 'index']);
Route::get('/get-report-track', [App\Http\Controllers\Administrator\ReportTrackController::class, 'getReportTrack']);

//Offices Administrator (For office management)

/*     ADMINSITRATOR          */


//USER
//dentist
//Route::resource('/dentist', App\Http\Controllers\Administrator\DentistController::class);
//Route::get('/get-dentist', [App\Http\Controllers\Administrator\DentistController::class, 'getDentists']);


Route::get('/get-browse-dentist', [App\Http\Controllers\Administrator\DentistController::class, 'getBrowseDentist']);




//APPOINTMENT
Route::resource('/my-appointment', App\Http\Controllers\MyAppointmentController::class);
Route::get('/get-my-appointments', [App\Http\Controllers\MyAppointmentController::class, 'getMyAppointments']);
Route::post('/cancel-my-appointment/{id}', [App\Http\Controllers\MyAppointmentController::class, 'cancelMyAppointment']);



Route::resource('/dashboard-user', App\Http\Controllers\User\DashboardUserController::class);
Route::get('/get-user', [App\Http\Controllers\User\DashboardUserController::class, 'getUser']);


Route::resource('/my-profile', App\Http\Controllers\User\MyProfileController::class);
Route::get('/get-my-profile', [App\Http\Controllers\User\MyProfileController::class, 'getProfile']);

Route::get('/my-upcoming-appointment', [App\Http\Controllers\User\MyAppointmentController::class, 'upcomingAppointment']);



//DENTIST MODULE
Route::resource('/dentist/dashboard', App\Http\Controllers\Dentist\DashboardController::class);

Route::resource('/dentist/appointments', App\Http\Controllers\Dentist\DentistAppointmentController::class);

Route::get('/dentist/get-appointments', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'getAppointments']);

Route::post('/dentist/approve-appointment/{id}', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'approveAppointment']);

Route::post('/dentist/cancel-appointment/{id}', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'cancelAppointment']);
    
Route::post('/dentist/admit-appointment/{id}', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'admitAppointment']);


Route::resource('/dentist/my-patients', App\Http\Controllers\Dentist\DentistMyPatientController::class);
Route::get('/dentist/get-admits-patients', [App\Http\Controllers\Dentist\DentistMyPatientController::class, 'getAdmitsPatients']);
Route::get('/dentist/get-admit/{id}', [App\Http\Controllers\Dentist\DentistMyPatientController::class, 'getAdmit']);




//patient dentist dashboard
//during admit
Route::resource('/dentist/dentist-dashboard-patients', App\Http\Controllers\Dentist\DentistDashboardPatientController::class);

Route::resource('/dentist/dentist-service-patient', App\Http\Controllers\Dentist\DentistServicePatientController::class);


//admit services table

Route::resource('/dentist/admit-services', App\Http\Controllers\Dentist\DentistAdmitServiceController::class);
Route::get('/dentist/get-admit-services/{id}/{tid}', [App\Http\Controllers\Dentist\DentistAdmitServiceController::class, 'getAdmitServices']);







//possible below not use
Route::post('/dentist/pending-appointment/{id}', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'pendingAppointment']);

Route::get('/dentist/services-log', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'servicesLog']);
Route::get('/dentist/get-services-log', [App\Http\Controllers\Dentist\DentistAppointmentController::class, 'getServicesLog']);


Route::resource('/dentist/dentist-items', App\Http\Controllers\Dentist\DentistItemController::class);
Route::get('/dentist/get-dentist-items', [App\Http\Controllers\Dentist\DentistItemController::class, 'getDentistItems']);


//appointment services controller

Route::resource('/dentist/appointment-services', App\Http\Controllers\Dentist\AppointmentServiceController::class);

//inventory item for each service
Route::resource('/dentist/services-log-inv', App\Http\Controllers\Dentist\DentistServiceInventoryController::class);




//ITEM
Route::resource('/dentist/items', App\Http\Controllers\Dentist\ItemController::class);
Route::get('/dentist/get-items', [App\Http\Controllers\Dentist\ItemController::class, 'getItems']);
Route::get('/dentist/get-browse-items', [App\Http\Controllers\Dentist\ItemController::class, 'getBrowseItems']);




Route::get('/session', function(){
    return Session::all();
});




Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
