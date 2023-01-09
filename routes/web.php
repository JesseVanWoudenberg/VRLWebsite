<?php

   /////////////////
  //// Imports ////
 /////////////////
///
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PenaltypointController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Driver\AvailabilityController;
use App\Http\Controllers\Driver\Requests\DrivernumberChangeRequestController;
use App\Http\Controllers\Driver\Requests\TeamTransferRequestController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ConstructorchampionshipController;
use App\Http\Controllers\Admin\DriverchampionshipController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\PowerunitController;
use App\Http\Controllers\Admin\RaceController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\TierController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Open\TieroneController;
use App\Http\Controllers\Open\RaceController as OpenRaceController;
use App\Http\Controllers\Open\TrackController as OpenTrackController;

use App\Http\Controllers\Admin\AvailabilityController as AdminAvailabilityController;
use App\Http\Controllers\Driver\RequestController as DriverRequestController;
// Open page controllers
use App\Http\Controllers\Open\TeamController as OpenTeam;
use App\Http\Controllers\Open\DriverController as OpenDriver;

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

// Login & register
//Route::get('login', [LoginController::class, 'index'])->name('login');
//Route::post('login', [LoginController::class, 'login']);
//
//Route::get('register', [RegisterController::class, 'index'])->name('register');
//Route::post('register', [RegisterController::class, 'register']);

   /////////////////////
  //// Auth Routes ////
 /////////////////////

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('admin', function () {
        return view('private.index');
    })->name('admin');
});

   ///////////////////////
  //// Public Routes ////
 ///////////////////////
// Home Routing
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Open news Routing
Route::get('/news', function () {
    return view('public.news', [
        'articles' => DB::table('articles')->paginate(5)
    ]);
})->name('news');

// The Team Routing
Route::get('/the-team', function () {
    return view('public.the-team');
})->name('the-team');

// Roadmap Routing
Route::get('/roadmap', function () {
    return view('public.roadmap');
})->name('roadmap');

// Tier 1 routing
Route::get('/tier1', [TieroneController::class, 'index'])->name('tier1');
Route::get('tier1/standings', [TieroneController::class, 'standings'])->name('tier1.standings');
Route::get('tier1/lineup', [TieroneController::class, 'lineup'])->name('tier1.lineup');
Route::get('tier1/calendar', [TieroneController::class, 'calendar'])->name('tier1.calendar');
Route::get('tier1/leaderboard', [TieroneController::class, 'leaderboard'])->name('tier1.leaderboard');
Route::resource('/tier1', TieroneController::class);

//// Tier 2 routing
//Route::get('/tier2', [TiertwoController::class, 'index'])->name('tier2');
//Route::get('tier2/standings', [TieroneController::class, 'standings'])->name('tier2.standings');
//Route::get('tier2/lineup', [TieroneController::class, 'lineup'])->name('tier2.lineup');
//Route::get('tier2/calendar', [TieroneController::class, 'calendar'])->name('tier2.calendar');
//Route::resource('/tier2', TiertwoController::class);

//// Tier 3 routing
//Route::get('/tier3', [TierthreeController::class, 'index'])->name('tier3');
//Route::get('tier3/standings', [TieroneController::class, 'standings'])->name('tier3.standings');
//Route::get('tier3/lineup', [TieroneController::class, 'lineup'])->name('tier3.lineup');
//Route::get('tier3/calendar', [TieroneController::class, 'calendar'])->name('tier3.calendar');
//Route::resource('/tier3', TierthreeController::class);

// Public driver routing
Route::get('/driver/{driver}', [OpenDriver::class, 'show'])->name('open-driver');

// Public team routing
Route::get('/team/{team}', [OpenTeam::class, 'show'])->name('open-team');

// Public team routing
Route::get('/race/{race}', [OpenRaceController::class, 'show'])->name('open-race');

// Public track routing
Route::get('/track/{track}', [OpenTrackController::class, 'show'])->name('open-track');

