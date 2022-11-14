<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Open\TheteamController;
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
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Open\HomeController;
use App\Http\Controllers\Open\TieroneController;
use App\Http\Controllers\Open\ArticleController as OpenArticleController;
use App\Http\Controllers\Open\RaceController as OpenRaceController;
use App\Http\Controllers\Open\TrackController as OpenTrackController;

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

// Home routing
Route::get('/', [HomeController::class, 'index'])->name('home');

// Open news routing
Route::get('/news', [OpenArticleController::class, 'index'])->name('news');

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

// The Team Routing
Route::get('/the-team', [TheteamController::class, 'index'])->name('the-team');

// Profile routing
Route::group(['middleware' => ['permission:profile-show']], function () {

    Route::resource('/profile', ProfileController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

});

// Article Routing
Route::group(['middleware' => ['role:reporter|admin']], function() {
    Route::resource('/admin/article', ArticleController::class);
    Route::get('/admin/article/{article}/delete', [ArticleController::class, 'delete'])->name('article.delete');
    Route::get('/admin/article', [ArticleController::class, 'index'])->name('article');
});

// Constructor Championship routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/constructorchampionship', ConstructorchampionshipController::class);
    Route::get('/admin/constructorchampionship/{constructorchampionship}/delete', [ConstructorchampionshipController::class, 'delete'])->name('constructorchampionship.delete');
    Route::get('/admin/constructorchampionship', [ConstructorchampionshipController::class, 'index'])->name('constructorchampionship');
});

// Driver Championship routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/driverchampionship', DriverchampionshipController::class);
    Route::get('/admin/driverchampionship/{driverchampionship}/delete', [DriverchampionshipController::class, 'delete'])->name('driverchampionship.delete');
    Route::get('/admin/driverchampionship', [DriverchampionshipController::class, 'index'])->name('driverchampionship');
});

// Driver routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/driver', DriverController::class);
    Route::get('/admin/driver/{driver}/delete', [DriverController::class, 'delete'])->name('driver.delete');
    Route::get('/admin/driver', [DriverController::class, 'index'])->name('driver');
});

// Power unit routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/powerunit', PowerunitController::class);
    Route::get('/admin/powerunit/{powerunit}/delete', [PowerunitController::class, 'delete'])->name('powerunit.delete');
    Route::get('/admin/powerunit', [PowerunitController::class, 'index'])->name('powerunit');
});

// Race routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/race', RaceController::class);
    Route::get('/admin/race/{race}/delete', [RaceController::class, 'delete'])->name('race.delete');
    Route::get('/admin/race', [RaceController::class, 'index'])->name('race');
});

// Season routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/season', SeasonController::class);
    Route::get('/admin/season/{season}/delete', [SeasonController::class, 'delete'])->name('season.delete');
    Route::get('/admin/season', [SeasonController::class, 'index'])->name('season');
});

// Team routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/team', TeamController::class);
    Route::get('/admin/team/{team}/delete', [TeamController::class, 'delete'])->name('team.delete');
    Route::get('/admin/team', [TeamController::class, 'index'])->name('team');
});

// Tier routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/tier', TierController::class);
    Route::get('/admin/tier/{tier}/delete', [TierController::class, 'delete'])->name('tier.delete');
    Route::get('/admin/tier', [TierController::class, 'index'])->name('tier');
});

// Track routing
Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('/admin/track', TrackController::class);
    Route::get('/admin/track/{track}/delete', [TrackController::class, 'delete'])->name('track.delete');
    Route::get('/admin/track', [TrackController::class, 'index'])->name('track');
});

Route::group(['middleware' => ['role:admin']], function() {

    Route::resource('admin/user', UserController::class);
    Route::get('admin/user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('admin/user/{user}/permissions', [UserController::class, 'permissions'])->name('user.permissions');
    Route::get('admin/user/{user}/update-permissions', [UserController::class, 'updatepermissions'])->name('user.update-permissions');
    Route::get('admin/user', [UserController::class, 'index'])->name('user');
});
