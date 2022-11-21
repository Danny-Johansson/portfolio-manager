<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DemonstrationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsearchController;
use App\Http\Controllers\JobsearchStatusController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LanguageLevelController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFeatureController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TagCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'root'])->name('root');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

// Artisan Routes
Route::get('/Artisan/cache', [ArtisanController::class, 'cacheAll'])->name('artisan.cache.all');
Route::get('/Artisan/cache/route', [ArtisanController::class, 'cacheRoute'])->name('artisan.cache.route');
Route::get('/Artisan/cache/config', [ArtisanController::class, 'cacheConfig'])->name('artisan.cache.config');
Route::get('/Artisan/cache/view', [ArtisanController::class, 'cacheView'])->name('artisan.cache.view');
Route::get('/Artisan/clear', [ArtisanController::class, 'clearAll'])->name('artisan.clear.all');
Route::get('/Artisan/clear/route', [ArtisanController::class, 'clearRoute'])->name('artisan.clear.route');
Route::get('/Artisan/clear/config', [ArtisanController::class, 'clearConfig'])->name('artisan.clear.config');
Route::get('/Artisan/clear/view', [ArtisanController::class, 'clearView'])->name('artisan.clear.view');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/resume', [PageController::class, 'resume'])->name('resume');

Route::resource('jobsearches', JobsearchController::class);
Route::resource('projects', ProjectController::class);

Route::get('/demonstrations/{demonstration}/demo', [DemonstrationController::class, 'demo'])->name('demo');
Route::resource('demonstrations', DemonstrationController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::resource('owner',OwnerController::class);
    Route::resource('users',UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('socials', SocialController::class);
    Route::resource('tagCategories',TagCategoryController::class);
    Route::resource('tags',TagController::class);
    Route::resource('skills', SocialController::class);
    Route::resource('languageLevels', LanguageLevelController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('experienceTypes', ExperienceTypeController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('projectFeatures', ProjectFeatureController::class);
    Route::resource('jobsearchStatus', JobsearchStatusController::class);
});

Route::get('/test', [PageController::class, 'test'])->name('test');