// Profile routing
Route::group(['middleware' => ['permission:profile-show']], function () {

    Route::resource('/profile', ProfileController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

});

   //////////////////////
  //// Admin Routes ////
 //////////////////////
// Article Routing
Route::resource('/admin/article', ArticleController::class);
Route::get('/admin/article/{article}/delete', [ArticleController::class, 'delete'])->name('article.delete');
Route::get('/admin/article', [ArticleController::class, 'index'])->name('article');

// Constructor Championship routing
Route::resource('/admin/constructorchampionship', ConstructorchampionshipController::class);
Route::get('/admin/constructorchampionship/{constructorchampionship}/delete', [ConstructorchampionshipController::class, 'delete'])->name('constructorchampionship.delete');
Route::get('/admin/constructorchampionship', [ConstructorchampionshipController::class, 'index'])->name('constructorchampionship');

// Driver Championship routing
Route::resource('/admin/driverchampionship', DriverchampionshipController::class);
Route::get('/admin/driverchampionship/{driverchampionship}/delete', [DriverchampionshipController::class, 'delete'])->name('driverchampionship.delete');
Route::get('/admin/driverchampionship', [DriverchampionshipController::class, 'index'])->name('driverchampionship');

// Driver routing
Route::resource('/admin/driver', DriverController::class);
Route::get('/admin/driver/{driver}/delete', [DriverController::class, 'delete'])->name('driver.delete');
Route::get('/admin/driver/', [DriverController::class, 'index'])->name('driver');

// Power unit routing
Route::resource('/admin/powerunit', PowerunitController::class);
Route::get('/admin/powerunit/{powerunit}/delete', [PowerunitController::class, 'delete'])->name('powerunit.delete');
Route::get('/admin/powerunit', [PowerunitController::class, 'index'])->name('powerunit');

// Race routing
Route::resource('/admin/race', RaceController::class);
Route::get('/admin/race/{season}/{tier}', [
    'as'   => 'race.search',
    'uses' => 'App\Http\Controllers\Admin\RaceController@search'
]);
Route::get('/admin/race/{race}/delete', [RaceController::class, 'delete'])->name('race.delete');
Route::get('/admin/race', [RaceController::class, 'index'])->name('race');

// Season routing
Route::resource('/admin/season', SeasonController::class);
Route::get('/admin/season/{season}/delete', [SeasonController::class, 'delete'])->name('season.delete');
Route::get('/admin/season', [SeasonController::class, 'index'])->name('season');

// Team routing
Route::resource('/admin/team', TeamController::class);
Route::get('/admin/team/{team}/delete', [TeamController::class, 'delete'])->name('team.delete');
Route::get('/admin/team', [TeamController::class, 'index'])->name('team');

// Tier routing
Route::resource('/admin/tier', TierController::class);
Route::get('/admin/tier/{tier}/delete', [TierController::class, 'delete'])->name('tier.delete');
Route::get('/admin/tier', [TierController::class, 'index'])->name('tier');

// Track routing
Route::resource('/admin/track', TrackController::class);
Route::get('/admin/track/{track}/delete', [TrackController::class, 'delete'])->name('track.delete');
Route::get('/admin/track', [TrackController::class, 'index'])->name('track');

// Penalty points routing
Route::get('/admin/penaltypoint', [PenaltypointController::class, 'index'])->name('penaltypoint');
Route::get('/admin/penaltypoint/create', [PenaltypointController::class, 'create'])->name('penaltypoint.create');
Route::get('/admin/penaltypoint/store', [PenaltypointController::class, 'store'])->name('penaltypoint.store');
Route::get('/admin/penaltypoint/{driver}/edit', [PenaltypointController::class, 'edit'])->name('penaltypoint.edit');
Route::get('/admin/penaltypoint/{driver}/update', [PenaltypointController::class, 'update'])->name('penaltypoint.update');

Route::resource('admin/permission', PermissionController::class);
Route::get('/admin/permission/{permission}/permission', [PermissionController::class, 'delete'])->name('permission.delete');
Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permission');

Route::resource('admin/user', UserController::class);
Route::get('admin/user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('admin/user/{user}/permissions', [UserController::class, 'permissions'])->name('user.permissions');
Route::get('admin/user/{user}/update-permissions', [UserController::class, 'updatepermissions'])->name('user.update-permissions');
Route::get('admin/user', [UserController::class, 'index'])->name('user');

Route::resource('admin/role', RoleController::class);
Route::get('admin/role/{role}/delete', [RoleController::class, 'delete'])->name('role.delete');
Route::get('admin/role/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
Route::get('admin/role/{role}/update-permissions', [RoleController::class, 'updatepermissions'])->name('role.update-permissions');
Route::get('admin/role', [RoleController::class, 'index'])->name('role');

Route::get('admin/requests', [RequestController::class, 'index'])->name('admin.requests');
Route::get('admin/requests/teamtransfer/handle/{id}', [RequestController::class, 'handleTeamTransferRequest'])->name('admin.requests.teamtransfer.handle');
Route::get('admin/requests/drivernumber/handle/{id}', [RequestController::class, 'handleDrivernumberChangeRequest'])->name('admin.requests.drivernumber.handle');

Route::get('admin/availability', [AdminAvailabilityController::class, 'index'])->name('admin.availability');
Route::get('admin/availability/{raceAvailabilityId}/show', [AdminAvailabilityController::class, 'show'])->name('admin.availability.show');

Route::resource('admin/log', LogController::class);
Route::get('/admin/log', [LogController::class, 'index'])->name('log');

   ///////////////////////
  //// Driver Routes ////
 ///////////////////////
// Driver dashboard/home
Route::get('/driverpanel/', function () {
    return view('driver.home');
})->name('driverpanel');

// Driver sign up form
Route::get('/driverpanel/sign-up', function () {
    return view('driver.signup');
})->name('driverpanel.sign-up');

// General index for all requests
Route::get('/driverpanel/requests', [DriverRequestController::class, 'index'])->name('driverpanel.requests');

Route::get('/driverpanel/requests/drivernumber/create', [DrivernumberChangeRequestController::class, 'create'])->name('driverpanel.requests.drivernumber.create');
Route::get('/driverpanel/requests/drivernumber/store', [DrivernumberChangeRequestController::class, 'store'])->name('driverpanel.requests.drivernumber.store');
Route::get('/driverpanel/requests/drivernumber/{id}/delete', [DrivernumberChangeRequestController::class, 'delete'])->name('driverpanel.requests.drivernumber.delete');
Route::get('/driverpanel/requests/drivernumber/{id}/destroy', [DrivernumberChangeRequestController::class, 'destroy'])->name('driverpanel.requests.drivernumber.destroy');
Route::get('/driverpanel/requests/drivernumber/{id}/edit', [DrivernumberChangeRequestController::class, 'edit'])->name('driverpanel.requests.drivernumber.edit');
Route::get('/driverpanel/requests/drivernumber/{id}/update', [DrivernumberChangeRequestController::class, 'update'])->name('driverpanel.requests.drivernumber.update');

Route::get('/driverpanel/requests/teamtransfer/create', [TeamTransferRequestController::class, 'create'])->name('driverpanel.requests.teamtransfer.create');
Route::get('/driverpanel/requests/teamtransfer/store', [TeamTransferRequestController::class, 'store'])->name('driverpanel.requests.teamtransfer.store');
Route::get('/driverpanel/requests/teamtransfer/{id}/delete', [TeamTransferRequestController::class, 'delete'])->name('driverpanel.requests.teamtransfer.delete');
Route::get('/driverpanel/requests/teamtransfer/{id}/destroy', [TeamTransferRequestController::class, 'destroy'])->name('driverpanel.requests.teamtransfer.destroy');

Route::get('/driverpanel/availability', [AvailabilityController::class, 'index'])->name('driverpanel.availability');
Route::get('/driverpanel/availability/{id}', [AvailabilityController::class, 'edit'])->name('driverpanel.availability.edit');
Route::get('/driverpanel/availability/{id}/update', [AvailabilityController::class, 'update'])->name('driverpanel.availability.update');
